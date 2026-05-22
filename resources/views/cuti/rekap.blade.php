<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Rekapitulasi Cuti Pegawai</title>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
      rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Plus Jakarta Sans', sans-serif;
    background:#00A843;
    padding:30px;
    color:#1f2937;
}

/*
|--------------------------------------------------------------------------
| CONTAINER
|--------------------------------------------------------------------------
*/

.container{
    background:white;
    padding:30px;
    border-radius:28px;
    box-shadow:0 12px 35px rgba(0,0,0,0.12);
    animation:fadeIn 0.5s ease;
}

@keyframes fadeIn{

    from{
        opacity:0;
        transform:translateY(15px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }

}

/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:15px;
    margin-bottom:28px;
}

.header-left h2{
    color:#166534;
    font-size:34px;
    font-weight:800;
    margin-bottom:8px;
}

.header-left p{
    color:#6b7280;
    line-height:1.8;
    font-size:14px;
}

.header-badge{
    background:#dcfce7;
    color:#15803d;
    padding:12px 18px;
    border-radius:999px;
    font-weight:800;
    font-size:14px;
}

/*
|--------------------------------------------------------------------------
| FILTER AREA
|--------------------------------------------------------------------------
*/

.filter-area{
    display:flex;
    gap:16px;
    flex-wrap:wrap;
    margin-bottom:25px;
}

.search-input,
.filter-tahun{
    padding:14px 18px;
    border-radius:14px;
    border:2px solid #d1d5db;
    outline:none;
    font-family:'Plus Jakarta Sans', sans-serif;
    transition:0.3s;
    font-size:14px;
}

.search-input{
    width:280px;
}

.search-input:focus,
.filter-tahun:focus{
    border-color:#00A843;
    box-shadow:0 0 0 5px rgba(0,168,67,0.12);
}

.filter-tahun{
    min-width:180px;
    font-weight:700;
    cursor:pointer;
}

/*
|--------------------------------------------------------------------------
| TABLE
|--------------------------------------------------------------------------
*/

