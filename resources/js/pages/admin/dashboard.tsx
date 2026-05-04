import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Auth } from '@/types';
import { logout } from '@/routes';

interface AdminDashboardProps {
    auth: Auth;
    totalPegawai?: number;
    cutiPending?: number;
    pegawaiDinasLuar?: number;
}

export default function AdminDashboard({ 
    auth, 
    totalPegawai = 145, 
    cutiPending = 8, 
    pegawaiDinasLuar = 12 
}: AdminDashboardProps) {
    
    // Cast to any to handle fallback mockup fields safely
    const admin: any = auth.user;
    const namaAdmin = admin?.nama || admin?.name || 'Administrator';

    return (
        <div className="min-h-screen bg-slate-50 font-sans text-gray-800 pb-10">
            <Head title="Admin Dashboard - Dinkes Kalbar" />

            {/* HEADER */}
            <div className="bg-slate-900 text-white p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold">ADMIN SIMPEG DINKES KALBAR</h1>
                    <p className="text-xs font-semibold text-slate-300">Halo, {namaAdmin}!</p>
                </div>
                <div className="space-x-2">
                    <Link
                        href={logout().url} method="post" as="button"
                        className="bg-red-500 text-white px-4 py-2 rounded text-sm hover:bg-red-600 transition">
                        Logout
                    </Link>
                </div>
            </div>

            {/* KONTEN UTAMA */}
            <div className="max-w-7xl mx-auto mt-6 space-y-6 px-4">

                {/* STATISTIK UTAMA */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div className="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                        <h3 className="text-sm font-bold text-gray-500 mb-1">TOTAL PEGAWAI</h3>
                        <p className="text-3xl font-black text-slate-800">{totalPegawai}</p>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border-l-4 border-amber-500">
                        <h3 className="text-sm font-bold text-gray-500 mb-1">MENUNGGU PERSETUJUAN CUTI</h3>
                        <p className="text-3xl font-black text-slate-800">{cutiPending}</p>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border-l-4 border-emerald-500">
                        <h3 className="text-sm font-bold text-gray-500 mb-1">SEDANG DINAS LUAR</h3>
                        <p className="text-3xl font-black text-slate-800">{pegawaiDinasLuar}</p>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* MENU KELOLA ADMIN */}
                    <div className="bg-white p-6 rounded-lg shadow-sm">
                        <h2 className="text-lg font-bold border-b pb-2 mb-4 text-slate-800">MENU PENGELOLAAN</h2>
                        <div className="grid grid-cols-2 gap-4">
                            <button className="p-4 bg-slate-50 border rounded hover:bg-slate-100 flex flex-col items-center justify-center space-y-2 transition group">
                                <span className="font-bold text-slate-700 group-hover:text-blue-600">Data Pegawai</span>
                                <span className="text-xs text-gray-500 text-center">Kelola data master pegawai</span>
                            </button>
                            <button className="p-4 bg-slate-50 border rounded hover:bg-slate-100 flex flex-col items-center justify-center space-y-2 transition group">
                                <span className="font-bold text-slate-700 group-hover:text-blue-600">Persetujuan Cuti</span>
                                <span className="text-xs text-gray-500 text-center">Tinjau & Setujui Cuti</span>
                            </button>
                            <button className="p-4 bg-slate-50 border rounded hover:bg-slate-100 flex flex-col items-center justify-center space-y-2 transition group">
                                <span className="font-bold text-slate-700 group-hover:text-blue-600">Jadwal Dinas Luar</span>
                                <span className="text-xs text-gray-500 text-center">Atur perjalanan dinas</span>
                            </button>
                            <button className="p-4 bg-slate-50 border rounded hover:bg-slate-100 flex flex-col items-center justify-center space-y-2 transition group">
                                <span className="font-bold text-slate-700 group-hover:text-blue-600">Laporan & Rekap</span>
                                <span className="text-xs text-gray-500 text-center">Cetak rekapitulasi data</span>
                            </button>
                        </div>
                    </div>

                    {/* AKTIVITAS TERBARU */}
                    <div className="bg-white p-6 rounded-lg shadow-sm">
                        <h2 className="text-lg font-bold border-b pb-2 mb-4 text-slate-800">AKTIVITAS SISTEM TERBARU</h2>
                        <ul className="space-y-4">
                            <li className="text-sm flex justify-between items-center border-b pb-2">
                                <div>
                                    <span className="font-bold text-blue-600">Budi Santoso</span> mengajukan Cuti Tahunan.
                                </div>
                                <span className="text-gray-400 text-xs whitespace-nowrap ml-4">10 mnt lalu</span>
                            </li>
                            <li className="text-sm flex justify-between items-center border-b pb-2">
                                <div>
                                    <span className="font-bold text-emerald-600">Siti Aminah</span> selesai Dinas Luar dari Pontianak.
                                </div>
                                <span className="text-gray-400 text-xs whitespace-nowrap ml-4">1 jam lalu</span>
                            </li>
                            <li className="text-sm flex justify-between items-center border-b pb-2">
                                <div>
                                    <span className="font-bold text-slate-600">Admin Utama</span> memperbarui data NIP 19820391.
                                </div>
                                <span className="text-gray-400 text-xs whitespace-nowrap ml-4">3 jam lalu</span>
                            </li>
                            <li className="text-sm flex justify-between items-center border-b pb-2">
                                <div>
                                    <span className="font-bold text-amber-600">Sistem</span> melakukan sinkronisasi data presensi harian.
                                </div>
                                <span className="text-gray-400 text-xs whitespace-nowrap ml-4">5 jam lalu</span>
                            </li>
                        </ul>
                        <button className="mt-4 text-sm text-blue-600 hover:text-blue-800 hover:underline w-full text-center font-semibold transition">
                            Lihat Semua Aktivitas &rarr;
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
}
