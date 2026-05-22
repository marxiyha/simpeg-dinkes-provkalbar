<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Rekapitulasi Dinas Luar</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
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
    margin:0;
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
    border-radius:24px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    border-top:8px solid #00A843;
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
    gap:16px;
    margin-bottom:28px;
}

.header h2{
    color:#166534;
    font-size:32px;
    font-weight:800;
}

.header p{
    color:#6b7280;
    margin-top:8px;
    line-height:1.7;
    font-size:14px;
}

/*
|--------------------------------------------------------------------------
| FILTER AREA
|--------------------------------------------------------------------------
*/

.filter-area{
    display:flex;
    gap:14px;
    flex-wrap:wrap;
    margin-bottom:26px;
}

.search-input,
.filter-tahun{
    padding:14px 16px;
    border-radius:14px;
    border:1px solid #d1d5db;
    outline:none;
    font-family:'Plus Jakarta Sans', sans-serif;
    transition:0.3s;
    background:white;
}

.search-input{
    width:280px;
}

.search-input:focus,
.filter-tahun:focus{
    border-color:#00A843;
    box-shadow:0 0 0 4px rgba(0,168,67,0.15);
}

.filter-tahun{
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
    border-radius:20px;
    border:1px solid #e5e7eb;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

thead{
    background:#dcfce7;
}

th{
    padding:18px;
    text-align:left;
    color:#166534;
    font-size:14px;
    font-weight:800;
}

td{
    padding:18px;
    border-bottom:1px solid #f1f5f9;
    color:#374151;
    font-size:14px;
}

tbody tr{
    transition:0.3s;
}

tbody tr:hover{
    background:#f0fdf4;
}

/*
|--------------------------------------------------------------------------
| BADGE
|--------------------------------------------------------------------------
*/

.badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background:#dcfce7;
    color:#15803d;
    padding:8px 14px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
}

/*
|--------------------------------------------------------------------------
| EMPTY DATA
|--------------------------------------------------------------------------
*/

.empty-data{
    text-align:center;
    color:#6b7280;
    padding:30px;
    font-weight:600;
}

/*
|--------------------------------------------------------------------------
| BUTTON
|--------------------------------------------------------------------------
*/

.btn-back{
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-top:24px;
    background:#00A843;
    color:white;
    text-decoration:none;
    padding:14px 20px;
    border-radius:14px;
    font-weight:700;
    transition:0.3s;
}

.btn-back:hover{
    background:#008d38;
    transform:translateY(-2px);
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
        padding:20px;
    }

    .header{
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-area{
        flex-direction:column;
    }

    .search-input,
    .filter-tahun{
        width:100%;
    }

    table{
        font-size:13px;
    }

    th,
    td{
        padding:14px;
    }

    .header h2{
        font-size:26px;
    }

}

</style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div>

            <h2>
                Rekapitulasi Dinas Luar
            </h2>

            <p>
                Halaman ini digunakan untuk melihat seluruh data kegiatan dinas luar pegawai berdasarkan tanggal, lokasi, dan keterangan kegiatan secara terintegrasi.
            </p>

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

                    <th>Nama Pegawai</th>

                    <th>Tanggal Dinas</th>

                    <th>Lokasi</th>

                    <th>Keterangan</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>1</td>

                    <td>
                        Budi Santoso
                    </td>

                    <td class="tanggal">
                        10-05-2026
                    </td>

                    <td>
                        Jakarta
                    </td>

                    <td>
                        Monitoring Puskesmas
                    </td>

                    <td>

                        <span class="badge">

                            Aktif

                        </span>

                    </td>

                </tr>

                <tr>

                    <td>2</td>

                    <td>
                        Dewi Kurnia
                    </td>

                    <td class="tanggal">
                        15-05-2026
                    </td>

                    <td>
                        Pontianak
                    </td>

                    <td>
                        Survey Lapangan
                    </td>

                    <td>

                        <span class="badge">

                            Aktif

                        </span>

                    </td>

                </tr>

                <tr>

                    <td>3</td>

                    <td>
                        Andi Saputra
                    </td>

                    <td class="tanggal">
                        12-07-2027
                    </td>

                    <td>
                        Bandung
                    </td>

                    <td>
                        Evaluasi Program
                    </td>

                    <td>

                        <span class="badge">

                            Aktif

                        </span>

                    </td>

                </tr>

                <tr>

                    <td>4</td>

                    <td>
                        Maria Grace
                    </td>

                    <td class="tanggal">
                        20-08-2028
                    </td>

                    <td>
                        Surabaya
                    </td>

                    <td>
                        Kunjungan Dinas
                    </td>

                    <td>

                        <span class="badge">

                            Aktif

                        </span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <!-- BACK -->
    <a href="{{ route('dashboard') }}"
       class="btn-back">

        ← Kembali ke Dashboard

    </a>

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