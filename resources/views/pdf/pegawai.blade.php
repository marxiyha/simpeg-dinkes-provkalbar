<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pegawai</title>
    <style>
        /* Pengaturan Kertas */
        @page {
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            text-transform: uppercase;
            margin: 0;
            color: #000;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #2d5a27; /* Hijau Tua Formal */
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
        }
        td {
            border: 1px solid #ccc;
            padding: 8px;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Pegawai</h2>
        <p>Sistem Informasi Kepegawaian - Dinas Kesehatan Provinsi Kalimantan Barat</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>NIP</th>
                <th>Unit Kerja</th>
                <th>Jabatan</th>
                <th>Status Pegawai</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $d->nama_pegawai ?? '-' }}</td>
                <td>{{ $d->email ?? '-' }}</td>
                <td>{{ $d->nip ?? '-' }}</td>
                <td>{{ $d->upt_unit ?? '-' }}</td>
                <td>{{ $d->jabatan ?? '-' }}</td>
                <td>{{ $d->status_pegawai ?? '-' }}</td>
                <td>{{ $d->jenis_kelamin ?? '-' }}</td>
                <td>{{ $d->tanggal_lahir ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </div>

</body>
</html>