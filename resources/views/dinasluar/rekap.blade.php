<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Rekap Dinas Luar</title>

<style>

body{
    font-family:Arial, sans-serif;
    background:#f4f7f1;
    margin:0;
    padding:30px;
}

/*
|--------------------------------------------------------------------------
| CONTAINER
|--------------------------------------------------------------------------
*/

.container{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

/*
|--------------------------------------------------------------------------
| TITLE
|--------------------------------------------------------------------------
*/

h2{
    color:#4f7f16;
    margin-bottom:20px;
}

/*
|--------------------------------------------------------------------------
| FILTER AREA
|--------------------------------------------------------------------------
*/

.filter-area{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.search-input,
.filter-tahun{
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
}

.search-input{
    width:250px;
}

/*
|--------------------------------------------------------------------------
| TABLE
|--------------------------------------------------------------------------
*/

.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th{
    background:#eef7df;
    color:#4f7f16;
    padding:12px;
    text-align:left;
}

td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#fafafa;
}

/*
|--------------------------------------------------------------------------
| BACK BUTTON
|--------------------------------------------------------------------------
*/

.btn-back{
    display:inline-block;
    margin-top:20px;
    color:#4f7f16;
    text-decoration:none;
    font-weight:bold;
}

.btn-back:hover{
    text-decoration:underline;
}

/*
|--------------------------------------------------------------------------
| EMPTY DATA
|--------------------------------------------------------------------------
*/

.empty-data{
    text-align:center;
    color:#777;
    padding:25px;
}

/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media(max-width:768px){

    body{
        padding:15px;
    }

    .filter-area{
        flex-direction:column;
    }

    .search-input,
    .filter-tahun{
        width:100%;
    }

    table{
        font-size:14px;
    }

}

</style>

</head>

<body>

<div class="container">

<h2>Rekap Dinas Luar</h2>

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

    <!-- FILTER TAHUN 2026+ -->
    <select
        id="tahunFilter"
        class="filter-tahun"
        onchange="filterTahun()"
    >

        <option value="">
            Semua Tahun
        </option>

        @for($i = 2026; $i <= 2035; $i++)

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
    <th>Tanggal Dinas</th>
    <th>Lokasi</th>
    <th>Keterangan</th>
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

</tr>

</tbody>

</table>

</div>

<!-- BACK -->
<a href="{{ route('dashboard') }}"
   class="btn-back">

    ← Kembali

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