<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Facades\Response;

class PegawaiController extends Controller
{
    public function index()
    {
        $users = User::with('unitKerja')->orderBy('name')->get();
        $unitKerjas = UnitKerja::all();

        return Inertia::render('user/pegawai', [
            'users' => $users,
            'unitKerjas' => $unitKerjas
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'id_unit' => 'nullable|exists:unit_kerjas,id_unit',
            'nip' => 'nullable|string|max:20|unique:users',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:50',
            'status_pegawai' => ['nullable', Rule::in(['PNS', 'PPPK'])],
            'tmt_pegawai' => 'nullable|date',
            'tmt_pensiun' => 'nullable|date',
            'batas_usia_pensiun' => 'nullable|integer',
            'perkiraan_naik_jabatan' => 'nullable|string|max:100',
            'perkiraan_naik_gaji' => 'nullable|string|max:100',
        ]);

        $validated['password'] = Hash::make('password123'); // Default password since it's just data entry

        User::create($validated);

        return redirect()->back()->with('success', 'Pegawai created successfully.');
    }

    public function update(Request $request, User $pegawai)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($pegawai->id)],
            'id_unit' => 'nullable|exists:unit_kerjas,id_unit',
            'nip' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($pegawai->id)],
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:50',
            'status_pegawai' => ['nullable', Rule::in(['PNS', 'PPPK'])],
            'tmt_pegawai' => 'nullable|date',
            'tmt_pensiun' => 'nullable|date',
            'batas_usia_pensiun' => 'nullable|integer',
            'perkiraan_naik_jabatan' => 'nullable|string|max:100',
            'perkiraan_naik_gaji' => 'nullable|string|max:100',
        ]);

        $pegawai->update($validated);

        return redirect()->back()->with('success', 'Pegawai updated successfully.');
    }

    public function destroy(User $pegawai)
    {
        $pegawai->delete();

        return redirect()->back()->with('success', 'Pegawai deleted successfully.');
    }

    public function exportCsv()
    {
        $pegawais = User::with('unitKerja')->get();
        $filename = "data_pegawai.csv";
        $handle = fopen('php://output', 'w');
        
        // Output headers so that the file is downloaded rather than displayed
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        fputcsv($handle, [
            'Nama', 'Email', 'NIP', 'Unit Kerja', 'Jabatan', 'Status Pegawai', 'Jenis Kelamin', 'Tanggal Lahir'
        ]);

        foreach ($pegawais as $row) {
            fputcsv($handle, [
                $row->name,
                $row->email,
                $row->nip,
                $row->unitKerja ? $row->unitKerja->nama_unit : '',
                $row->jabatan,
                $row->status_pegawai,
                $row->jenis_kelamin,
                $row->tanggal_lahir ? $row->tanggal_lahir->format('Y-m-d') : ''
            ]);
        }
        
        fclose($handle);
        exit;
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('file');
        if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
            // Skip the header row
            fgetcsv($handle, 1000, ",");
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Name, Email, NIP, Unit Kerja (ID), Jabatan, Status Pegawai, Jenis Kelamin, Tanggal Lahir
                if (count($data) >= 2) {
                    $email = $data[1];
                    $user = User::where('email', $email)->first();
                    if (!$user) {
                        User::create([
                            'name' => $data[0],
                            'email' => $email,
                            'password' => Hash::make('password123'), // Default password
                            'nip' => $data[2] ?? null,
                            // Simplification: if unit kerja name/ID is given, ideally we look it up.
                            // We will leave id_unit empty here for safety unless implemented properly.
                            'jabatan' => $data[4] ?? null,
                            'status_pegawai' => $data[5] ?? null,
                            'jenis_kelamin' => $data[6] ?? null,
                            'tanggal_lahir' => $data[7] ?? null,
                        ]);
                    }
                }
            }
            fclose($handle);
        }

        return redirect()->back()->with('success', 'Data Pegawai berhasil diimport.');
    }
}
