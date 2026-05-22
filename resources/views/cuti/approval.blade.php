<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Cuti Pegawai</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #00A843;
            padding: 30px;
        }

        .container {
            background: #fff;
            border-radius: 20px;
            padding: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #00A843;
            color: #fff;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            color: #fff;
            font-size: 12px;
        }

        .pending { background: orange; }
        .disetujui { background: green; }
        .ditolak { background: red; }

        .btn {
            background: #00A843;
            color: #fff;
            padding: 6px 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Persetujuan Cuti Pegawai</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Cuti</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($cuti as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td><b>{{ $item['nama'] ?? '-' }}</b></td>

                <td>{{ $item['jenis_cuti'] ?? '-' }}</td>

                {{-- FIX ERROR UTAMA ADA DI SINI --}}
                <td class="tanggal">{{ $item['tanggal_mulai'] ?? '-' }}</td>

                <td>{{ $item['tanggal_selesai'] ?? '-' }}</td>

                <td>{{ $item['alasan_cuti'] ?? '-' }}</td>

                <td>
                    <span class="badge
                        {{ ($item['status'] ?? '') == 'Pending' ? 'pending' : '' }}
                        {{ ($item['status'] ?? '') == 'Disetujui' ? 'disetujui' : '' }}
                        {{ ($item['status'] ?? '') == 'Ditolak' ? 'ditolak' : '' }}
                    ">
                        {{ $item['status'] ?? '-' }}
                    </span>
                </td>

                <td>
                    <select id="status-{{ $item['id'] }}" class="status-select">
                        <option value="Pending" {{ ($item['status'] ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Disetujui" {{ ($item['status'] ?? '') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ ($item['status'] ?? '') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    <button class="btn" onclick="simpanStatus({{ $item['id'] }})">
                        Simpan
                    </button>

                    <div id="msg-{{ $item['id'] }}"></div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align:center;">Data kosong</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

<script>
function simpanStatus(id) {
    let status = document.getElementById('status-' + id).value;

    fetch('/cuti/update-status/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: status })
    })
    .then(res => res.json())
    .then(data => {
        let msg = document.getElementById('msg-' + id);
        msg.style.color = 'green';
        msg.innerHTML = '✔ Status diperbarui';
    })
    .catch(err => {
        let msg = document.getElementById('msg-' + id);
        msg.style.color = 'red';
        msg.innerHTML = '❌ Gagal update';
    });
}
</script>

</body>
</html>