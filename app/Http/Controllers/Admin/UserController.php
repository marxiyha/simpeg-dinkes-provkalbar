<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('unitKerja')->orderBy('name')->get();
        $unitKerjas = UnitKerja::all();

        return Inertia::render('admin/users/index', [
            'users' => $users,
            'unitKerjas' => $unitKerjas
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_unit' => 'nullable|exists:unit_kerjas,id_unit',
            'nip' => 'nullable|string|max:20|unique:users',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:50',
            'status_pegawai' => ['nullable', Rule::in(['PNS', 'PPPK'])],
            'tmt_pensiun' => 'nullable|date',
            'batas_usia_pensiun' => 'nullable|integer',
            'perkiraan_naik_jabatan' => 'nullable|string|max:100',
            'perkiraan_naik_gaji' => 'nullable|string|max:100',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->back()->with('success', 'User (Pegawai) created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'id_unit' => 'nullable|exists:unit_kerjas,id_unit',
            'nip' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => ['nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'pendidikan_terakhir' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:50',
            'status_pegawai' => ['nullable', Rule::in(['PNS', 'PPPK'])],
            'tmt_pensiun' => 'nullable|date',
            'batas_usia_pensiun' => 'nullable|integer',
            'perkiraan_naik_jabatan' => 'nullable|string|max:100',
            'perkiraan_naik_gaji' => 'nullable|string|max:100',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'User (Pegawai) updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User (Pegawai) deleted successfully.');
    }
}
