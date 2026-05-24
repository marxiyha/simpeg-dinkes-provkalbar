<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Dinas Luar</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #00A843;
            padding: 30px;
            color: #1f2937;
        }

        .container {
            background: white;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-top: 8px solid #166534;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .header h2 {
            color: #166534;
            font-size: 30px;
            font-weight: 800;
        }

        .filter-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-area label {
            font-weight: 700;
            color: #166534;
        }

        .filter-tahun {
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            font-weight: 700;
            outline: none;
            cursor: pointer;
        }

        .calendar-wrapper {
            background: white;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #e5e7eb;
        }

        /* FULLCALENDAR CUSTOM STYLING */
        .fc .fc-toolbar-title {
            font-size: 22px;
            font-weight: 800;
            color: #111827;
        }

        .fc .fc-button {
            background: #00A843 !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 600;
        }

        .fc .fc-button:hover {
            background: #008d38 !important;
        }

        .fc-daygrid-day:hover {
            background: #f0fdf4;
        }

        .fc-day-today {
            background: #dcfce7 !important;
        }

        .hari-minggu-libur {
            background: #fff1f2 !important;
        }

        /* STYLE BALOK EVENT */
        .event-dinas {
            background: linear-gradient(135deg, #00A843, #16a34a) !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,168,67,0.2);
        }

        .event-libur {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            font-size: 11px !important;
            font-weight: 500;
        }

        /* OVERLAY CORNER & MODAL */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            z-index: 999;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            width: 480px;
            max-width: 90%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            z-index: 1000;
            transition: 0.2s ease;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .modal.show {
            transform: translate(-50%, -50%) scale(1);
        }

        .modal-header {
            background: #166534;
            color: white;
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 800;
        }

        .close-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .close-btn:hover {
            background: rgba(255,255,255,0.4);
        }

        .modal-body {
            padding: 20px;
        }

        .detail-box {
            background: #f8fafc;
            border-radius: 14px;
            padding: 16px;
            border-left: 5px solid #00A843;
        }

        .detail-item {
            margin-bottom: 14px;
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 600;
            margin-top: 2px;
        }

        .btn-back {
            display: inline-flex;
            margin-top: 20px;
            padding: 12px 20px;
            background: white;
            color: #166534;
            border: 2px solid #166534;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #166534;
            color: white;
        }

        @media(max-width: 768px) {
            body { padding: 12px; }
            .container { padding: 16px; }
            .header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeModal()"></div>

<div class="modal" id="detailModal">
    <div class="modal-header">
        <h3>Detail Kegiatan Dinas Luar</h3>
        <button class="close-btn" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body">
        <div class="detail-box">
            <div class="detail-item">
                <div class="detail-label">Nama Pegawai</div>
                <div class="detail-value" id="modalNama">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Tanggal Dinas</div>
                <div class="detail-value" id="modalTanggal">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Lokasi Tujuan</div>
                <div class="detail-value" id="modalLokasi">-</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Keterangan Kegiatan</div>
                <div class="detail-value" id="modalKeterangan">-</div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="header">
        <div class="header-left">
            <h2>Kalender Dinas Luar</h2>
        </div>
        <div class="filter-area">
            <label for="tahunFilter">Tahun:</label>
            <select id="tahunFilter" class="filter-tahun">
                @for($i = 2024; $i <= 2029; $i++)
                    <option value="{{ $i }}" {{ $i == 2026 ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="calendar-wrapper">
        <div id="calendar"></div>
    </div>

    <a href="/dashboard" class="btn-back">← Kembali ke Dashboard</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let semuaEvent = [
        // DATA REAL-TIME DATABASE LARAVEL
        @foreach($dinasLuar as $item)
        {
            title: '💼 {{ addslashes($item->user->name ?? $item->nama_pegawai ?? "Tidak Diketahui") }}',
            start: '{{ \Carbon\Carbon::parse($item->tanggal_dinas)->format("Y-m-d") }}',
            className: 'event-dinas',
            extendedProps: {
                nama: '{{ addslashes($item->user->name ?? $item->nama_pegawai ?? "Tidak Diketahui") }}',
                tanggal: '{{ \Carbon\Carbon::parse($item->tanggal_dinas)->translatedFormat("d F Y") }}',
                lokasi: '{{ addslashes($item->lokasi) }}',
                keterangan: '{{ addslashes($item->keterangan) }}'
            }
        },
        @endforeach

        // LIBUR NASIONAL & CUTI BERSAMA TAHUN 2024
        { title: '🔴 Libur: Tahun Baru 2024 Masehi', start: '2024-01-01', className: 'event-libur' },
        { title: '🔴 Libur: Isra Mikraj Nabi Muhammad SAW', start: '2024-02-08', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Tahun Baru Imlek 2575', start: '2024-02-09', className: 'event-libur' },
        { title: '🔴 Libur: Tahun Baru Imlek 2575 Kongzili', start: '2024-02-10', className: 'event-libur' },
        { title: '🔴 Libur: Hari Suci Nyepi Saka 1946', start: '2024-03-11', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Suci Nyepi', start: '2024-03-12', className: 'event-libur' },
        { title: '🔴 Libur: Wafat Yesus Kristus', start: '2024-03-29', className: 'event-libur' },
        { title: '🔴 Libur: Hari Paskah', start: '2024-03-31', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2024-04-08', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2024-04-09', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Idulfitri 1445 H', start: '2024-04-10', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Idulfitri 1445 H', start: '2024-04-11', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2024-04-12', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2024-04-15', className: 'event-libur' },
        { title: '🔴 Libur: Hari Buruh Internasional', start: '2024-05-01', className: 'event-libur' },
        { title: '🔴 Libur: Kenaikan Yesus Kristus', start: '2024-05-09', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Kenaikan Yesus Kristus', start: '2024-05-10', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Waisak 2568', start: '2024-05-23', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Waisak', start: '2024-05-24', className: 'event-libur' },
        { title: '🔴 Libur: Hari Lahir Pancasila', start: '2024-06-01', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Iduladha 1445 H', start: '2024-06-17', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Iduladha', start: '2024-06-18', className: 'event-libur' },
        { title: '🔴 Libur: Tahun Baru Islam 1446 H', start: '2024-07-07', className: 'event-libur' },
        { title: '🔴 Libur: Hari Kemerdekaan RI', start: '2024-08-17', className: 'event-libur' },
        { title: '🔴 Libur: Maulid Nabi Muhammad SAW', start: '2024-09-16', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Natal', start: '2024-12-25', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Natal', start: '2024-12-26', className: 'event-libur' },

        // LIBUR NASIONAL & CUTI BERSAMA TAHUN 2025
        { title: '🔴 Libur: Tahun Baru 2025 Masehi', start: '2025-01-01', className: 'event-libur' },
        { title: '🔴 Libur: Isra Mikraj Nabi Muhammad SAW', start: '2025-01-27', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Tahun Baru Imlek 2576', start: '2025-01-28', className: 'event-libur' },
        { title: '🔴 Libur: Tahun Baru Imlek 2576 Kongzili', start: '2025-01-29', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Suci Nyepi', start: '2025-03-28', className: 'event-libur' },
        { title: '🔴 Libur: Hari Suci Nyepi Saka 1947', start: '2025-03-29', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Idulfitri 1446 H', start: '2025-03-31', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Idulfitri 1446 H', start: '2025-04-01', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2025-04-02', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2025-04-03', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2025-04-04', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2025-04-07', className: 'event-libur' },
        { title: '🔴 Libur: Wafat Yesus Kristus', start: '2025-04-18', className: 'event-libur' },
        { title: '🔴 Libur: Hari Paskah', start: '2025-04-20', className: 'event-libur' },
        { title: '🔴 Libur: Hari Buruh Internasional', start: '2025-05-01', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Waisak 2569', start: '2025-05-12', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Waisak', start: '2025-05-13', className: 'event-libur' },
        { title: '🔴 Libur: Kenaikan Yesus Kristus', start: '2025-05-29', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Kenaikan Yesus Kristus', start: '2025-05-30', className: 'event-libur' },
        { title: '🔴 Libur: Hari Lahir Pancasila', start: '2025-06-01', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Iduladha 1446 H', start: '2025-06-06', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Iduladha', start: '2025-06-09', className: 'event-libur' },
        { title: '🔴 Libur: Tahun Baru Islam 1447 H', start: '2025-06-27', className: 'event-libur' },
        { title: '🔴 Libur: Hari Kemerdekaan RI', start: '2025-08-17', className: 'event-libur' },
        { title: '🔴 Libur: Maulid Nabi Muhammad SAW', start: '2025-09-05', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Natal', start: '2025-12-25', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Natal', start: '2025-12-26', className: 'event-libur' },

        // LIBUR NASIONAL & CUTI BERSAMA TAHUN 2026
        { title: '🔴 Libur: Tahun Baru Masehi 2026', start: '2026-01-01', className: 'event-libur' },
        { title: '🔴 Libur: Isra Mikraj Nabi Muhammad SAW', start: '2026-01-16', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Tahun Baru Imlek 2577', start: '2026-02-16', className: 'event-libur' },
        { title: '🔴 Libur: Tahun Baru Imlek 2577 Kongzili', start: '2026-02-17', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Suci Nyepi', start: '2026-03-18', className: 'event-libur' },
        { title: '🔴 Libur: Hari Suci Nyepi Saka 1948', start: '2026-03-19', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2026-03-20', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Idulfitri 1447 H', start: '2026-03-21', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Idulfitri 1447 H', start: '2026-03-22', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2026-03-23', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Idulfitri', start: '2026-03-24', className: 'event-libur' },
        { title: '🔴 Libur: Wafat Yesus Kristus', start: '2026-04-03', className: 'event-libur' },
        { title: '🔴 Libur: Hari Paskah', start: '2026-04-05', className: 'event-libur' },
        { title: '🔴 Libur: Hari Buruh Internasional', start: '2026-05-01', className: 'event-libur' },
        { title: '🔴 Libur: Kenaikan Yesus Kristus', start: '2026-05-14', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Kenaikan Yesus Kristus', start: '2026-05-15', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Iduladha 1447 H', start: '2026-05-27', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Iduladha', start: '2026-05-28', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Waisak 2570', start: '2026-05-31', className: 'event-libur' },
        { title: '🔴 Libur: Hari Lahir Pancasila', start: '2026-06-01', className: 'event-libur' },
        { title: '🔴 Libur: Tahun Baru Islam 1448 H', start: '2026-06-16', className: 'event-libur' },
        { title: '🔴 Libur: Hari Kemerdekaan RI', start: '2026-08-17', className: 'event-libur' },
        { title: '🔴 Libur: Maulid Nabi Muhammad SAW', start: '2026-08-25', className: 'event-libur' },
        { title: '🟡 Cuti Bersama: Hari Raya Natal', start: '2026-12-24', className: 'event-libur' },
        { title: '🔴 Libur: Hari Raya Natal', start: '2026-12-25', className: 'event-libur' }
    ];

    function filterEventsByYear(tahun) {
        return semuaEvent.filter(e => e.start.startsWith(tahun));
    }

    let selectTahun = document.getElementById('tahunFilter');

    let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        locale: 'id',
        height: 'auto',
        initialDate: selectTahun.value + '-05-01', 
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: filterEventsByYear(selectTahun.value),
        eventClick: function(info) {
            if (info.event.classNames.includes('event-dinas')) {
                document.getElementById('modalNama').innerText = info.event.extendedProps.nama;
                document.getElementById('modalTanggal').innerText = info.event.extendedProps.tanggal;
                document.getElementById('modalLokasi').innerText = info.event.extendedProps.lokasi;
                document.getElementById('modalKeterangan').innerText = info.event.extendedProps.keterangan;

                document.getElementById('overlay').style.display = 'block';
                let modal = document.getElementById('detailModal');
                modal.style.display = 'block';
                setTimeout(() => modal.classList.add('show'), 10);

                document.body.style.overflow = 'hidden';
            }
        },
        dayCellDidMount: function(info) {
            if (info.date.getDay() === 0) {
                info.el.classList.add('hari-minggu-libur');
            }
        }
    });

    calendar.render();

    selectTahun.addEventListener('change', function() {
        calendar.removeAllEvents();
        calendar.addEventSource(filterEventsByYear(this.value));
        calendar.gotoDate(this.value + '-05-01');
    });
});

function closeModal() {
    let modal = document.getElementById('detailModal');
    modal.classList.remove('show');
    setTimeout(() => {
        document.getElementById('overlay').style.display = 'none';
        modal.style.display = 'none';
    }, 200);
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});
</script>
</body>
</html>