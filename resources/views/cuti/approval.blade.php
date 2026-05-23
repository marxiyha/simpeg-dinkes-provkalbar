<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Cuti Pegawai - SIMPEG</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #00A843;
            --primary-hover: #008635;
            --bg-light: #f4f6f9;
            --text-dark: #2d3748;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #00732e 100%);
            padding: 40px 20px;
            margin: 0;
            min-height: 100vh;
            color: var(--text-dark);
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            border-radius: 24px;
            padding: 35px;
            max-width: 1200px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            animation: fadeInUp 0.5s ease;
        }

        /* Header Layout */
        .header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header-wrapper h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            color: #1a202c;
            position: relative;
        }

        /* Interactive Back Button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            color: var(--text-dark);
            text-decoration: none;
            padding: 10px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .btn-back:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
            color: #000;
            transform: translateX(-4px);
        }

        .btn-back svg {
            transition: transform 0.3s ease;
        }

        .btn-back:hover svg {
            transform: translateX(-3px);
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            text-align: left;
        }

        th {
            background: #f7fafc;
            color: #4a5568;
            font-weight: 700;
            padding: 16px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
            color: #4a5568;
            vertical-align: middle;
        }

        tr:hover td {
            background-color: #fafd96;
        }

        /* Badges Styling */
        .badge {
            padding: 6px 14px;
            border-radius: 50px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            text-align: center;
            transition: all 0.4s ease;
        }

        .pending { background: #ecc94b; color: #744210; }
        .disetujui { background: #48bb78; color: #1c452d; }
        .ditolak { background: #f56565; color: #651a1a; }

        /* Action Form Elements */
        .action-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .status-select {
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid #cbd5e0;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .status-select:focus {
            border-color: var(--primary);
        }

        .btn-save {
            background: var(--primary);
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .btn-save:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 168, 67, 0.3);
        }

        .btn-save:disabled {
            background: #a0aec0;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .msg-feedback {
            font-size: 12px;
            font-weight: 600;
            margin-top: 4px;
            display: block;
            animation: fadeIn 0.3s ease;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header-wrapper">
        <h2>Persetujuan Cuti Pegawai</h2>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th style="min-width: 220px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($cuti as $index => $item)
                <tr id="row-{{ $item['id'] }}">
                    <td>{{ $index + 1 }}</td>
                    <td><b>{{ $item['nama'] ?? '-' }}</b></td>
                    <td>{{ $item['jenis_cuti'] ?? '-' }}</td>
                    <td>{{ $item['tanggal_mulai'] ?? '-' }}</td>
                    <td>{{ $item['tanggal_selesai'] ?? '-' }}</td>
                    <td>{{ $item['alasan_cuti'] ?? '-' }}</td>
                    <td>
                        <span id="badge-{{ $item['id'] }}" class="badge 
                            {{ ($item['status'] ?? '') == 'Pending' ? 'pending' : '' }}
                            {{ ($item['status'] ?? '') == 'Disetujui' ? 'disetujui' : '' }}
                            {{ ($item['status'] ?? '') == 'Ditolak' ? 'ditolak' : '' }}
                        ">
                            {{ $item['status'] ?? '-' }}
                        </span>
                    </td>

                    <td>
                        <div class="action-cell">
                            <select id="status-{{ $item['id'] }}" class="status-select">
                                <option value="Pending" {{ ($item['status'] ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Disetujui" {{ ($item['status'] ?? '') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ ($item['status'] ?? '') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>

                            <button id="btn-save-{{ $item['id'] }}" class="btn-save" onclick="simpanStatus({{ $item['id'] }})">
                                Simpan
                            </button>
                        </div>
                        <div id="msg-{{ $item['id'] }}" class="msg-feedback"></div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding: 40px; color: #a0aec0;">
                        <b>Tidak ada pengajuan cuti yang perlu diproses.</b>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

<script>
function simpanStatus(id) {
    let selectElement = document.getElementById('status-' + id);
    let buttonElement = document.getElementById('btn-save-' + id);
    let badgeElement = document.getElementById('badge-' + id);
    let msgElement = document.getElementById('msg-' + id);
    
    let statusBaru = selectElement.value;

    // Loading State Efek Interaktif
    buttonElement.disabled = true;
    buttonElement.innerText = 'Proses...';
    msgElement.innerHTML = '';

    fetch('/cuti/update-status/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: statusBaru })
    })
    .then(res => res.json())
    .then(data => {
        // Kembalikan status tombol
        buttonElement.disabled = false;
        buttonElement.innerText = 'Simpan';

        // 🌟 UPDATE BADGE SECARA REAL-TIME TANPA REFRESH
        badgeElement.innerText = statusBaru;
        
        // Bersihkan class badge lama
        badgeElement.className = 'badge';
        
        // Berikan class warna baru yang sesuai
        if(statusBaru === 'Pending') badgeElement.classList.add('pending');
        if(statusBaru === 'Disetujui') badgeElement.classList.add('disetujui');
        if(statusBaru === 'Ditolak') badgeElement.classList.add('ditolak');

        // Beri feedback teks sukses
        msgElement.style.color = '#48bb78';
        msgElement.innerHTML = '✔ Berhasil diperbarui';

        // Hilangkan pesan sukses setelah 3 detik
        setTimeout(() => { msgElement.innerHTML = ''; }, 3000);
    })
    .catch(err => {
        buttonElement.disabled = false;
        buttonElement.innerText = 'Simpan';
        
        msgElement.style.color = '#f56565';
        msgElement.innerHTML = '❌ Gagal memperbarui status';
    });
}
</script>

</body>
</html>