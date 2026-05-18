import React, { useState, useRef } from 'react';
import { Head, useForm } from '@inertiajs/react';
import { Auth } from '@/types';
import CutiChart from '@/components/cuti-chart';

interface RiwayatCuti {
    jenis_cuti: string;
    tanggal_mulai: string;
    tanggal_selesai: string;
    status: 'Disetujui' | 'Menunggu' | 'Ditolak';
    alasan: string;
}

interface UserCutiProps {
    auth: Auth;
    sisaCuti?: number;
    riwayatCuti?: RiwayatCuti[];
}

export default function UserCutiPage({ auth, sisaCuti = 12, riwayatCuti = [] }: UserCutiProps) {
    const [showPanduan, setShowPanduan] = useState(false);
    const fileInputRef = useRef<HTMLInputElement>(null);

    // Form handling using Inertia useForm
    const { data, setData, post, processing, errors, reset } = useForm({
        jenis_cuti: 'Tahunan',
        tanggal_mulai: '',
        tanggal_selesai: '',
        alasan: '',
        bukti_pengajuan: null as File | null,
    });

    // Mockup submit handler
    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // post(route('cuti.store'), { onSuccess: () => reset() });
        alert('Pengajuan cuti berhasil disimulasikan!');
        reset();
        if (fileInputRef.current) {
            fileInputRef.current.value = '';
        }
    };

    const pegawai: any = auth.user;
    const namaPegawai = pegawai.nama || pegawai.name || 'Pegawai';

    return (
        <div className="min-h-screen bg-green-600 font-sans text-white pb-10">
            <Head title="Cuti Pegawai - Dinkes Kalbar" />

            {/* HEADER */}
            <div className="bg-white text-primary p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold">Pengajuan Cuti</h1>
                    <span className="text-xs">Halo, {namaPegawai}!</span>
                </div>
                <div className="space-x-2">
                    <button
                        onClick={() => setShowPanduan(true)}
                        className="bg-green-500 text-white px-4 py-2 rounded text-sm hover:bg-green-600 transition"
                    >
                        Panduan Cuti
                    </button>
                </div>
            </div>

            {/* KONTEN UTAMA */}
            <div className="max-w-6xl mx-auto mt-6 space-y-6 px-4 md:px-0">
                {/* GRAFIK CUTI */}
                <CutiChart />

                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {/* FORM PENGAJUAN */}
                    <div className="md:col-span-1 bg-white text-gray-800 p-6 rounded-lg shadow h-fit">
                        <div className="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 className="text-lg font-bold text-green-700">FORM PENGAJUAN</h2>
                            <span className="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">
                                Sisa Cuti: {sisaCuti} Hari
                            </span>
                        </div>

                        <form onSubmit={handleSubmit} className="space-y-4">
                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Jenis Cuti</label>
                                <select
                                    className="w-full border-gray-300 rounded focus:ring-green-500 focus:border-green-500 text-sm"
                                    value={data.jenis_cuti}
                                    onChange={(e) => setData('jenis_cuti', e.target.value)}
                                >
                                    <option value="Tahunan">Cuti Tahunan</option>
                                    <option value="Sakit">Cuti Sakit</option>
                                    <option value="Alasan Penting">Cuti Alasan Penting</option>
                                    <option value="Melahirkan">Cuti Melahirkan</option>
                                    <option value="Besar">Cuti Besar</option>
                                </select>
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Tanggal Mulai</label>
                                <input
                                    type="date"
                                    className="w-full border-gray-300 rounded focus:ring-green-500 focus:border-green-500 text-sm"
                                    value={data.tanggal_mulai}
                                    onChange={(e) => setData('tanggal_mulai', e.target.value)}
                                    required
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Tanggal Selesai</label>
                                <input
                                    type="date"
                                    className="w-full border-gray-300 rounded focus:ring-green-500 focus:border-green-500 text-sm"
                                    value={data.tanggal_selesai}
                                    onChange={(e) => setData('tanggal_selesai', e.target.value)}
                                    required
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Alasan Cuti</label>
                                <textarea
                                    className="w-full border-gray-300 rounded focus:ring-green-500 focus:border-green-500 text-sm"
                                    rows={3}
                                    placeholder="Jelaskan alasan cuti..."
                                    value={data.alasan}
                                    onChange={(e) => setData('alasan', e.target.value)}
                                    required
                                ></textarea>
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Bukti Pengajuan (Opsional)</label>
                                <div className="flex items-center gap-2">
                                    <input
                                        type="file"
                                        ref={fileInputRef}
                                        className="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                        onChange={(e) => setData('bukti_pengajuan', e.target.files && e.target.files.length > 0 ? e.target.files[0] : null)}
                                        accept=".pdf,.jpg,.jpeg,.png"
                                    />
                                    {data.bukti_pengajuan && (
                                        <button
                                            type="button"
                                            onClick={() => {
                                                setData('bukti_pengajuan', null);
                                                if (fileInputRef.current) {
                                                    fileInputRef.current.value = '';
                                                }
                                            }}
                                            className="text-xs bg-red-100 text-red-600 font-semibold px-3 py-2 rounded-md hover:bg-red-200 transition whitespace-nowrap"
                                        >
                                            Hapus File
                                        </button>
                                    )}
                                </div>
                                <p className="text-xs text-gray-500 mt-1">Format: PDF, JPG, PNG. Maks: 2MB.</p>
                            </div>

                            <button
                                type="submit"
                                disabled={processing}
                                className="w-full bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition disabled:opacity-50"
                            >
                                Kirim Pengajuan
                            </button>
                        </form>
                    </div>

                    {/* RIWAYAT CUTI */}
                    <div className="md:col-span-2 bg-white text-gray-800 p-6 rounded-lg shadow">
                        <h2 className="text-lg font-bold border-b pb-2 mb-4 text-green-700">RIWAYAT CUTI SAYA</h2>

                        {riwayatCuti.length === 0 ? (
                            <div className="text-center py-10">
                                <p className="text-gray-500 italic">Belum ada riwayat pengajuan cuti.</p>
                            </div>
                        ) : (
                            <div className="overflow-x-auto">
                                <table className="w-full text-sm text-left">
                                    <thead className="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th className="px-4 py-3 rounded-tl-lg">Jenis Cuti</th>
                                            <th className="px-4 py-3">Tanggal</th>
                                            <th className="px-4 py-3">Alasan</th>
                                            <th className="px-4 py-3 rounded-tr-lg">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {riwayatCuti.map((cuti, idx) => (
                                            <tr key={idx} className="border-b last:border-0 hover:bg-gray-50">
                                                <td className="px-4 py-3 font-semibold">{cuti.jenis_cuti}</td>
                                                <td className="px-4 py-3 text-gray-600">
                                                    {cuti.tanggal_mulai} s/d {cuti.tanggal_selesai}
                                                </td>
                                                <td className="px-4 py-3 text-gray-600">{cuti.alasan}</td>
                                                <td className="px-4 py-3">
                                                    <span className={`px-2 py-1 rounded text-xs font-bold ${cuti.status === 'Disetujui' ? 'bg-green-100 text-green-800' :
                                                            cuti.status === 'Ditolak' ? 'bg-red-100 text-red-800' :
                                                                'bg-yellow-100 text-yellow-800'
                                                        }`}>
                                                        {cuti.status}
                                                    </span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </div>
                </div>
            </div>

            {/* POPUP PANDUAN */}
            {showPanduan && (
                <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4 z-50">
                    <div className="bg-white text-gray-800 w-full max-w-2xl rounded-lg p-6 max-h-[80vh] overflow-y-auto">
                        <h3 className="text-xl font-bold text-green-700 mb-4">PANDUAN PENGAJUAN CUTI</h3>
                        <div className="text-sm space-y-3">
                            <p><strong>1. Sisa Cuti Tahunan</strong><br />Pastikan Anda masih memiliki sisa cuti tahunan sebelum mengajukan Cuti Tahunan.</p>
                            <p><strong>2. Proses Persetujuan</strong><br />Setiap pengajuan cuti akan masuk ke status "Menunggu" dan harus disetujui oleh Kepala Unit terkait sebelum sah digunakan.</p>
                            <p><strong>3. Cuti Sakit</strong><br />Untuk Cuti Sakit lebih dari 1 hari, biasanya diwajibkan melampirkan surat keterangan dokter ke bagian Kepegawaian.</p>
                        </div>
                        <button
                            onClick={() => setShowPanduan(false)}
                            className="mt-6 bg-gray-200 text-gray-800 font-bold px-4 py-2 rounded hover:bg-gray-300 w-full transition"
                        >
                            Tutup Panduan
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
}