.table-wrapper{
    overflow-x:auto;
    border-radius:22px;
    border:1px solid #e5e7eb;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

thead{
    background:linear-gradient(90deg,#00A843,#008D38);
}

th{
    color:white;
    padding:18px 16px;
    text-align:left;
    font-size:14px;
    font-weight:800;
    white-space:nowrap;
}

td{
    padding:18px 16px;
    border-bottom:1px solid #f1f5f9;
    font-size:14px;
}

tbody tr{
    transition:0.25s;
}

tbody tr:hover{
    background:#f0fdf4;
}

/*
|--------------------------------------------------------------------------
| NOMOR
|--------------------------------------------------------------------------
*/

.nomor-box{
    width:36px;
    height:36px;
    border-radius:12px;
    background:#dcfce7;
    color:#166534;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:800;
}

/*
|--------------------------------------------------------------------------
| STATUS
|--------------------------------------------------------------------------
*/

.status{
    padding:8px 14px;
    border-radius:999px;
    color:white;
    font-size:12px;
    font-weight:800;
    display:inline-block;
    min-width:100px;
    text-align:center;
}

.pending{
    background:#f59e0b;
}

.approved{
    background:#00A843;
}

.rejected{
    background:#ef4444;
}

/*
|--------------------------------------------------------------------------
| BACK BUTTON
|--------------------------------------------------------------------------
*/

.back-area{
    margin-top:28px;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:14px 18px;
    background:white;
    color:#166534;
    text-decoration:none;
    border-radius:14px;
    border:2px solid #dcfce7;
    font-weight:800;
    transition:0.3s;
}

.btn-back:hover{
    background:#dcfce7;
    transform:translateX(-4px);
}

/*
|--------------------------------------------------------------------------
| EMPTY DATA
|--------------------------------------------------------------------------
*/

.empty-data{
    text-align:center;
    color:#6b7280;
    padding:40px;
    font-size:15px;
    font-weight:600;
}

/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media(max-width:768px){

    body{
        padding:16px;
    }

    .container{
        padding:22px;
        border-radius:22px;
    }

    .header{
        flex-direction:column;
        align-items:flex-start;
    }

    .header-left h2{
        font-size:28px;
    }

    .filter-area{
        flex-direction:column;
    }

    .search-input,
    .filter-tahun{
        width:100%;
    }

    table{
        min-width:700px;
    }

}

</style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="header-left">

            <h2>
                Rekapitulasi Cuti Pegawai
            </h2>

            <p>
                Halaman ini digunakan untuk melihat rekapitulasi dan laporan data pengajuan cuti pegawai berdasarkan tahun dan status pengajuan.
            </p>

        </div>

        <div class="header-badge">

            Rekap Data Aktif

        </div>

    </div>

    <!-- FILTER -->
    <div class="filter-area">

        <!-- SEARCH -->
        <input
            type="text"
            id="searchInput"
            class="search-input"
            placeholder="Cari nama pegawai..."
            onkeyup="searchPegawai()"
        >

        <!-- FILTER TAHUN -->
        <select
            id="tahunFilter"
            class="filter-tahun"
            onchange="filterTahun()"
        >

            <option value="">
                Semua Tahun
            </option>

            @for($i = 2024; $i <= 2029; $i++)

                <option value="{{ $i }}">

                    {{ $i }}

                </option>

            @endfor

        </select>

    </div>

    <!-- TABLE -->
    <div class="table-wrapper">

        <table id="rekapTable">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan Cuti</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

            @forelse($data as $index => $item)

            <tr>

                <td>

                    <div class="nomor-box">

                        {{ $index + 1 }}

                    </div>

                </td>

                <td>

                    <b>{{ $item['nama'] }}</b>

                </td>

                <td class="tanggal">

                    {{ $item['tanggal'] }}

                </td>

                <td>

                    {{ $item['bidang'] }}

                </td>

                <td>

                    @if($item['status'] == 'Pending')

                        <span class="status pending">

                            Pending

                        </span>

                    @elseif($item['status'] == 'Disetujui')

                        <span class="status approved">

                            Disetujui

                        </span>

                    @elseif($item['status'] == 'Ditolak')

                        <span class="status rejected">

                            Ditolak

                        </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="5"
                    class="empty-data">

                    Data rekap cuti tidak tersedia

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <!-- BACK -->
    <div class="back-area">

        <a href="{{ route('dashboard') }}"
           class="btn-back">

            ← Kembali ke Dashboard

        </a>

    </div>

</div>

<script>

/*
|--------------------------------------------------------------------------
| SEARCH PEGAWAI
|--------------------------------------------------------------------------
*/

function searchPegawai()
{
    let input =
        document.getElementById(
            'searchInput'
        );

    let filter =
        input.value.toLowerCase();

    let table =
        document.getElementById(
            'rekapTable'
        );

    let tr =
        table.getElementsByTagName(
            'tr'
        );

    for(let i = 1; i < tr.length; i++)
    {
        let td =
            tr[i].getElementsByTagName(
                'td'
            )[1];

        if(td)
        {
            let txtValue =
                td.textContent ||
                td.innerText;

            if(
                txtValue
                .toLowerCase()
                .indexOf(filter) > -1
            )
            {
                tr[i].style.display = '';
            }
            else
            {
                tr[i].style.display = 'none';
            }
        }
    }
}

/*
|--------------------------------------------------------------------------
| FILTER TAHUN
|--------------------------------------------------------------------------
*/

function filterTahun()
{
    let tahun =
        document.getElementById(
            'tahunFilter'
        ).value;

    let rows =
        document.querySelectorAll(
            '#rekapTable tbody tr'
        );

    rows.forEach(row =>
    {
        let tanggalCell =
            row.querySelector('.tanggal');

        if(tanggalCell)
        {
            let tanggal =
                tanggalCell.innerText;

            if(
                tahun === '' ||
                tanggal.includes(tahun)
            )
            {
                row.style.display = '';
            }
            else
            {
                row.style.display = 'none';
            }
        }
    });
}

</script>

</body>

</html>