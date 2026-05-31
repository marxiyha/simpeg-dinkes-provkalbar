<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Dinas Luar</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-top: 8px solid #166534;
        }

        .header h2 {
            color: #166534;
            font-size: 32px;
            font-weight: 800;
        }

        .header p {
            color: #6b7280;
            margin-top: 6px;
            font-size: 14px;
            line-height: 1.6;
        }

        .filter-area {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin: 26px 0;
        }

        .search-input, .filter-tahun {
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            outline: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: 0.3s;
            background: white;
        }

        .search-input {
            width: 300px;
        }

        .search-input:focus, .filter-tahun:focus {
            border-color: #00A843;
            box-shadow: 0 0 0 4px rgba(0, 168, 67, 0.15);
        }

        .filter-tahun {
            font-weight: 700;
            cursor: pointer;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        thead {
            background: #dcfce7;
        }

        th {
            padding: 18px;
            text-align: left;
            color: #166534;
            font-size: 14px;
            font-weight: 800;
        }

        td {
            padding: 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #374151;
            font-size: 14px;
        }

        tbody tr {
            transition: 0.3s;
        }

        tbody tr:hover {
            background: #f0fdf4;
        }

        .empty-data {
            text-align: center;
            color: #6b7280;
            padding: 40px;
            font-weight: 600;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            margin-top: 24px;
            background: #166534;
            color: white;
            text-decoration: none;
            padding: 14px 24px;
            border-radius: 14px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #0f4422;
            transform: translateY(-2px);
        }

        @media(max-width: 768px) {
            body { padding: 16px; }
            .container { padding: 20px; }
            .search-input, .filter-tahun { width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Rekapitulasi Dinas Luar</h2>
        <p>Halaman rekap data dinas luar seluruh pegawai Dinas Kesehatan secara terintegrasi berdasarkan pencarian nama dan filter tahun.</p>
    </div>

    <div class="filter-area">
        <input type="text" id="searchInput" class="search-input" placeholder="Cari nama pegawai..." onkeyup="jalankanFilter()">

        <select id="tahunFilter" class="filter-tahun" onchange="jalankanFilter()">
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
                    <th>Tanggal Dinas</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dinasLuar as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="nama-pegawai">{{ $item->user->name ?? $item->nama_pegawai ?? 'Tidak Diketahui' }}</td>
                        <td class="tanggal">{{ \Carbon\Carbon::parse($item->tanggal_dinas)->format('d-m-Y') }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-data">
                            Belum ada rekam data dinas luar pegawai yang tersimpan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <a href="{{ route('dashboard') }}" class="btn-back">
        ← Kembali ke Dashboard
    </a>
</div>

<script>
function jalankanFilter() {
    let inputSearch = document.getElementById('searchInput').value.toLowerCase();
    let selectTahun = document.getElementById('tahunFilter').value;
    let rows = document.querySelectorAll('#rekapTable tbody tr');

    rows.forEach(row => {
        let namaCell = row.querySelector('.nama-pegawai');
        let tanggalCell = row.querySelector('.tanggal');

        if (namaCell && tanggalCell) {
            let txtNama = namaCell.textContent || namaCell.innerText;
            let txtTanggal = tanggalCell.textContent || tanggalCell.innerText;

            let cocokNama = txtNama.toLowerCase().indexOf(inputSearch) > -1;
            let cocokTahun = selectTahun === '' || txtTanggal.endsWith(selectTahun);

            if (cocokNama && cocokTahun) {
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