import React, { useState, useRef } from 'react';
import { Head, useForm } from '@inertiajs/react';
import { Auth } from '@/types';
import { Info } from 'lucide-react';
import { toast } from 'sonner';
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

export default function UserCutiPage({ auth, sisaCuti = 24, riwayatCuti = [] }: UserCutiProps) {
    const [showPanduan, setShowPanduan] = useState(false);
    const [localSisaCuti, setLocalSisaCuti] = useState(sisaCuti); // Maksimal 24 Hari
    const fileInputRef = useRef<HTMLInputElement>(null);

    // Form handling using Inertia useForm
    const { data, setData, post, processing, errors, reset } = useForm({
        jenis_cuti: 'Tahunan',
        tanggal_mulai: '',
        tanggal_selesai: '',
        alasan: '',
        bukti_pengajuan: null as File | null,
    });

    // Helper untuk menghitung hari kerja (mengabaikan akhir pekan)
    const getWorkingDays = (startDate: string, endDate: string) => {
        if (!startDate || !endDate) return 0;
        let count = 0;
        const curDate = new Date(startDate);
        const end = new Date(endDate);
        while (curDate <= end) {
            const dayOfWeek = curDate.getDay();
            if (dayOfWeek !== 0 && dayOfWeek !== 6) count++; // 0 = Minggu, 6 = Sabtu
            curDate.setDate(curDate.getDate() + 1);
        }
        return count;
    };

    // Mockup submit handler
    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        
        let potong = 0;
        if (data.jenis_cuti === 'Tahunan' && data.tanggal_mulai && data.tanggal_selesai) {
            const workDays = getWorkingDays(data.tanggal_mulai, data.tanggal_selesai);
            potong = workDays > 6 ? 6 : workDays;
        }

        if (potong > 0 && localSisaCuti - potong < 0) {
            toast.error('Sisa cuti tidak mencukupi!');
            return;
        }

        setLocalSisaCuti(prev => prev - potong);
        
        toast.success(`Pengajuan cuti berhasil! Jatah cuti dipotong ${potong} hari kerja.`);
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

                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {/* FORM PENGAJUAN */}
                    <div className="md:col-span-1 bg-white text-gray-800 p-6 rounded-lg shadow h-fit">
                        <div className="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 className="text-lg font-bold text-primary">FORM PENGAJUAN</h2>
                            <span className="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                Sisa: {localSisaCuti} Hari
                            </span>
                        </div>

                        <form onSubmit={handleSubmit} className="space-y-4">
                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Jenis Cuti</label>
                                <select
                                    className="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3"
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
                                    className="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3"
                                    value={data.tanggal_mulai}
                                    onChange={(e) => setData('tanggal_mulai', e.target.value)}
                                    required
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Tanggal Selesai</label>
                                <input
                                    type="date"
                                    className="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3"
                                    value={data.tanggal_selesai}
                                    onChange={(e) => setData('tanggal_selesai', e.target.value)}
                                    required
                                />
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Alasan Cuti</label>
                                <textarea
                                    className="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3"
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
                        <h2 className="text-lg font-bold border-b pb-2 mb-4 text-primary">RIWAYAT CUTI SAYA</h2>

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
                <div className="fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4 z-50">
                    <div className="bg-white text-gray-800 w-full max-w-lg rounded-xl p-6 shadow-2xl max-h-[80vh] overflow-y-auto transform transition-all">
                        <div className="flex items-center gap-3 mb-5 border-b pb-4">
                            <div className="bg-green-100 p-2 rounded-full">
                                <Info className="w-6 h-6 text-green-600" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-800">Panduan Pengajuan Cuti</h3>
                        </div>
                        <div className="text-sm space-y-4 text-gray-600">
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">1</span>
                                    Sisa Cuti Tahunan
                                </strong>
                                Pastikan Anda masih memiliki sisa cuti tahunan sebelum mengajukan Cuti Tahunan.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">2</span>
                                    Proses Persetujuan
                                </strong>
                                Setiap pengajuan cuti akan masuk ke status "Menunggu" dan harus disetujui oleh Kepala Unit terkait sebelum sah digunakan.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">3</span>
                                    Cuti Sakit
                                </strong>
                                Untuk Cuti Sakit lebih dari 1 hari, biasanya diwajibkan melampirkan surat keterangan dokter ke bagian Kepegawaian.
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