import React, { useState } from 'react';
import { Head, Link, useForm, router } from '@inertiajs/react';
import { Plus, Edit, Trash2, X, AlertCircle } from 'lucide-react';

interface User {
    id: number;
    name: string;
    email: string;
    nip: string | null;
    jabatan: string | null;
    status_pegawai: string | null;
    unit_kerja?: {
        nama_unit: string;
    } | null;
}

interface UnitKerja {
    id_unit: number;
    nama_unit: string;
}

interface AdminUsersProps {
    users: User[];
    unitKerjas: UnitKerja[];
}

export default function AdminUsers({ users, unitKerjas }: AdminUsersProps) {
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [editingUser, setEditingUser] = useState<User | null>(null);

    const { data, setData, post, put, delete: destroy, processing, errors, reset, clearErrors } = useForm({
        name: '',
        email: '',
        password: '',
        nip: '',
        id_unit: '',
        jabatan: '',
        status_pegawai: '',
        jenis_kelamin: '',
    });

    const openModal = (user: User | null = null) => {
        clearErrors();
        if (user) {
            setEditingUser(user);
            setData({
                name: user.name,
                email: user.email,
                password: '', // Leave empty on edit
                nip: user.nip || '',
                id_unit: user.unit_kerja ? String((user as any).id_unit) : '',
                jabatan: user.jabatan || '',
                status_pegawai: user.status_pegawai || '',
                jenis_kelamin: (user as any).jenis_kelamin || '',
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
            put(`/admin/users/${editingUser.id}`, {
                onSuccess: () => closeModal(),
            });
        } else {
            post('/admin/users', {
                onSuccess: () => closeModal(),
            });
        }
    };

    const handleDelete = (user: User) => {
        if (confirm(`Apakah Anda yakin ingin menghapus pegawai ${user.name}?`)) {
            destroy(`/admin/users/${user.id}`);
        }
    };

    return (
        <div className="min-h-screen bg-slate-50 font-sans text-gray-800 pb-10">
            <Head title="Kelola Data Pegawai - Admin" />

            {/* HEADER */}
            <div className="bg-slate-900 text-white p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold">KELOLA DATA PEGAWAI</h1>
                    <p className="text-xs font-semibold text-slate-300">Admin SIMPEG Dinkes Kalbar</p>
                </div>
                <div className="space-x-2">
                    <Link
                        href="/admin/dashboard"
                        className="bg-slate-700 text-white px-4 py-2 rounded text-sm hover:bg-slate-600 transition">
                        Kembali ke Dashboard
                    </Link>
                </div>
            </div>

            {/* KONTEN UTAMA */}
            <div className="max-w-7xl mx-auto mt-6 space-y-6 px-4">
                
                <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div className="flex justify-between items-center mb-6 border-b pb-4">
                        <h2 className="text-lg font-bold text-slate-800">Daftar Pegawai</h2>
                        <button
                            onClick={() => openModal()}
                            className="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition flex items-center gap-2 font-medium"
                        >
                            <Plus className="w-4 h-4" />
                            Tambah Pegawai
                        </button>
                    </div>

                    <div className="overflow-x-auto">
                        <table className="w-full text-sm text-left">
                            <thead className="bg-slate-100 text-slate-700">
                                <tr>
                                    <th className="px-4 py-3 rounded-tl-lg font-semibold">Nama / NIP</th>
                                    <th className="px-4 py-3 font-semibold">Unit Kerja</th>
                                    <th className="px-4 py-3 font-semibold">Jabatan</th>
                                    <th className="px-4 py-3 font-semibold">Status</th>
                                    <th className="px-4 py-3 rounded-tr-lg font-semibold text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-100">
                                {users.length === 0 ? (
                                    <tr>
                                        <td colSpan={5} className="text-center py-10 text-gray-500">
                                            Belum ada data pegawai.
                                        </td>
                                    </tr>
                                ) : (
                                    users.map((user) => (
                                        <tr key={user.id} className="hover:bg-slate-50 transition">
                                            <td className="px-4 py-4">
                                                <div className="font-bold text-slate-800">{user.name}</div>
                                                <div className="text-xs text-gray-500">{user.nip || 'NIP Belum Diisi'}</div>
                                                <div className="text-xs text-blue-500">{user.email}</div>
                                            </td>
                                            <td className="px-4 py-4 text-slate-600">
                                                {user.unit_kerja?.nama_unit || '-'}
                                            </td>
                                            <td className="px-4 py-4 text-slate-600">
                                                {user.jabatan || '-'}
                                            </td>
                                            <td className="px-4 py-4">
                                                {user.status_pegawai ? (
                                                    <span className={`px-2 py-1 rounded text-xs font-bold ${
                                                        user.status_pegawai === 'PNS' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'
                                                    }`}>
                                                        {user.status_pegawai}
                                                    </span>
                                                ) : (
                                                    <span className="text-gray-400 text-xs">-</span>
                                                )}
                                            </td>
                                            <td className="px-4 py-4 text-right">
                                                <div className="flex justify-end gap-2">
                                                    <button
                                                        onClick={() => openModal(user)}
                                                        className="p-2 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded transition"
                                                        title="Edit"
                                                    >
                                                        <Edit className="w-4 h-4" />
                                                    </button>
                                                    <button
                                                        onClick={() => handleDelete(user)}
                                                        className="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded transition"
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
                <div className="fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex justify-center items-center p-4 z-50">
                    <div className="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col">
                        <div className="px-6 py-4 border-b flex justify-between items-center bg-slate-50">
                            <h3 className="font-bold text-lg text-slate-800">
                                {editingUser ? 'Edit Data Pegawai' : 'Tambah Pegawai Baru'}
                            </h3>
                            <button onClick={closeModal} className="text-slate-400 hover:text-slate-600">
                                <X className="w-5 h-5" />
                            </button>
                        </div>
                        
                        <div className="p-6 overflow-y-auto flex-1">
                            <form id="pegawaiForm" onSubmit={handleSubmit} className="space-y-4">
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">Nama Lengkap *</label>
                                        <input
                                            type="text"
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.name ? 'border-red-500' : ''}`}
                                            value={data.name}
                                            onChange={e => setData('name', e.target.value)}
                                            required
                                        />
                                        {errors.name && <p className="text-red-500 text-xs mt-1">{errors.name}</p>}
                                    </div>
                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">Email *</label>
                                        <input
                                            type="email"
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.email ? 'border-red-500' : ''}`}
                                            value={data.email}
                                            onChange={e => setData('email', e.target.value)}
                                            required
                                        />
                                        {errors.email && <p className="text-red-500 text-xs mt-1">{errors.email}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">NIP</label>
                                        <input
                                            type="text"
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.nip ? 'border-red-500' : ''}`}
                                            value={data.nip}
                                            onChange={e => setData('nip', e.target.value)}
                                        />
                                        {errors.nip && <p className="text-red-500 text-xs mt-1">{errors.nip}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">Password {editingUser ? '(Kosongkan jika tidak diubah)' : '*'}</label>
                                        <input
                                            type="password"
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.password ? 'border-red-500' : ''}`}
                                            value={data.password}
                                            onChange={e => setData('password', e.target.value)}
                                            required={!editingUser}
                                        />
                                        {errors.password && <p className="text-red-500 text-xs mt-1">{errors.password}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">Unit Kerja</label>
                                        <select
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.id_unit ? 'border-red-500' : ''}`}
                                            value={data.id_unit}
                                            onChange={e => setData('id_unit', e.target.value)}
                                        >
                                            <option value="">-- Pilih Unit Kerja --</option>
                                            {unitKerjas.map(unit => (
                                                <option key={unit.id_unit} value={unit.id_unit}>{unit.nama_unit}</option>
                                            ))}
                                        </select>
                                        {errors.id_unit && <p className="text-red-500 text-xs mt-1">{errors.id_unit}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">Jabatan</label>
                                        <input
                                            type="text"
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.jabatan ? 'border-red-500' : ''}`}
                                            value={data.jabatan}
                                            onChange={e => setData('jabatan', e.target.value)}
                                        />
                                        {errors.jabatan && <p className="text-red-500 text-xs mt-1">{errors.jabatan}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">Status Pegawai</label>
                                        <select
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.status_pegawai ? 'border-red-500' : ''}`}
                                            value={data.status_pegawai}
                                            onChange={e => setData('status_pegawai', e.target.value)}
                                        >
                                            <option value="">-- Pilih Status --</option>
                                            <option value="PNS">PNS</option>
                                            <option value="PPPK">PPPK</option>
                                        </select>
                                        {errors.status_pegawai && <p className="text-red-500 text-xs mt-1">{errors.status_pegawai}</p>}
                                    </div>

                                    <div>
                                        <label className="block text-sm font-semibold mb-1 text-slate-700">Jenis Kelamin</label>
                                        <select
                                            className={`w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 text-sm ${errors.jenis_kelamin ? 'border-red-500' : ''}`}
                                            value={data.jenis_kelamin}
                                            onChange={e => setData('jenis_kelamin', e.target.value)}
                                        >
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        {errors.jenis_kelamin && <p className="text-red-500 text-xs mt-1">{errors.jenis_kelamin}</p>}
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div className="px-6 py-4 border-t bg-slate-50 flex justify-end gap-2">
                            <button
                                type="button"
                                onClick={closeModal}
                                className="px-4 py-2 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition"
                            >
                                Batal
                            </button>
                            <button
                                type="submit"
                                form="pegawaiForm"
                                disabled={processing}
                                className="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition disabled:opacity-50"
                            >
                                {processing ? 'Menyimpan...' : 'Simpan Data'}
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
