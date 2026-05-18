import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import { Auth } from '@/types';
import { MapPin, CalendarDays, FileText, Send, Info } from 'lucide-react';
import { toast } from 'sonner';

interface RiwayatDinasLuar {
    tujuan: string;
    tanggal_dinas: string;
    tanggal_selesai: string;
    status: 'Disetujui' | 'Menunggu' | 'Ditolak';
    keterangan: string;
}

interface UserDinasLuarProps {
    auth: Auth;
    riwayatDinas?: RiwayatDinasLuar[];
}

export default function UserDinasLuarPage({ auth, riwayatDinas = [] }: UserDinasLuarProps) {
    const [showPanduan, setShowPanduan] = useState(false);

    // Form handling using Inertia useForm
    const { data, setData, post, processing, errors, reset, clearErrors } = useForm({
        tanggal_dinas: '',
        tanggal_selesai: '',
        tujuan: '',
        keterangan: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/dinas-luar', {
            onSuccess: () => {
                toast.success('Pengajuan dinas luar berhasil disimpan!');
                reset();
            },
            onError: () => {
                toast.error('Gagal menyimpan, periksa kembali form!');
            }
        });
    };

    const pegawai: any = auth.user;
    const namaPegawai = pegawai?.nama || pegawai?.name || 'Pegawai';

    return (
        <div className="min-h-screen bg-green-600 font-sans text-white pb-10">
            <Head title="Dinas Luar - Dinkes Kalbar" />

            {/* HEADER */}
            <div className="bg-white text-primary p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold">Jadwal Dinas Luar</h1>
                    <span className="text-xs text-gray-500">Halo, {namaPegawai}!</span>
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

                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {/* FORM INPUT DINAS LUAR */}
                    <div className="md:col-span-1 bg-white text-gray-800 p-6 rounded-lg shadow h-fit border-t-4 border-green-600">
                        <div className="flex justify-between items-center border-b pb-3 mb-5">
                            <h2 className="text-lg font-bold text-primary flex items-center gap-2">
                                <MapPin className="w-5 h-5" />
                                INPUT JADWAL
                            </h2>
                        </div>

                        <form onSubmit={handleSubmit} className="space-y-5">
                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Tanggal Mulai</label>
                                <div className="relative">
                                    <input
                                        type="date"
                                        className={`w-full pl-10 border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 ${errors.tanggal_dinas ? 'border-red-500' : ''}`}
                                        value={data.tanggal_dinas}
                                        onChange={(e) => {
                                            setData('tanggal_dinas', e.target.value);
                                            clearErrors('tanggal_dinas');
                                        }}
                                        required
                                    />
                                    <CalendarDays className="w-4 h-4 absolute left-3 top-3 text-gray-400" />
                                </div>
                                {errors.tanggal_dinas && <p className="text-red-500 text-xs mt-1">{errors.tanggal_dinas}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Tanggal Selesai</label>
                                <div className="relative">
                                    <input
                                        type="date"
                                        className={`w-full pl-10 border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 ${errors.tanggal_selesai ? 'border-red-500' : ''}`}
                                        value={data.tanggal_selesai}
                                        onChange={(e) => {
                                            setData('tanggal_selesai', e.target.value);
                                            clearErrors('tanggal_selesai');
                                        }}
                                        required
                                    />
                                    <CalendarDays className="w-4 h-4 absolute left-3 top-3 text-gray-400" />
                                </div>
                                {errors.tanggal_selesai && <p className="text-red-500 text-xs mt-1">{errors.tanggal_selesai}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Tujuan / Lokasi</label>
                                <div className="relative">
                                    <input
                                        type="text"
                                        placeholder="Contoh: Jakarta / Kemenkes RI"
                                        className={`w-full pl-10 border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 ${errors.tujuan ? 'border-red-500' : ''}`}
                                        value={data.tujuan}
                                        onChange={(e) => {
                                            setData('tujuan', e.target.value);
                                            clearErrors('tujuan');
                                        }}
                                        required
                                    />
                                    <MapPin className="w-4 h-4 absolute left-3 top-3 text-gray-400" />
                                </div>
                                {errors.tujuan && <p className="text-red-500 text-xs mt-1">{errors.tujuan}</p>}
                            </div>

                            <div>
                                <label className="block text-sm font-semibold mb-1 text-gray-700">Keterangan / Agenda</label>
                                <div className="relative">
                                    <textarea
                                        className={`w-full pl-10 border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 ${errors.keterangan ? 'border-red-500' : ''}`}
                                        rows={3}
                                        placeholder="Jelaskan agenda dinas luar..."
                                        value={data.keterangan}
                                        onChange={(e) => {
                                            setData('keterangan', e.target.value);
                                            clearErrors('keterangan');
                                        }}
                                    ></textarea>
                                    <FileText className="w-4 h-4 absolute left-3 top-3 text-gray-400" />
                                </div>
                                {errors.keterangan && <p className="text-red-500 text-xs mt-1">{errors.keterangan}</p>}
                            </div>

                            <button
                                type="submit"
                                disabled={processing}
                                className="w-full bg-green-600 text-white font-bold py-2.5 px-4 rounded hover:bg-green-700 transition flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <Send className="w-4 h-4" />
                                {processing ? 'Menyimpan...' : 'Simpan Jadwal'}
                            </button>
                        </form>
                    </div>

                    {/* RIWAYAT DINAS LUAR */}
                    <div className="md:col-span-2 bg-white text-gray-800 p-6 rounded-lg shadow border-t-4 border-gray-200">
                        <div className="flex justify-between items-center border-b pb-3 mb-5">
                            <h2 className="text-lg font-bold text-gray-700 flex items-center gap-2">
                                <CalendarDays className="w-5 h-5" />
                                RIWAYAT DINAS LUAR
                            </h2>
                        </div>

                        {riwayatDinas.length === 0 ? (
                            <div className="text-center py-16 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <MapPin className="w-12 h-12 text-gray-300 mx-auto mb-3" />
                                <p className="text-gray-500 font-medium">Belum ada riwayat jadwal dinas luar.</p>
                                <p className="text-gray-400 text-sm mt-1">Silakan input jadwal dinas luar Anda pada form di samping.</p>
                            </div>
                        ) : (
                            <div className="overflow-x-auto rounded-lg border border-gray-200">
                                <table className="w-full text-sm text-left">
                                    <thead className="bg-gray-50 text-gray-700 border-b border-gray-200">
                                        <tr>
                                            <th className="px-4 py-3.5 font-semibold">Tujuan</th>
                                            <th className="px-4 py-3.5 font-semibold">Tanggal</th>
                                            <th className="px-4 py-3.5 font-semibold">Keterangan</th>
                                            <th className="px-4 py-3.5 font-semibold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y divide-gray-100">
                                        {riwayatDinas.map((dinas, idx) => (
                                            <tr key={idx} className="hover:bg-green-50/50 transition-colors">
                                                <td className="px-4 py-3 font-semibold text-gray-800">{dinas.tujuan}</td>
                                                <td className="px-4 py-3 text-gray-600 whitespace-nowrap">
                                                    <span className="font-medium">{dinas.tanggal_dinas}</span>
                                                    {dinas.tanggal_selesai && dinas.tanggal_selesai !== dinas.tanggal_dinas && (
                                                        <> <br /><span className="text-xs text-gray-400">s/d</span> <span className="font-medium">{dinas.tanggal_selesai}</span></>
                                                    )}
                                                </td>
                                                <td className="px-4 py-3 text-gray-600">{dinas.keterangan || '-'}</td>
                                                <td className="px-4 py-3">
                                                    <span className={`px-2.5 py-1 rounded-md text-xs font-bold whitespace-nowrap ${dinas.status === 'Disetujui' ? 'bg-green-100 text-green-800 border border-green-200' :
                                                            dinas.status === 'Ditolak' ? 'bg-red-100 text-red-800 border border-red-200' :
                                                                'bg-amber-100 text-amber-800 border border-amber-200'
                                                        }`}>
                                                        {dinas.status}
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
                            <h3 className="text-xl font-bold text-gray-800">Panduan Dinas Luar</h3>
                        </div>
                        <div className="text-sm space-y-4 text-gray-600">
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">1</span>
                                    Input Tujuan
                                </strong>
                                Pastikan tujuan / lokasi dinas luar diisi dengan lengkap dan jelas.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">2</span>
                                    Tanggal Dinas
                                </strong>
                                Jika dinas luar hanya 1 hari, samakan Tanggal Mulai dan Tanggal Selesai.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">3</span>
                                    Status
                                </strong>
                                Setiap input jadwal baru akan berstatus "Menunggu" hingga disetujui.
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
