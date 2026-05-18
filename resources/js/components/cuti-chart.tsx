import React, { useState } from 'react';

export interface CutiData {
    month: string;
    total: number;
}

interface YearlyData {
    [year: string]: CutiData[];
}

interface CutiChartProps {
    data?: YearlyData;
}

// Mockup data untuk beberapa tahun
const mockYearlyData: YearlyData = {
    '2026': [
        { month: 'Jan', total: 12 },
        { month: 'Feb', total: 8 },
        { month: 'Mar', total: 15 },
        { month: 'Apr', total: 5 },
        { month: 'Mei', total: 20 },
        { month: 'Jun', total: 45 }, // Lonjakan
        { month: 'Jul', total: 10 },
        { month: 'Ags', total: 12 },
        { month: 'Sep', total: 8 },
        { month: 'Okt', total: 18 },
        { month: 'Nov', total: 25 },
        { month: 'Des', total: 30 },
    ],
    '2025': [
        { month: 'Jan', total: 10 },
        { month: 'Feb', total: 14 },
        { month: 'Mar', total: 22 },
        { month: 'Apr', total: 8 },
        { month: 'Mei', total: 12 },
        { month: 'Jun', total: 25 },
        { month: 'Jul', total: 35 }, // Lonjakan
        { month: 'Ags', total: 18 },
        { month: 'Sep', total: 15 },
        { month: 'Okt', total: 9 },
        { month: 'Nov', total: 12 },
        { month: 'Des', total: 40 }, 
    ],
    '2024': [
        { month: 'Jan', total: 5 },
        { month: 'Feb', total: 10 },
        { month: 'Mar', total: 12 },
        { month: 'Apr', total: 25 },
        { month: 'Mei', total: 18 },
        { month: 'Jun', total: 30 },
        { month: 'Jul', total: 15 },
        { month: 'Ags', total: 22 },
        { month: 'Sep', total: 10 },
        { month: 'Okt', total: 14 },
        { month: 'Nov', total: 42 }, // Lonjakan
        { month: 'Des', total: 20 },
    ],
};

export default function CutiChart({ data = mockYearlyData }: CutiChartProps) {
    const years = Object.keys(data).sort((a, b) => parseInt(b) - parseInt(a));
    const [selectedYear, setSelectedYear] = useState<string>(years[0]);

    const currentData = data[selectedYear] || [];

    // Cari nilai maksimum untuk menentukan skala tinggi bar (grafik)
    const maxVal = Math.max(...currentData.map(d => d.total), 1);
    
    // Cari bulan dengan pengajuan tertinggi (lonjakan)
    const peakMonth = currentData.reduce((prev, current) => (prev.total > current.total) ? prev : current, { month: '-', total: 0 });

    // Hitung total cuti tahunan
    const totalTahunan = currentData.reduce((sum, current) => sum + current.total, 0);

    return (
        <div className="w-full bg-white p-6 rounded-lg shadow">
            <div className="mb-6 flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                <div>
                    <h3 className="text-lg font-bold text-gray-800 uppercase">Statistik Pengajuan Cuti</h3>
                    <p className="text-sm text-gray-600 mt-1">Total Tahunan: <span className="font-bold text-gray-800">{totalTahunan} Pengajuan</span></p>
                    <p className="text-sm text-gray-600">
                        Lonjakan tertinggi pada bulan <span className="font-bold text-red-500">{peakMonth.month}</span> ({peakMonth.total} pengajuan).
                    </p>
                </div>
                <div className="flex flex-col items-end gap-3">
                    <div className="flex items-center gap-2">
                        <label htmlFor="yearFilter" className="text-sm font-semibold text-gray-700">Tahun:</label>
                        <select 
                            id="yearFilter"
                            value={selectedYear}
                            onChange={(e) => setSelectedYear(e.target.value)}
                            className="text-sm text-gray-900 bg-white border-gray-300 rounded focus:ring-green-700 focus:border-green-700 py-1 px-3"
                        >
                            {years.map(year => (
                                <option key={year} value={year}>{year}</option>
                            ))}
                        </select>
                    </div>
                    <div className="flex items-center gap-3 text-xs">
                        <div className="flex items-center gap-1">
                            <div className="w-3 h-3 bg-emerald-800 rounded"></div>
                            <span className="text-gray-600">Normal</span>
                        </div>
                        <div className="flex items-center gap-1">
                            <div className="w-3 h-3 bg-red-500 rounded"></div>
                            <span className="text-gray-600">Lonjakan Tinggi</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div className="relative h-64 flex items-end justify-between mt-4 gap-1 sm:gap-2 pb-6 border-b border-gray-200">
                {/* Garis Skala (Y-Axis guides) */}
                <div className="absolute inset-0 flex flex-col justify-between pointer-events-none pb-6">
                    <div className="border-t border-gray-100 w-full flex-1"></div>
                    <div className="border-t border-gray-100 w-full flex-1"></div>
                    <div className="border-t border-gray-100 w-full flex-1"></div>
                    <div className="border-t border-gray-100 w-full flex-1"></div>
                </div>

                {currentData.map((item, index) => {
                    const heightPercent = (item.total / maxVal) * 100;
                    const isPeak = item.month === peakMonth.month;
                    
                    return (
                        <div key={index} className="relative flex flex-col items-center flex-1 group h-full justify-end z-10">
                            {/* Bar Chart Vector */}
                            <div className="relative w-full flex justify-center flex-1 items-end">
                                {/* Tooltip */}
                                <div className="opacity-0 group-hover:opacity-100 absolute -top-10 bg-gray-800 text-white text-xs px-2 py-1 rounded transition-opacity whitespace-nowrap pointer-events-none">
                                    {item.total} Cuti
                                </div>
                                {/* Vector Bar */}
                                <div 
                                    className={`w-full max-w-[40px] rounded-t-md transition-all duration-500 ${isPeak ? 'bg-red-500 shadow-[0_0_10px_rgba(239,68,68,0.5)]' : 'bg-emerald-800 group-hover:bg-emerald-600'}`}
                                    style={{ height: `${heightPercent}%`, minHeight: heightPercent > 0 ? '4px' : '0' }}
                                >
                                </div>
                            </div>
                            <div className="absolute -bottom-6 text-xs text-gray-500 font-semibold">{item.month}</div>
                        </div>
                    );
                })}
            </div>
        </div>
    );
}
