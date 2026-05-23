<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Cuti Pegawai - SIMPEG</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #00A843;
            --primary-hover: #008635;
            --bg-light: #f4f6f9;
            --text-dark: #2d3748;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #00732e 100%);
            padding: 40px 20px;
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* CONTAINER */
        .container {
            background: white;
            padding: 35px;
            border-radius: 28px;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 20px;
            margin-bottom: 28px;
        }

        .header-left h2 {
            color: #166534;
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .header-left p {
            color: #6b7280;
            line-height: 1.6;
            font-size: 14px;
            max-width: 700px;
        }

        /* Action Nav Buttons inside Header */
        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #dcfce7;
            color: #15803d;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .btn-nav-link:hover {
            background: #bbf7d0;
            color: #166534;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(22, 101, 52, 0.15);
        }

        /* FILTER AREA */
        .filter-area {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .search-input,
        .filter-tahun {
            padding: 14px 18px;
            border-radius: 14px;
            border: 2px solid #e2e8f0;
            outline: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s;
            font-size: 14px;
            background: #fff;
        }

        .search-input { width: 280px; }

        .search-input:focus,
        .filter-tahun:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 5px rgba(0, 168, 67, 0.15);
        }

        .filter-tahun {
            min-width: 180px;
            font-weight: 700;
            cursor: pointer;
        }

        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 22px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            text-align: left;
        }

        thead {
            background: linear-gradient(90deg, var(--primary), #008D38);
        }

        th {
            color: white;
            padding: 18px 16px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 18px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #4a5568;
            vertical-align: middle;
        }

        tbody tr:hover td {
            background: #fafd96; /* Efek highlight baris serasi dengan approval */
        }

        .nomor-box {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #dcfce7;
            color: #166534;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 800;
        }

        /* STATUS BADGES */
        .status {
            padding: 6px 14px;
            border-radius: 50px;
            color: white;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            min-width: 100px;
            text-align: center;
        }

        .pending { background: #ecc94b; color: #744210; }
        .approved { background: #48bb78; color: #1c452d; }
        .rejected { background: #f56565; color: #651a1a; }

        /* FOOTER AREA BUTTONS */
        .footer-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: white;
            color: #4a5568;
            text-decoration: none;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
            transform: translateX(-4px);
        }

        .empty-data {
            text-align: center;
            color: #a0aec0;
            padding: 50px !important;
            font-size: 15px;
            font-weight: 600;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {
            body { padding: 16px; }
            .container { padding: 22px; }
            .header { flex-direction: column; align-items: flex-start; }
            .header-actions { width: 100%; }
            .btn-nav-link { width: 100%; justify-content: center; }
            .filter-area { flex-direction: column; }
            .search-input, .filter-tahun { width: 100%; }
            table { min-width: 850px; }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div class="header-left">
            <h2>Rekapitulasi Cuti Pegawai</h2>
            <p>Halaman kontrol rekapitulasi data pengajuan cuti pegawai lingkungan Dinas Kesehatan Provinsi Kalimantan Barat berdasarkan pencarian nama dan filter tahun.</p>
        </div>
        
        <div class="header-actions">
            <a href="{{ route('cuti.approval') }}" class="btn-nav-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="9" y1="15" x2="15" y2="15"></line>
                    <line x1="9" y1="11" x2="15" y2="11"></line>
                </svg>
                Menu Persetujuan Cuti
            </a>
        </div>
    </div>

    <div class="filter-area">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari nama pegawai..." onkeyup="searchPegawai()">

        <select id="tahunFilter" class="filter-tahun" onchange="filterTahun()">
            <option value="">Semua Tahun</option>
            @for($i = 2024; $i <= 2029; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="table-wrapper">
        <table id="rekapTable">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Pegawai</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan Cuti</th>
                    <th style="width: 130px;">Status</th>
                </tr>
            </thead>

            <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td>
                        <div class="nomor-box">{{ $index + 1 }}</div>
                    </td>
                    <td><b>{{ $item['nama'] ?? '-' }}</b></td>
                    <td>{{ $item['jenis_cuti'] ?? 'Cuti Tahunan' }}</td>
                    <td class="tanggal">{{ $item['tanggal_mulai'] ?? '-' }}</td>
                    <td>{{ $item['tanggal_selesai'] ?? '-' }}</td>
                    <td>{{ $item['alasan_cuti'] ?? '-' }}</td>
                    <td>
                        @if(($item['status'] ?? '') == 'Pending')
                            <span class="status pending">Pending</span>
                        @elseif(($item['status'] ?? '') == 'Disetujui')
                            <span class="status approved">Disetujui</span>
                        @elseif(($item['status'] ?? '') == 'Ditolak')
                            <span class="status rejected">Ditolak</span>
                        @else
                            <span class="status pending">-</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-data">
                        Belum ada riwayat data rekapitulasi cuti pegawai.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer-navigation">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

</div>

<script>
/* SEARCH PEGAWAI (Mendeteksi Kolom Nama di Index ke-1) */
function searchPegawai() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let table = document.getElementById('rekapTable');
    let tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td')[1]; // Kolom Nama Pegawai
        if (td) {
            let txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
}

/* FILTER TAHUN (Mendeteksi teks tahun di Kolom Tanggal Mulai) */
function filterTahun() {
    let tahun = document.getElementById('tahunFilter').value;
    let rows = document.querySelectorAll('#rekapTable tbody tr');

    rows.forEach(row => {
        let tanggalCell = row.querySelector('.tanggal');
        if (tanggalCell) {
            let tanggal = tanggalCell.innerText;
            if (tahun === '' || tanggal.includes(tahun)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}
</script>

</body>
</html>