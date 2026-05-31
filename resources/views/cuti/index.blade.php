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

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #00732e 100%);
            padding: 40px 20px;
            color: var(--text-dark);
            min-height: 100vh;
        }

        .container {
            background: white;
            padding: 35px;
            border-radius: 28px;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .header {
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 20px;
            margin-bottom: 28px;
        }

        .header h2 { color: #166534; font-size: 30px; font-weight: 800; margin-bottom: 8px; }
        .header p { color: #6b7280; font-size: 14px; }

        .filter-area { display: flex; gap: 16px; margin-bottom: 25px; }
        .search-input, .filter-tahun {
            padding: 14px 18px;
            border-radius: 14px;
            border: 2px solid #e2e8f0;
            outline: none;
            font-size: 14px;
        }
        .search-input { width: 280px; }
        .filter-tahun { min-width: 180px; font-weight: 700; cursor: pointer; }

        .table-wrapper { overflow-x: auto; border-radius: 22px; border: 1px solid #e5e7eb; }
        table { width: 100%; border-collapse: collapse; background: white; text-align: left; }
        thead { background: linear-gradient(90deg, var(--primary), #008D38); }
        th { color: white; padding: 18px 16px; font-size: 13px; font-weight: 800; text-transform: uppercase; }
        td { padding: 18px 16px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #4a5568; }
        tbody tr:hover td { background: #fafd96; }

        .nomor-box { width: 34px; height: 34px; border-radius: 10px; background: #dcfce7; color: #166534; display: flex; justify-content: center; align-items: center; font-weight: 800; }
        .status { padding: 6px 14px; border-radius: 50px; color: white; font-size: 12px; font-weight: 700; text-align: center; display: inline-block; min-width: 100px; }
        .pending { background: #ecc94b; color: #744210; }
        .approved { background: #48bb78; color: #1c452d; }
        .rejected { background: #f56565; color: #651a1a; }

        .btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background: white; color: #4a5568; text-decoration: none; border-radius: 12px; border: 2px solid #e2e8f0; font-weight: 700; }
    </style>
</head>

<body>

<div class="container">
    <div class="header">
        <h2>Rekapitulasi Cuti Pegawai</h2>
        <p>Data pengajuan cuti pegawai lingkungan Dinas Kesehatan Provinsi Kalimantan Barat.</p>
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
                    <td><div class="nomor-box">{{ $index + 1 }}</div></td>
                    <td><b>{{ $item['nama'] ?? '-' }}</b></td>
                    <td>{{ $item['jenis_cuti'] ?? 'Cuti Tahunan' }}</td>
                    <td class="tanggal">{{ $item['tanggal_mulai'] ?? '-' }}</td>
                    <td>{{ $item['tanggal_selesai'] ?? '-' }}</td>
                    <td>{{ $item['alasan_cuti'] ?? '-' }}</td>
                    <td>
                        @php $status = $item['status'] ?? ''; @endphp
                        <span class="status {{ $status == 'Disetujui' ? 'approved' : ($status == 'Ditolak' ? 'rejected' : 'pending') }}">
                            {{ $status ?: '-' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center; padding:50px;">Belum ada riwayat data rekapitulasi cuti.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>
    </div>
</div>

<script>
    function searchPegawai() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toLowerCase();
        let rows = document.querySelectorAll('#rekapTable tbody tr');
        rows.forEach(row => {
            let name = row.getElementsByTagName('td')[1].textContent.toLowerCase();
            row.style.display = name.includes(filter) ? '' : 'none';
        });
    }

    function filterTahun() {
        let tahun = document.getElementById('tahunFilter').value;
        let rows = document.querySelectorAll('#rekapTable tbody tr');
        rows.forEach(row => {
            let tanggal = row.querySelector('.tanggal').innerText;
            row.style.display = (tahun === '' || tanggal.includes(tahun)) ? '' : 'none';
        });
    }
</script>

</body>
</html>