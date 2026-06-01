<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;

class CutiController extends Controller
{
    /**
     * HALAMAN REKAP
     */
    public function rekap()
    {
        $data = Cuti::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->user->name ?? '-',
                    'jenis_cuti' => $item->jenis_cuti ?? '-',
                    'tanggal_mulai' => $item->tanggal_mulai ?? '-',
                    'tanggal_selesai' => $item->tanggal_selesai ?? '-',
                    'alasan_cuti' => $item->alasan ?? '-',
                    'status' => $item->status ?? 'Pending',
                ];
            });

        return view('cuti.rekap', compact('data'));
    }

    /**
     * HALAMAN APPROVAL
     */
    public function approval()
    {
        $cuti = Cuti::with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->user->name ?? '-',
                    'jenis_cuti' => $item->jenis_cuti ?? '-',
                    'tanggal_mulai' => $item->tanggal_mulai ?? '-',
                    'tanggal_selesai' => $item->tanggal_selesai ?? '-',
                    'alasan_cuti' => $item->alasan ?? '-',
                    'status' => $item->status ?? 'Pending',
                ];
            });

        return view('cuti.approval', compact('cuti'));
    }

    /**
     * UPDATE STATUS (INI YANG BIKIN SIMPAN AMAN)
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:Pending,Disetujui,Ditolak'
            ]);

            $cuti = Cuti::findOrFail($id);
            $cuti->status = $request->status;
            $cuti->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * UPDATE STATUS FROM HTML FORM
     */
    public function updateStatusHtml(Request $request, $id)
    {
        try {
            $request->validate([
                'status_pengajuan' => 'required|in:Menunggu,Disetujui,Ditolak'
            ]);

            $cuti = Cuti::findOrFail($id);
            $status = $request->status_pengajuan === 'Menunggu' ? 'Pending' : $request->status_pengajuan;
            $cuti->status = $status;
            $cuti->save();

            return redirect()->back()->with('success', 'Status cuti berhasil diperbarui.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal update status cuti: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
                'id' => $id
            ]);

            return redirect()->back()->withErrors(['error' => 'Gagal mengubah status: ' . $e->getMessage()]);
        }
    }

    /**
     * DELETE CUTI FROM HTML FORM
     */
    public function deleteCuti($id)
    {
        try {
            $cuti = Cuti::findOrFail($id);
            $cuti->delete();

            return redirect()->back()->with('success', 'Pengajuan cuti berhasil dihapus.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal menghapus cuti: ' . $e->getMessage(), [
                'exception' => $e,
                'id' => $id
            ]);

            return redirect()->back()->withErrors(['error' => 'Gagal menghapus cuti: ' . $e->getMessage()]);
        }
    }
}