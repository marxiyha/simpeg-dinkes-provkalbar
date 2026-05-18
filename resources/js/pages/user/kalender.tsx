import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import { ChevronLeft, ChevronRight, Calendar as CalendarIcon, MapPin, Info } from 'lucide-react';
import { Auth } from '@/types';

interface EventData {
    id: number;
    title: string;
    date: string;
    type: 'dinas' | 'cuti' | 'libur';
}

interface UserKalenderProps {
    auth: Auth;
    events?: EventData[];
}

export default function UserKalenderPage({ auth, events = [] }: UserKalenderProps) {
    const [showPanduan, setShowPanduan] = useState(false);
    const pegawai: any = auth.user;
    const namaPegawai = pegawai?.nama || pegawai?.name || 'Pegawai';

    // Simple mockup for current month
    const currentDate = new Date();
    const [currentMonth, setCurrentMonth] = useState(currentDate.getMonth());
    const [currentYear, setCurrentYear] = useState(currentDate.getFullYear());

    // Mockup events
    const dummyEvents: EventData[] = events.length > 0 ? events : [
        { id: 1, title: 'Dinas Luar (Jakarta)', date: `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-12`, type: 'dinas' },
        { id: 2, title: 'Dinas Luar (Jakarta)', date: `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-13`, type: 'dinas' },
        { id: 3, title: 'Cuti Tahunan', date: `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-25`, type: 'cuti' },
        { id: 4, title: 'Hari Raya', date: `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-10`, type: 'libur' },
    ];

    const getDaysInMonth = (month: number, year: number) => {
        return new Date(year, month + 1, 0).getDate();
    };

    const getFirstDayOfMonth = (month: number, year: number) => {
        return new Date(year, month, 1).getDay();
    };

    const daysInMonth = getDaysInMonth(currentMonth, currentYear);
    const firstDay = getFirstDayOfMonth(currentMonth, currentYear);

    const monthNames = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    const prevMonth = () => {
        if (currentMonth === 0) {
            setCurrentMonth(11);
            setCurrentYear(currentYear - 1);
        } else {
            setCurrentMonth(currentMonth - 1);
        }
    };

    const nextMonth = () => {
        if (currentMonth === 11) {
            setCurrentMonth(0);
            setCurrentYear(currentYear + 1);
        } else {
            setCurrentMonth(currentMonth + 1);
        }
    };

    // Build the days array
    const days = [];
    for (let i = 0; i < firstDay; i++) {
        days.push(null);
    }
    for (let i = 1; i <= daysInMonth; i++) {
        days.push(i);
    }

    return (
        <div className="min-h-screen bg-green-600 font-sans text-white pb-10">
            <Head title="Kalender - Dinkes Kalbar" />

            {/* HEADER */}
            <div className="bg-white text-primary p-4 shadow-md flex justify-between items-center">
                <div>
                    <h1 className="text-xl font-bold flex items-center gap-2">
                        Kalender Jadwal
                    </h1>
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
                <div className="bg-white text-gray-800 p-6 rounded-lg shadow">

                    {/* CALENDAR CONTROLS */}
                    <div className="flex justify-between items-center mb-6">
                        <h2 className="text-2xl font-bold text-primary">
                            {monthNames[currentMonth]} {currentYear}
                        </h2>
                        <div className="flex gap-2">
                            <button onClick={prevMonth} className="p-2 bg-gray-100 hover:bg-gray-200 rounded transition text-gray-700">
                                <ChevronLeft className="w-5 h-5" />
                            </button>
                            <button onClick={() => {
                                setCurrentMonth(new Date().getMonth());
                                setCurrentYear(new Date().getFullYear());
                            }} className="px-4 py-2 bg-green-100 hover:bg-green-200 text-green-800 font-semibold rounded transition">
                                Hari Ini
                            </button>
                            <button onClick={nextMonth} className="p-2 bg-gray-100 hover:bg-gray-200 rounded transition text-gray-700">
                                <ChevronRight className="w-5 h-5" />
                            </button>
                        </div>
                    </div>

                    {/* LEGEND */}
                    <div className="flex flex-wrap gap-4 mb-6 text-sm">
                        <div className="flex items-center gap-1">
                            <span className="w-3 h-3 rounded-full bg-blue-500"></span>
                            <span>Dinas Luar</span>
                        </div>
                        <div className="flex items-center gap-1">
                            <span className="w-3 h-3 rounded-full bg-orange-500"></span>
                            <span>Cuti</span>
                        </div>
                        <div className="flex items-center gap-1">
                            <span className="w-3 h-3 rounded-full bg-red-500"></span>
                            <span>Libur Nasional</span>
                        </div>
                    </div>

                    {/* CALENDAR GRID */}
                    <div className="border border-gray-200 rounded-lg overflow-hidden">
                        <div className="grid grid-cols-7 bg-gray-100 text-center font-bold text-gray-600 border-b border-gray-200">
                            <div className="py-3">Min</div>
                            <div className="py-3">Sen</div>
                            <div className="py-3">Sel</div>
                            <div className="py-3">Rab</div>
                            <div className="py-3">Kam</div>
                            <div className="py-3">Jum</div>
                            <div className="py-3">Sab</div>
                        </div>
                        <div className="grid grid-cols-7 bg-white">
                            {days.map((day, idx) => {
                                if (!day) return <div key={idx} className="min-h-[100px] border-b border-r border-gray-100 bg-gray-50/50 p-2"></div>;

                                const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                                const dayEvents = dummyEvents.filter(e => e.date === dateStr);
                                const isToday = day === currentDate.getDate() && currentMonth === currentDate.getMonth() && currentYear === currentDate.getFullYear();
                                const isWeekend = idx % 7 === 0 || idx % 7 === 6;

                                return (
                                    <div key={idx} className={`min-h-[100px] border-b border-r border-gray-100 p-2 transition hover:bg-gray-50 ${isToday ? 'bg-green-50/30' : ''}`}>
                                        <div className="flex justify-between items-start">
                                            <span className={`w-7 h-7 flex items-center justify-center rounded-full text-sm ${isToday ? 'bg-green-600 text-white font-bold' :
                                                isWeekend ? 'text-red-500 font-medium' :
                                                    'text-gray-700 font-medium'
                                                }`}>
                                                {day}
                                            </span>
                                        </div>
                                        <div className="mt-1 space-y-1">
                                            {dayEvents.map(event => (
                                                <div
                                                    key={event.id}
                                                    className={`px-1.5 py-1 text-xs rounded truncate ${event.type === 'dinas' ? 'bg-blue-100 text-blue-800' :
                                                        event.type === 'cuti' ? 'bg-orange-100 text-orange-800' :
                                                            'bg-red-100 text-red-800'
                                                        }`}
                                                    title={event.title}
                                                >
                                                    {event.title}
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                </div>

                {/* UPCOMING EVENTS LIST (Mobile Friendly View) */}
                <div className="bg-white text-gray-800 p-6 rounded-lg shadow">
                    <h2 className="text-lg font-bold border-b pb-2 mb-4 text-primary">AGENDA TERDEKAT</h2>
                    <div className="space-y-3">
                        {dummyEvents.slice(0, 3).map(event => (
                            <div key={event.id} className="flex items-center gap-4 p-3 rounded-lg border border-gray-100 bg-gray-50">
                                <div className={`w-12 h-12 flex flex-col items-center justify-center rounded-md text-white ${event.type === 'dinas' ? 'bg-blue-500' :
                                    event.type === 'cuti' ? 'bg-orange-500' :
                                        'bg-red-500'
                                    }`}>
                                    <span className="text-xs font-bold">{monthNames[parseInt(event.date.split('-')[1]) - 1].substring(0, 3)}</span>
                                    <span className="text-lg font-bold leading-none">{event.date.split('-')[2]}</span>
                                </div>
                                <div>
                                    <h4 className="font-bold text-gray-800">{event.title}</h4>
                                    <p className="text-sm text-gray-500 flex items-center gap-1">
                                        {event.type === 'dinas' && <MapPin className="w-3 h-3" />}
                                        {event.type === 'dinas' ? 'Luar Kota' : event.type === 'cuti' ? 'Cuti Pribadi' : 'Hari Libur'}
                                    </p>
                                </div>
                            </div>
                        ))}
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
                            <h3 className="text-xl font-bold text-gray-800">Panduan Kalender</h3>
                        </div>
                        <div className="text-sm space-y-4 text-gray-600">
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">1</span>
                                    Navigasi Bulan
                                </strong>
                                Gunakan tombol panah kiri/kanan untuk berpindah bulan, atau klik "Hari Ini" untuk kembali ke bulan saat ini.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">2</span>
                                    Legenda Warna
                                </strong>
                                Biru = Dinas Luar, Oranye = Cuti, Merah = Hari Libur Nasional.
                            </div>
                            <div className="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <strong className="text-gray-800 flex items-center gap-2 mb-1">
                                    <span className="bg-green-200 text-green-800 w-5 h-5 rounded-full flex items-center justify-center text-xs">3</span>
                                    Agenda Terdekat
                                </strong>
                                Bagian bawah menampilkan daftar agenda terdekat secara ringkas untuk kemudahan.
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