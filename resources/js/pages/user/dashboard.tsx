import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import { Auth } from '@/types';
import { logout } from '@/routes';

interface RiwayatDL {
    lokasi: string;
    tanggal_mulai: string;
    tanggal_selesai: string;
}

interface UserDashboardProps {
    auth: Auth;
    sisaCuti?: number;
    riwayatDL?: RiwayatDL[];
}

export default function UserDashboard({ auth, sisaCuti = 12, riwayatDL = [] }: UserDashboardProps) {
    const [showPanduan, setShowPanduan] = useState(false);

    // Data dari auth (Inertia mengirim data user yang sedang login)
    // Cast to any to handle custom mockup fields safely for now
    const pegawai: any = auth.user;

    const namaPegawai = pegawai.nama || pegawai.name || 'Pegawai';

    return (
        <div className="min-h-screen bg-green-600 font-sans text-white pb-10">
            <Head title="Dashboard Pegawai - Dinkes Kalbar" />

            {/* HEADER */}
            <div className="bg-white text-green-800 p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold">SISTEM SDM DINKES KALBAR</h1>
                    <p className="text-xs font-semibold text-green-700">Halo, {namaPegawai}!</p>
                </div>
                <div className="space-x-2">
                    <button
                        onClick={() => setShowPanduan(true)}
                        className="bg-green-500 text-white px-4 py-2 rounded text-sm hover:bg-green-600">
                        Panduan
                    </button>
                    <Link
                        href={logout().url} method="post" as="button"
                        className="bg-red-500 text-white px-4 py-2 rounded text-sm hover:bg-red-600">
                        Logout
                    </Link>
                </div>
            </div>

            {/* KONTEN UTAMA */}
            <div className="max-w-6xl mx-auto mt-6 space-y-6">

                {/* 1. KARTU PROFIL PEGAWAI */}
                <div className="bg-white text-gray-800 p-6 rounded-lg shadow">
                    <h2 className="text-lg font-bold border-b pb-2 mb-4 text-green-700">PROFIL SAYA</h2>
                    <div className="grid grid-cols-2 gap-4 text-sm">
                        <div><span className="font-bold">Nama:</span> {namaPegawai}</div>
                        <div><span className="font-bold">NIP / NIK:</span> {pegawai.nip || '-'}</div>
                        <div><span className="font-bold">Status:</span> {pegawai.status || '-'}</div>
                        <div><span className="font-bold">Jabatan:</span> {pegawai.jabatan || '-'}</div>
                        <div><span className="font-bold">Unit Kerja:</span> {pegawai.unit_kerja || '-'}</div>
                        <div><span className="font-bold">Pendidikan:</span> {pegawai.pendidikan || '-'}</div>
                    </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {/* 2. KARTU INFORMASI CUTI */}
                    <div className="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <div className="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 className="text-lg font-bold text-green-700">INFORMASI CUTI</h2>
                            <span className="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">
                                Sisa: {sisaCuti} Hari
                            </span>
                        </div>
                        <p className="text-sm text-gray-600 mb-4">
                            Anda dapat mengajukan cuti tahunan melalui tombol di bawah ini. Pengajuan akan diteruskan ke Kepala Unit untuk disetujui.
                        </p>
                        <button className="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                            + Ajukan Cuti Baru
                        </button>
                    </div>

                    {/* 3. KARTU KALENDER DINAS LUAR (READ ONLY) */}
                    <div className="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 className="text-lg font-bold border-b pb-2 mb-4 text-green-700">JADWAL DINAS LUAR SAYA</h2>
                        {riwayatDL.length === 0 ? (
                            <p className="text-sm text-gray-500 italic text-center py-4">Tidak ada jadwal Dinas Luar di bulan ini.</p>
                        ) : (
                            <ul className="space-y-2">
                                {riwayatDL.map((dl, index) => (
                                    <li key={index} className="bg-gray-50 p-3 border-l-4 border-green-500 text-sm">
                                        <div className="font-bold">{dl.lokasi}</div>
                                        <div className="text-xs text-gray-600">
                                            {dl.tanggal_mulai} s/d {dl.tanggal_selesai}
                                        </div>
                                    </li>
                                ))}
                            </ul>
                        )}
                    </div>
                </div>
            </div>

            {/* POPUP PANDUAN */}
            {showPanduan && (
                <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4">
                    <div className="bg-white text-gray-800 w-full max-w-2xl rounded-lg p-6 max-h-[80vh] overflow-y-auto">
                        <h3 className="text-xl font-bold text-green-700 mb-4">PANDUAN PENGGUNAAN SISTEM</h3>
                        <div className="text-sm space-y-3">
                            <p><strong>A. PROFIL</strong><br />Halaman ini menampilkan profil Anda. Jika ada kesalahan data, harap hubungi Operator Kepegawaian di Unit Anda.</p>
                            <p><strong>B. PENGAJUAN CUTI</strong><br />Klik tombol "Ajukan Cuti Baru" dan isi form. Anda tidak bisa mengajukan cuti jika sisa cuti Anda 0.</p>
                            <p><strong>C. DINAS LUAR</strong><br />Jadwal Dinas Luar diinput oleh pihak kepegawaian. Anda hanya dapat memantau jadwal yang ditugaskan kepada Anda di sini.</p>
                        </div>
                        <button
                            onClick={() => setShowPanduan(false)}
                            className="mt-6 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full">
                            Tutup Panduan
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
}