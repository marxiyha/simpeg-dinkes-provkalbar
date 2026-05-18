import React, { useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import { Auth } from '@/types';
import { Info } from 'lucide-react';
import CutiChart from '@/components/cuti-chart';

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
            <div className="bg-white text-primary p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold">Dashboard</h1>
                    <span className="text-xs">Halo, {namaPegawai}!</span>
                </div>
                <div className="space-x-2">
                    <button
                        onClick={() => setShowPanduan(true)}
                        className="bg-green-500 text-white px-4 py-2 rounded text-sm hover:bg-green-600 transition flex items-center gap-2"
                    >
                        <Info className="w-4 h-4" />
                        Panduan
                    </button>
                </div>
            </div>

            {/* KONTEN UTAMA */}
            <div className="max-w-6xl mx-auto mt-6 space-y-6 px-4 md:px-0">
                
                {/* GRAFIK CUTI */}
                <CutiChart />

                {/* 1. KARTU PROFIL PEGAWAI */}
                <div className="bg-white text-gray-800 p-6 rounded-lg shadow">
                    <h2 className="text-lg font-bold border-b pb-2 mb-4 text-primary">PROFIL SAYA</h2>
                    <div className="grid grid-cols-2 gap-4 text-sm">
                        <div><span className="font-bold">Nama:</span> {namaPegawai}</div>
                        <div><span className="font-bold">NIP / NIK:</span> {pegawai.nip || '-'}</div>
                        <div><span className="font-bold">Status:</span> {pegawai.status_pegawai || '-'}</div>
                        <div><span className="font-bold">Jabatan:</span> {pegawai.jabatan || '-'}</div>
                        <div><span className="font-bold">Unit Kerja:</span> {pegawai.unit_kerja?.nama_unit || '-'}</div>
                        <div><span className="font-bold">TMT Pegawai:</span> {pegawai.tmt_pegawai ? new Date(pegawai.tmt_pegawai).toLocaleDateString('id-ID') : '-'}</div>
                        <div><span className="font-bold">Pendidikan:</span> {pegawai.pendidikan_terakhir || '-'}</div>
                    </div>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {/* 2. KARTU INFORMASI CUTI */}
                    <div className="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <div className="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 className="text-lg font-bold text-primary">INFORMASI CUTI</h2>
                            <span className="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">
                                Sisa: {sisaCuti} Hari
                            </span>
                        </div>
                        <p className="text-sm text-gray-600 mb-4">
                            Anda dapat mengajukan cuti tahunan melalui tombol di bawah ini. Pengajuan akan diteruskan ke Kepala Unit untuk disetujui.
                        </p>
                        <Link href="/cuti" className="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition inline-block text-center">
                            + Ajukan Cuti Baru
                        </Link>
                    </div>

                    {/* 3. KARTU KALENDER DINAS LUAR (READ ONLY) */}
                    <div className="bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 className="text-lg font-bold border-b pb-2 mb-4 text-primary">JADWAL DINAS LUAR SAYA</h2>
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
                <div className="fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4 z-50">
                    <div className="bg-white text-gray-800 w-full max-w-lg rounded-xl p-6 shadow-2xl max-h-[80vh] overflow-y-auto transform transition-all">
                        <div className="flex items-center gap-3 mb-5 border-b pb-4">
                            <div className="bg-green-100 p-2 rounded-full">
                                <Info className="w-6 h-6 text-green-600" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-800">Panduan Dashboard</h3>
                        </div>
                        <div className="text-sm space-y-4 text-gray-600">
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">1</span>
                                    Profil Saya
                                </strong>
                                Halaman ini menampilkan profil Anda. Jika ada kesalahan data, harap hubungi Operator Kepegawaian di Unit Anda.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">2</span>
                                    Pengajuan Cuti
                                </strong>
                                Klik tombol "Ajukan Cuti Baru" dan isi form. Anda tidak bisa mengajukan cuti jika sisa cuti Anda 0.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">3</span>
                                    Dinas Luar
                                </strong>
                                Jadwal Dinas Luar diinput oleh pihak kepegawaian. Anda hanya dapat memantau jadwal yang ditugaskan kepada Anda di sini.
                            </div>
                        </div>
                        <div className="mt-6 pt-4 border-t">
                            <button
                                onClick={() => setShowPanduan(false)}
                                className="bg-gray-100 text-gray-800 font-bold px-4 py-2.5 rounded-lg hover:bg-gray-200 w-full transition active:scale-95"
                            >
                                Mengerti & Tutup
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}