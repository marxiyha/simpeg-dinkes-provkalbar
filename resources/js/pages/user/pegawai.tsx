import React, { useState, useRef } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import { Auth } from '@/types';
import { Plus, Edit, Trash2, X, Download, Upload, Users, Info, Eye, Briefcase, Building, Calendar, GraduationCap, User as UserIcon, Mail, Clock, TrendingUp, ShieldAlert, AlertTriangle } from 'lucide-react';
import { toast } from 'sonner';

interface User {
    id: number;
    name: string;
    email: string;
    nip: string | null;
    tanggal_lahir: string | null;
    jenis_kelamin: string | null;
    pendidikan_terakhir: string | null;
    jabatan: string | null;
    status_pegawai: string | null;
    tmt_pegawai: string | null;
    tmt_pensiun: string | null;
    batas_usia_pensiun: number | null;
    perkiraan_naik_jabatan: string | null;
    perkiraan_naik_gaji: string | null;
    unit_kerja?: {
        nama_unit: string;
    } | null;
}

interface UnitKerja {
    id_unit: number;
    nama_unit: string;
}

interface UserPegawaiProps {
    auth: Auth;
    users: User[];
    unitKerjas: UnitKerja[];
}

export default function UserPegawai({ auth, users, unitKerjas }: UserPegawaiProps) {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [editingUser, setEditingUser] = useState<User | null>(null);
    const [isImportModalOpen, setIsImportModalOpen] = useState(false);
    const [showPanduan, setShowPanduan] = useState(false);
    const [filterText, setFilterText] = useState('');
    const [filterStatus, setFilterStatus] = useState('');
    const [filterUnit, setFilterUnit] = useState('');
    const fileInputRef = useRef<HTMLInputElement>(null);

    const [selectedUserForView, setSelectedUserForView] = useState<User | null>(null);
    const [isViewModalOpen, setIsViewModalOpen] = useState(false);
    const [selectedUserForDelete, setSelectedUserForDelete] = useState<User | null>(null);
    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);

    const formatDate = (dateStr: string | null) => {
        if (!dateStr) return 'Belum Diisi';
        try {
            const date = new Date(dateStr);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        } catch (e) {
            return dateStr;
        }
    };

    const executeDelete = () => {
        if (!selectedUserForDelete) return;

        if (selectedUserForDelete.id === auth.user.id) {
            toast.error('Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan untuk login!');
            setIsDeleteModalOpen(false);
            setSelectedUserForDelete(null);
            return;
        }

        destroy(`/pegawai/${selectedUserForDelete.id}`, {
            onSuccess: () => {
                toast.success('Data pegawai berhasil dihapus!');
                setIsDeleteModalOpen(false);
                setSelectedUserForDelete(null);
            },
            onError: () => {
                toast.error('Gagal menghapus data pegawai!');
                setIsDeleteModalOpen(false);
                setSelectedUserForDelete(null);
            },
        });
    };

    // Data dari auth (Inertia mengirim data user yang sedang login)
    // Cast to any to handle custom mockup fields safely for now
    const pegawai: any = auth.user;

    const namaPegawai = pegawai.nama || pegawai.name || 'Pegawai';
    const { data, setData, post, put, delete: destroy, processing, errors, reset, clearErrors } = useForm({
        name: '',
        email: '',
        nip: '',
        id_unit: '',
        tanggal_lahir: '',
        jenis_kelamin: '',
        pendidikan_terakhir: '',
        jabatan: '',
        status_pegawai: '',
        tmt_pegawai: '',
        tmt_pensiun: '',
        batas_usia_pensiun: '',
        perkiraan_naik_jabatan: '',
        perkiraan_naik_gaji: '',
    });

    const { data: importData, setData: setImportData, post: postImport, processing: importProcessing, reset: resetImport } = useForm({
        file: null as File | null,
    });

    const openModal = (user: User | null = null) => {
        clearErrors();
        if (user) {
            setEditingUser(user);
            setData({
                name: user.name,
                email: user.email,
                nip: user.nip || '',
                id_unit: user.unit_kerja ? String((user as any).id_unit) : '',
                tanggal_lahir: user.tanggal_lahir || '',
                jenis_kelamin: user.jenis_kelamin || '',
                pendidikan_terakhir: user.pendidikan_terakhir || '',
                jabatan: user.jabatan || '',
                status_pegawai: user.status_pegawai || '',
                tmt_pegawai: user.tmt_pegawai || '',
                tmt_pensiun: user.tmt_pensiun || '',
                batas_usia_pensiun: user.batas_usia_pensiun ? String(user.batas_usia_pensiun) : '',
                perkiraan_naik_jabatan: user.perkiraan_naik_jabatan || '',
                perkiraan_naik_gaji: user.perkiraan_naik_gaji || '',
            });
        } else {
            setEditingUser(null);
            reset();
        }
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
        reset();
        clearErrors();
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        if (editingUser) {
            put(`/pegawai/${editingUser.id}`, {
                onSuccess: () => {
                    closeModal();
                    toast.success('Data pegawai berhasil diperbarui!');
                },
                onError: () => toast.error('Gagal memperbarui, periksa kembali form!'),
            });
        } else {
            post('/pegawai', {
                onSuccess: () => {
                    closeModal();
                    toast.success('Data pegawai berhasil ditambahkan!');
                },
                onError: () => toast.error('Gagal menyimpan, periksa kembali form!'),
            });
        }
    };

    const handleDelete = (user: User) => {
        if (confirm(`Apakah Anda yakin ingin menghapus data pegawai ${user.name}?`)) {
            destroy(`/pegawai/${user.id}`, {
                onSuccess: () => toast.success('Data pegawai berhasil dihapus!'),
                onError: () => toast.error('Gagal menghapus data pegawai!'),
            });
        }
    };

    const handleImportSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        postImport('/pegawai/import', {
            onSuccess: () => {
                setIsImportModalOpen(false);
                resetImport();
                toast.success('Data pegawai berhasil diimpor!');
            },
            onError: () => toast.error('Gagal mengimpor, pastikan file sesuai format!'),
        });
    };

    const inputClass = (error?: string) => `w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 bg-white ${error ? 'border-red-500 ring-1 ring-red-500' : ''}`;

    // Jabatan options grouped by batas usia pensiun
    const jabatanOptions = [
        {
            group: '58 Tahun', items: [
                'Eselon III', 'Eselon IV', 'Eselon V',
                'Fungsional Ahli Muda', 'Fungsional Ahli Pertama',
                'Fungsional Pemula', 'Fungsional Terampil', 'Fungsional Mahir', 'Fungsional Penyelia',
                'Pelaksana / Staf',
            ]
        },
        {
            group: '60 Tahun', items: [
                'Eselon I', 'Eselon II',
                'Fungsional Ahli Madya',
            ]
        },
        {
            group: '65 Tahun', items: [
                'Fungsional Ahli Utama',
            ]
        },
    ];

    const getBatasUsia = (jabatan: string): number => {
        const j58 = ['Eselon III', 'Eselon IV', 'Eselon V', 'Fungsional Ahli Muda', 'Fungsional Ahli Pertama', 'Fungsional Pemula', 'Fungsional Terampil', 'Fungsional Mahir', 'Fungsional Penyelia', 'Pelaksana / Staf'];
        const j60 = ['Eselon I', 'Eselon II', 'Fungsional Ahli Madya'];
        const j65 = ['Fungsional Ahli Utama'];
        if (j58.includes(jabatan)) return 58;
        if (j60.includes(jabatan)) return 60;
        if (j65.includes(jabatan)) return 65;
        return 0;
    };

    const calcTmtPensiun = (tglLahir: string, batasUsia: number): string => {
        if (!tglLahir || !batasUsia) return '';
        const lahir = new Date(tglLahir);
        const pensiun = new Date(lahir.getFullYear() + batasUsia, lahir.getMonth(), 1);
        return pensiun.toISOString().split('T')[0];
    };

    const handleJabatanChange = (jabatan: string) => {
        const batas = getBatasUsia(jabatan);
        const tmt = calcTmtPensiun(data.tanggal_lahir, batas);
        const naikGaji = calcNaikGaji(data.tmt_pegawai, data.status_pegawai);
        const naikJabatan = calcNaikJabatan(data.tmt_pegawai, data.status_pegawai);
        setData(prev => ({ ...prev, jabatan, batas_usia_pensiun: batas ? String(batas) : '', tmt_pensiun: tmt, perkiraan_naik_gaji: naikGaji, perkiraan_naik_jabatan: naikJabatan }));
    };

    const handleTanggalLahirChange = (tglLahir: string) => {
        const batas = getBatasUsia(data.jabatan);
        const tmt = calcTmtPensiun(tglLahir, batas);
        setData(prev => ({ ...prev, tanggal_lahir: tglLahir, tmt_pensiun: tmt }));
    };

    // Auto-calc perkiraan naik gaji (2026-2029)
    // PNS: setiap 2 tahun | PPPK: 3 tahun pertama, lalu 2 tahun
    const calcNaikGaji = (tmtPegawai: string, status: string): string => {
        if (!tmtPegawai || !status) return '';
        const tmt = new Date(tmtPegawai);
        const tmtYear = tmt.getFullYear();
        const results: number[] = [];
        if (status === 'PNS') {
            for (let y = tmtYear + 2; y <= 2029; y += 2) {
                if (y >= 2026) results.push(y);
            }
        } else if (status === 'PPPK') {
            let firstKenaikan = tmtYear + 3;
            if (firstKenaikan >= 2026 && firstKenaikan <= 2029) results.push(firstKenaikan);
            for (let y = firstKenaikan + 2; y <= 2029; y += 2) {
                if (y >= 2026) results.push(y);
            }
        }
        return results.length > 0 ? results.join(', ') : '-';
    };

    // Auto-calc perkiraan naik jabatan (2026-2029) - setiap 4 tahun
    const calcNaikJabatan = (tmtPegawai: string, status: string): string => {
        if (!tmtPegawai || !status) return '';
        const tmt = new Date(tmtPegawai);
        const tmtYear = tmt.getFullYear();
        const results: number[] = [];
        for (let y = tmtYear + 4; y <= 2029; y += 4) {
            if (y >= 2026) results.push(y);
        }
        return results.length > 0 ? results.join(', ') : '-';
    };

    const handleTmtPegawaiChange = (tmtPegawai: string) => {
        const naikGaji = calcNaikGaji(tmtPegawai, data.status_pegawai);
        const naikJabatan = calcNaikJabatan(tmtPegawai, data.status_pegawai);
        setData(prev => ({ ...prev, tmt_pegawai: tmtPegawai, perkiraan_naik_gaji: naikGaji, perkiraan_naik_jabatan: naikJabatan }));
    };

    const handleStatusPegawaiChange = (status: string) => {
        const naikGaji = calcNaikGaji(data.tmt_pegawai, status);
        const naikJabatan = calcNaikJabatan(data.tmt_pegawai, status);
        setData(prev => ({ ...prev, status_pegawai: status, perkiraan_naik_gaji: naikGaji, perkiraan_naik_jabatan: naikJabatan }));
    };

    // Filter logic
    const filteredUsers = users.filter(user => {
        const matchText = !filterText ||
            user.name.toLowerCase().includes(filterText.toLowerCase()) ||
            (user.nip && user.nip.includes(filterText)) ||
            (user.jabatan && user.jabatan.toLowerCase().includes(filterText.toLowerCase())) ||
            (user.unit_kerja?.nama_unit && user.unit_kerja.nama_unit.toLowerCase().includes(filterText.toLowerCase()));
        const matchStatus = !filterStatus || user.status_pegawai === filterStatus;
        const matchUnit = !filterUnit || String((user as any).id_unit) === filterUnit;
        return matchText && matchStatus && matchUnit;
    });

    return (
        <div className="min-h-screen bg-green-600 font-sans text-white pb-10">
            <Head title="Data Pegawai - Dinkes Kalbar" />

            {/* HEADER */}
            <div className="bg-white text-primary p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold">Data Pegawai</h1>
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
            <div className="max-w-full xl:max-w-[92rem] mx-auto mt-6 space-y-6 px-4">

                <div className="bg-white p-6 rounded-lg shadow h-fit border-t-4 border-green-700">
                    <div className="flex flex-col md:flex-row justify-between items-center mb-6 border-b pb-4 gap-4">
                        <h2 className="text-lg font-bold text-primary flex items-center gap-2">
                            <Users className="w-5 h-5" />
                            DAFTAR PEGAWAI
                        </h2>
                        <div className="flex gap-2 flex-wrap">
                            <button
                                onClick={() => setIsImportModalOpen(true)}
                                className="bg-white border border-green-600 text-green-700 px-4 py-2 rounded-lg text-sm hover:bg-green-50 transition flex items-center gap-2 font-bold"
                            >
                                <Upload className="w-4 h-4" />
                                Import
                            </button>
                            <a
                                href="/pegawai/export"
                                className="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600 transition flex items-center gap-2 font-bold"
                            >
                                <Download className="w-4 h-4" />
                                Export CSV
                            </a>
                            <button
                                onClick={() => openModal()}
                                className="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center gap-2 font-bold"
                            >
                                <Plus className="w-4 h-4" />
                                Tambah Data Pegawai
                            </button>
                        </div>
                    </div>

                    {/* Filter controls */}
                    <div className="flex flex-col md:flex-row gap-4 mb-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div className="flex-1">
                            <label className="block text-sm font-bold text-gray-700 mb-1">Cari Pegawai</label>
                            <input
                                type="text"
                                placeholder="Cari nama, NIP, jabatan, atau unit..."
                                className="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 bg-white text-gray-800 placeholder-gray-400"
                                value={filterText}
                                onChange={(e) => setFilterText(e.target.value)}
                            />
                        </div>
                        <div className="md:w-72">
                            <label className="block text-sm font-bold text-gray-700 mb-1">Filter Unit Kerja</label>
                            <select
                                className="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 bg-white text-gray-800"
                                value={filterUnit}
                                onChange={(e) => setFilterUnit(e.target.value)}
                            >
                                <option value="">Semua Unit Kerja</option>
                                {unitKerjas && unitKerjas.map(unit => (
                                    <option key={unit.id_unit} value={String(unit.id_unit)}>{unit.nama_unit}</option>
                                ))}
                            </select>
                        </div>
                        <div className="md:w-48">
                            <label className="block text-sm font-bold text-gray-700 mb-1">Filter Status</label>
                            <select
                                className="w-full border-green-300 rounded-md focus:ring-green-500 focus:border-green-500 text-base py-2.5 px-3 bg-white text-gray-800"
                                value={filterStatus}
                                onChange={(e) => setFilterStatus(e.target.value)}
                            >
                                <option value="">Semua Status</option>
                                <option value="PNS">PNS</option>
                                <option value="PPPK">PPPK</option>
                            </select>
                        </div>
                    </div>

                    <div className="overflow-x-auto rounded-lg border border-gray-200">
                        <table className="w-full text-sm text-left">
                            <thead className="bg-green-50 text-green-800 border-b border-green-200">
                                <tr>
                                    <th className="px-4 py-3.5 font-semibold min-w-[180px]">Nama / NIP</th>
                                    <th className="px-4 py-3.5 font-semibold min-w-[200px]">Unit Kerja</th>
                                    <th className="px-4 py-3.5 font-semibold min-w-[180px]">Jabatan</th>
                                    <th className="px-4 py-3.5 font-semibold whitespace-nowrap">Status & TMT</th>
                                    <th className="px-4 py-3.5 font-semibold whitespace-nowrap">Naik Gaji (2026-29)</th>
                                    <th className="px-4 py-3.5 font-semibold whitespace-nowrap">Naik Jabatan (2026-29)</th>
                                    <th className="px-4 py-3.5 font-semibold text-right whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100 text-gray-700">
                                {filteredUsers.length === 0 ? (
                                    <tr>
                                        <td colSpan={5} className="text-center py-16 bg-gray-50 rounded-lg">
                                            <Users className="w-12 h-12 text-gray-300 mx-auto mb-3" />
                                            <p className="text-gray-500 font-medium">Belum ada data pegawai.</p>
                                        </td>
                                    </tr>
                                ) : (
                                    filteredUsers.map((user) => (
                                        <tr key={user.id} className="hover:bg-green-50/50 transition-colors">
                                            <td className="px-4 py-4 text-gray-800 whitespace-normal">
                                                <div className="font-bold">{user.name}</div>
                                                <div className="text-xs text-gray-500">{user.nip || 'NIP Belum Diisi'}</div>
                                            </td>
                                            <td className="px-4 py-4 text-gray-600 whitespace-normal">
                                                {user.unit_kerja?.nama_unit || '-'}
                                            </td>
                                            <td className="px-4 py-4 text-gray-600 whitespace-normal">
                                                {user.jabatan || '-'}
                                            </td>
                                            <td className="px-4 py-4 whitespace-nowrap">
                                                <div className="flex flex-col gap-1 items-start">
                                                    {user.status_pegawai ? (
                                                        <span className={`px-2.5 py-1 rounded-md text-xs font-bold ${user.status_pegawai === 'PNS' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-amber-100 text-amber-800 border border-amber-200'
                                                            }`}>
                                                            {user.status_pegawai}
                                                        </span>
                                                    ) : (
                                                        <span className="text-gray-400 text-xs">-</span>
                                                    )}
                                                    {user.tmt_pegawai && (
                                                        <span className="text-xs text-gray-500">TMT: {new Date(user.tmt_pegawai).toLocaleDateString('id-ID')}</span>
                                                    )}
                                                </div>
                                            </td>
                                            <td className="px-4 py-4 text-gray-600 whitespace-nowrap">
                                                {user.perkiraan_naik_gaji || '-'}
                                            </td>
                                            <td className="px-4 py-4 text-gray-600 whitespace-nowrap">
                                                {user.perkiraan_naik_jabatan || '-'}
                                            </td>
                                            <td className="px-4 py-4 text-right whitespace-nowrap">
                                                <div className="flex justify-end gap-2">
                                                    <button
                                                        onClick={() => {
                                                            setSelectedUserForView(user);
                                                            setIsViewModalOpen(true);
                                                        }}
                                                        className="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded transition"
                                                        title="Lihat Detail"
                                                    >
                                                        <Eye className="w-4 h-4" />
                                                    </button>
                                                    <button
                                                        onClick={() => openModal(user)}
                                                        className="p-2 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded transition"
                                                        title="Edit"
                                                    >
                                                        <Edit className="w-4 h-4" />
                                                    </button>
                                                    <button
                                                        onClick={() => {
                                                            setSelectedUserForDelete(user);
                                                            setIsDeleteModalOpen(true);
                                                        }}
                                                        className="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded transition"
                                                        title="Hapus"
                                                    >
                                                        <Trash2 className="w-4 h-4" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {/* MODAL FORM PEGAWAI */}
            {isModalOpen && (
                <div className="fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4 z-50">
                    <div className="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col text-gray-800">
                        <div className="px-6 py-4 border-b border-green-100 flex justify-between items-center bg-green-50">
                            <h3 className="font-bold text-lg text-green-800 flex items-center gap-2">
                                <Users className="w-5 h-5" />
                                {editingUser ? 'Edit Data Pegawai' : 'Penambahan Data Pegawai'}
                            </h3>
                            <button onClick={closeModal} className="text-green-600 hover:text-green-800">
                                <X className="w-5 h-5" />
                            </button>
                        </div>

                        <div className="p-6 overflow-y-auto flex-1 bg-white">
                            <form id="pegawaiForm" onSubmit={handleSubmit} className="space-y-6">

                                {/* PERSONAL INFO */}
                                <div>
                                    <h4 className="text-green-700 font-bold mb-3 border-b border-green-100 pb-2">Informasi Pribadi</h4>
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Nama Lengkap *</label>
                                            <input type="text" className={inputClass(errors.name)} value={data.name} onChange={e => setData('name', e.target.value)} required />
                                            {errors.name && <p className="text-red-500 text-xs mt-1">{errors.name}</p>}
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Email Pegawai *</label>
                                            <input type="email" className={inputClass(errors.email)} value={data.email} onChange={e => setData('email', e.target.value)} required />
                                            {errors.email && <p className="text-red-500 text-xs mt-1">{errors.email}</p>}
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">NIP</label>
                                            <input type="text" className={inputClass(errors.nip)} value={data.nip} onChange={e => setData('nip', e.target.value)} />
                                            {errors.nip && <p className="text-red-500 text-xs mt-1">{errors.nip}</p>}
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Tanggal Lahir</label>
                                            <input type="date" className={inputClass(errors.tanggal_lahir)} value={data.tanggal_lahir} onChange={e => handleTanggalLahirChange(e.target.value)} />
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Jenis Kelamin</label>
                                            <select className={inputClass(errors.jenis_kelamin)} value={data.jenis_kelamin} onChange={e => setData('jenis_kelamin', e.target.value)}>
                                                <option value="">-- Pilih --</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Pendidikan Terakhir</label>
                                            <input type="text" placeholder="Misal: S1 Kesehatan Masyarakat" className={inputClass(errors.pendidikan_terakhir)} value={data.pendidikan_terakhir} onChange={e => setData('pendidikan_terakhir', e.target.value)} />
                                        </div>
                                    </div>
                                </div>

                                {/* KEPEGAWAIAN INFO */}
                                <div>
                                    <h4 className="text-green-700 font-bold mb-3 border-b border-green-100 pb-2">Data Kepegawaian</h4>
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Unit Kerja</label>
                                            <select className={inputClass(errors.id_unit)} value={data.id_unit} onChange={e => setData('id_unit', e.target.value)}>
                                                <option value="">-- Pilih Unit Kerja --</option>
                                                {unitKerjas && unitKerjas.map(unit => (
                                                    <option key={unit.id_unit} value={unit.id_unit}>{unit.nama_unit}</option>
                                                ))}
                                            </select>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Jabatan</label>
                                            <select className={inputClass(errors.jabatan)} value={data.jabatan} onChange={e => handleJabatanChange(e.target.value)}>
                                                <option value="">-- Pilih Jabatan --</option>
                                                {jabatanOptions.map(group => (
                                                    <optgroup key={group.group} label={`Pensiun ${group.group}`}>
                                                        {group.items.map(item => (
                                                            <option key={item} value={item}>{item}</option>
                                                        ))}
                                                    </optgroup>
                                                ))}
                                            </select>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Status Pegawai</label>
                                            <select className={inputClass(errors.status_pegawai)} value={data.status_pegawai} onChange={e => handleStatusPegawaiChange(e.target.value)}>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="PNS">PNS</option>
                                                <option value="PPPK">PPPK</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">TMT Pegawai (Diangkat)</label>
                                            <input type="date" className={inputClass(errors.tmt_pegawai)} value={data.tmt_pegawai} onChange={e => handleTmtPegawaiChange(e.target.value)} />
                                            <p className="text-xs text-gray-400 mt-1">Digunakan untuk hitung naik gaji/jabatan</p>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Perkiraan Naik Jabatan</label>
                                            <input type="text" className={`${inputClass(errors.perkiraan_naik_jabatan)} bg-gray-50`} value={data.perkiraan_naik_jabatan} readOnly />
                                            <p className="text-xs text-gray-400 mt-1">Otomatis dari Status & TMT (2026-2029)</p>
                                        </div>
                                        <div>
                                            <label className="block text-sm font-semibold mb-1 text-gray-700">Perkiraan Naik Gaji</label>
                                            <input type="text" className={`${inputClass(errors.perkiraan_naik_gaji)} bg-gray-50`} value={data.perkiraan_naik_gaji} readOnly />
                                            <p className="text-xs text-gray-400 mt-1">Otomatis dari Status & TMT (2026-2029)</p>
                                        </div>
                                        <div className="grid grid-cols-2 gap-2">
                                            <div>
                                                <label className="block text-sm font-semibold mb-1 text-gray-700">TMT Pensiun</label>
                                                <input type="date" className={`${inputClass(errors.tmt_pensiun)} bg-gray-50`} value={data.tmt_pensiun} readOnly />
                                                <p className="text-xs text-gray-400 mt-1">Otomatis dari Tgl Lahir + Jabatan</p>
                                            </div>
                                            <div>
                                                <label className="block text-sm font-semibold mb-1 text-gray-700">Batas Usia (Thn)</label>
                                                <input type="number" className={`${inputClass(errors.batas_usia_pensiun)} bg-gray-50`} value={data.batas_usia_pensiun} readOnly />
                                                <p className="text-xs text-gray-400 mt-1">Otomatis dari Jabatan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div className="px-6 py-4 border-t border-green-100 bg-green-50 flex justify-end gap-2">
                            <button
                                type="button"
                                onClick={closeModal}
                                className="px-4 py-2.5 text-sm font-bold text-green-700 bg-white border border-green-300 rounded-lg hover:bg-green-100 transition"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                form="pegawaiForm"
                                disabled={processing}
                                className="px-4 py-2.5 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 transition disabled:opacity-50"
                            >
                                {processing ? 'Menyimpan...' : 'Simpan Data Pegawai'}
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* MODAL IMPORT EXCEL/CSV */}
            {isImportModalOpen && (
                <div className="fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4 z-50 text-gray-800">
                    <div className="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden flex flex-col">
                        <div className="px-6 py-4 border-b border-green-100 flex justify-between items-center bg-green-50">
                            <h3 className="font-bold text-lg text-green-700 flex items-center gap-2">
                                <Upload className="w-5 h-5" />
                                Import Data Pegawai
                            </h3>
                            <button onClick={() => setIsImportModalOpen(false)} className="text-gray-400 hover:text-gray-600">
                                <X className="w-5 h-5" />
                            </button>
                        </div>

                        <div className="p-6">
                            <form id="importForm" onSubmit={handleImportSubmit} className="space-y-4">
                                <div>
                                    <label className="block text-sm font-semibold mb-2 text-gray-700">Pilih File CSV/TXT</label>
                                    <input
                                        type="file"
                                        ref={fileInputRef}
                                        accept=".csv,.txt"
                                        className="w-full text-base py-2.5 text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-bold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                        onChange={(e) => setImportData('file', e.target.files && e.target.files.length > 0 ? e.target.files[0] : null)}
                                        required
                                    />
                                    <p className="text-xs text-gray-500 mt-3 bg-green-50 p-3 rounded-lg border border-green-200 text-green-800">
                                        Format wajib berurutan (Pisahkan dengan koma): <br />
                                        <b>Nama, Email, NIP, Unit Kerja (ID), Jabatan, Status Pegawai, Jenis Kelamin, Tanggal Lahir</b>.
                                    </p>
                                </div>
                            </form>
                        </div>

                        <div className="px-6 py-4 border-t border-green-100 bg-green-50 flex justify-end gap-2">
                            <button
                                type="button"
                                onClick={() => setIsImportModalOpen(false)}
                                className="px-4 py-2.5 text-sm font-bold text-green-700 bg-white border border-green-300 rounded-lg hover:bg-green-100 transition"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                form="importForm"
                                disabled={importProcessing || !importData.file}
                                className="px-4 py-2.5 text-sm font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 transition disabled:opacity-50"
                            >
                                {importProcessing ? 'Mengunggah...' : 'Mulai Import'}
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* POPUP PANDUAN */}
            {showPanduan && (
                <div className="fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4 z-50">
                    <div className="bg-white text-gray-800 w-full max-w-lg rounded-xl p-6 shadow-2xl max-h-[80vh] overflow-y-auto transform transition-all">
                        <div className="flex items-center gap-3 mb-5 border-b pb-4">
                            <div className="bg-green-100 p-2 rounded-full">
                                <Info className="w-6 h-6 text-green-600" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-800">Panduan Data Pegawai</h3>
                        </div>
                        <div className="text-sm space-y-4 text-gray-600">
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">1</span>
                                    Tambah Data
                                </strong>
                                Klik tombol "Tambah Data Pegawai" untuk menginput data pegawai baru. Isi seluruh informasi yang diperlukan.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">2</span>
                                    Import / Export
                                </strong>
                                Gunakan tombol Import untuk mengunggah data dari file CSV, atau Export untuk mengunduh seluruh data pegawai.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">3</span>
                                    Edit & Hapus
                                </strong>
                                Klik ikon pensil untuk mengedit data pegawai, atau ikon tempat sampah untuk menghapus.
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

            {/* MODAL VIEW DETAIL PEGAWAI */}
            {isViewModalOpen && selectedUserForView && (
                <div className="fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4 z-50 animate-in fade-in duration-200">
                    <div className="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden flex flex-col text-gray-800 animate-in zoom-in-95 duration-200">
                        {/* Header */}
                        <div className="px-6 py-5 border-b border-green-100 flex justify-between items-center bg-gradient-to-r from-green-50 to-emerald-50/50">
                            <h3 className="font-bold text-lg text-green-800 flex items-center gap-2">
                                <Eye className="w-5 h-5 text-green-600" />
                                Detail Lengkap Pegawai
                            </h3>
                            <button 
                                onClick={() => {
                                    setIsViewModalOpen(false);
                                    setSelectedUserForView(null);
                                }} 
                                className="text-green-600 hover:text-green-800 transition p-1 hover:bg-green-100 rounded-full"
                            >
                                <X className="w-5 h-5" />
                            </button>
                        </div>

                        {/* Body */}
                        <div className="p-6 overflow-y-auto flex-1 bg-white space-y-6">
                            {/* Profile Header Card */}
                            <div className="flex flex-col sm:flex-row items-center gap-5 p-5 bg-gradient-to-br from-green-50/80 via-emerald-50/30 to-white rounded-2xl border border-green-100">
                                <div className="bg-gradient-to-tr from-green-600 to-emerald-500 text-white font-bold text-2xl w-20 h-20 rounded-2xl flex items-center justify-center shadow-lg transform rotate-2 hover:rotate-0 transition duration-300">
                                    {selectedUserForView.name.split(' ').map((n) => n[0]).slice(0, 2).join('').toUpperCase()}
                                </div>
                                <div className="text-center sm:text-left space-y-1">
                                    <h4 className="text-xl font-bold text-gray-900">{selectedUserForView.name}</h4>
                                    <p className="text-sm font-medium text-gray-500 flex flex-wrap justify-center sm:justify-start gap-x-3 gap-y-1">
                                        <span className="flex items-center gap-1"><Mail className="w-4 h-4 text-green-600" /> {selectedUserForView.email}</span>
                                        {selectedUserForView.nip && (
                                            <span className="text-gray-300">|</span>
                                        )}
                                        {selectedUserForView.nip && (
                                            <span>NIP: {selectedUserForView.nip}</span>
                                        )}
                                    </p>
                                    <div className="pt-2 flex flex-wrap gap-2 justify-center sm:justify-start">
                                        {selectedUserForView.status_pegawai && (
                                            <span className={`px-3 py-1 rounded-full text-xs font-bold shadow-sm ${
                                                selectedUserForView.status_pegawai === 'PNS' 
                                                    ? 'bg-green-100 text-green-800 border border-green-200' 
                                                    : 'bg-amber-100 text-amber-800 border border-amber-200'
                                            }`}>
                                                {selectedUserForView.status_pegawai}
                                            </span>
                                        )}
                                        {selectedUserForView.jabatan && (
                                            <span className="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100 shadow-sm">
                                                {selectedUserForView.jabatan}
                                            </span>
                                        )}
                                    </div>
                                </div>
                            </div>

                            {/* Information Grid */}
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {/* Pribadi Section */}
                                <div className="space-y-4 bg-gray-50/50 p-5 rounded-2xl border border-gray-100">
                                    <h5 className="text-sm font-bold uppercase tracking-wider text-green-700 flex items-center gap-2 pb-2 border-b border-gray-200/60">
                                        <UserIcon className="w-4 h-4" /> Informasi Pribadi
                                    </h5>
                                    <div className="space-y-3 text-sm">
                                        <div className="grid grid-cols-3 py-1 border-b border-gray-100/50">
                                            <span className="text-gray-500 font-medium col-span-1 flex items-center gap-1.5">
                                                <Users className="w-4 h-4 text-green-600 inline" /> Jenis Kelamin
                                            </span>
                                            <span className="text-gray-800 font-semibold col-span-2">{selectedUserForView.jenis_kelamin || 'Belum Diisi'}</span>
                                        </div>
                                        <div className="grid grid-cols-3 py-1 border-b border-gray-100/50">
                                            <span className="text-gray-500 font-medium col-span-1 flex items-center gap-1.5">
                                                <Calendar className="w-4 h-4 text-green-600 inline" /> Tanggal Lahir
                                            </span>
                                            <span className="text-gray-800 font-semibold col-span-2">{formatDate(selectedUserForView.tanggal_lahir)}</span>
                                        </div>
                                        <div className="grid grid-cols-3 py-1">
                                            <span className="text-gray-500 font-medium col-span-1 flex items-center gap-1.5">
                                                <GraduationCap className="w-4 h-4 text-green-600 inline" /> Pendidikan
                                            </span>
                                            <span className="text-gray-800 font-semibold col-span-2">{selectedUserForView.pendidikan_terakhir || 'Belum Diisi'}</span>
                                        </div>
                                    </div>
                                </div>

                                {/* Kepegawaian Section */}
                                <div className="space-y-4 bg-gray-50/50 p-5 rounded-2xl border border-gray-100">
                                    <h5 className="text-sm font-bold uppercase tracking-wider text-green-700 flex items-center gap-2 pb-2 border-b border-gray-200/60">
                                        <Briefcase className="w-4 h-4" /> Kepegawaian
                                    </h5>
                                    <div className="space-y-3 text-sm">
                                        <div className="grid grid-cols-3 py-1 border-b border-gray-100/50">
                                            <span className="text-gray-500 font-medium col-span-1 flex items-center gap-1.5">
                                                <Building className="w-4 h-4 text-green-600 inline" /> Unit Kerja
                                            </span>
                                            <span className="text-gray-800 font-semibold col-span-2">{selectedUserForView.unit_kerja?.nama_unit || 'Belum Diisi'}</span>
                                        </div>
                                        <div className="grid grid-cols-3 py-1 border-b border-gray-100/50">
                                            <span className="text-gray-500 font-medium col-span-1 flex items-center gap-1.5">
                                                <Clock className="w-4 h-4 text-green-600 inline" /> TMT Diangkat
                                            </span>
                                            <span className="text-gray-800 font-semibold col-span-2">{formatDate(selectedUserForView.tmt_pegawai)}</span>
                                        </div>
                                        <div className="grid grid-cols-3 py-1">
                                            <span className="text-gray-500 font-medium col-span-1 flex items-center gap-1.5">
                                                <ShieldAlert className="w-4 h-4 text-green-600 inline" /> Batas Usia
                                            </span>
                                            <span className="text-gray-800 font-semibold col-span-2">{selectedUserForView.batas_usia_pensiun ? `${selectedUserForView.batas_usia_pensiun} Tahun` : 'Belum Diisi'}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Simulasi Pensiun & Karir Section */}
                            <div className="bg-gradient-to-br from-amber-50/40 via-orange-50/10 to-white p-5 rounded-2xl border border-amber-100 space-y-4">
                                <h5 className="text-sm font-bold uppercase tracking-wider text-amber-700 flex items-center gap-2 pb-2 border-b border-amber-200/60">
                                    <TrendingUp className="w-4 h-4" /> Estimasi Kenaikan & Pensiun
                                </h5>
                                <div className="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
                                    <div className="space-y-3 bg-white p-4 rounded-xl border border-amber-100/70 shadow-sm">
                                        <span className="text-xs font-semibold text-amber-600 block uppercase">Masa Pensiun</span>
                                        <div className="space-y-2">
                                            <div className="flex justify-between items-center text-xs text-gray-500 border-b border-gray-100 pb-1.5">
                                                <span>TMT Pensiun:</span>
                                                <span className="font-bold text-gray-800">{formatDate(selectedUserForView.tmt_pensiun)}</span>
                                            </div>
                                            <div className="flex justify-between items-center text-xs text-gray-500">
                                                <span>Sisa Usia Pengabdian:</span>
                                                <span className="font-bold text-gray-800">
                                                    {selectedUserForView.tanggal_lahir && selectedUserForView.batas_usia_pensiun ? (() => {
                                                        const birthYear = new Date(selectedUserForView.tanggal_lahir).getFullYear();
                                                        const retirementYear = birthYear + selectedUserForView.batas_usia_pensiun;
                                                        const currentYear = new Date().getFullYear();
                                                        const yearsLeft = retirementYear - currentYear;
                                                        return yearsLeft > 0 ? `${yearsLeft} Tahun` : 'Sudah Masuk Pensiun';
                                                    })() : '-'}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="space-y-3 bg-white p-4 rounded-xl border border-amber-100/70 shadow-sm">
                                        <span className="text-xs font-semibold text-amber-600 block uppercase">Estimasi Kenaikan Berkala</span>
                                        <div className="space-y-2">
                                            <div className="flex justify-between items-center text-xs text-gray-500 border-b border-gray-100 pb-1.5">
                                                <span>Naik Gaji (2026-29):</span>
                                                <span className="font-bold text-gray-800">{selectedUserForView.perkiraan_naik_gaji || '-'}</span>
                                            </div>
                                            <div className="flex justify-between items-center text-xs text-gray-500">
                                                <span>Naik Pangkat/Jabatan:</span>
                                                <span className="font-bold text-gray-800">{selectedUserForView.perkiraan_naik_jabatan || '-'}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Footer */}
                        <div className="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                            <button
                                type="button"
                                onClick={() => {
                                    setIsViewModalOpen(false);
                                    setSelectedUserForView(null);
                                }}
                                className="px-6 py-2.5 text-sm font-bold text-white bg-green-600 rounded-xl hover:bg-green-700 shadow-md hover:shadow-lg transition active:scale-95"
                            >
                                Tutup Detail
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* MODAL HAPUS PEGAWAI (CONFIRMATION) */}
            {isDeleteModalOpen && selectedUserForDelete && (
                <div className="fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4 z-50 animate-in fade-in duration-200">
                    <div className="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden text-gray-800 animate-in zoom-in-95 duration-200 border border-red-100">
                        {/* Danger visual highlight */}
                        <div className="bg-gradient-to-b from-red-50 to-white px-6 pt-6 pb-4 text-center">
                            <div className="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-red-600 mb-4 animate-bounce">
                                <AlertTriangle className="h-7 w-7" />
                            </div>
                            <h3 className="text-xl font-bold text-gray-900">Hapus Data Pegawai?</h3>
                            <p className="text-sm text-gray-500 mt-2">
                                Apakah Anda yakin ingin menghapus data pegawai <b>{selectedUserForDelete.name}</b>? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
                            </p>
                            {selectedUserForDelete.id === auth.user.id && (
                                <div className="mt-3 p-3 bg-red-50 text-red-800 border border-red-200 rounded-lg text-xs font-semibold">
                                    Perhatian: Ini adalah akun Anda sendiri yang saat ini digunakan untuk login! Anda tidak diperbolehkan menghapus akun aktif Anda sendiri.
                                </div>
                            )}
                        </div>

                        {/* Footer */}
                        <div className="bg-gray-50 px-6 py-4 flex justify-end gap-2 border-t border-gray-100">
                            <button
                                type="button"
                                onClick={() => {
                                    setIsDeleteModalOpen(false);
                                    setSelectedUserForDelete(null);
                                }}
                                className="px-4 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-100 transition"
                            >
                                Batal
                            </button>
                            <button
                                type="button"
                                onClick={executeDelete}
                                disabled={selectedUserForDelete.id === auth.user.id}
                                className="px-5 py-2 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 shadow-md hover:shadow-lg transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                Ya, Hapus Pegawai
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
