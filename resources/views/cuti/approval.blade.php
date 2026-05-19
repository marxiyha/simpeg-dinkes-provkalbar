<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Approval Cuti Pegawai</title>

<meta name="csrf-token"
      content="{{ csrf_token() }}">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:Arial, sans-serif;
    background:#f4f7f1;
    padding:30px;
}

/*
|--------------------------------------------------------------------------
| CONTAINER
|--------------------------------------------------------------------------
*/

.container{
    width:100%;
    background:white;
    border-radius:16px;
    padding:25px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
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
    margin-bottom:25px;
}

.header h2{
    color:#4f7f16;
    font-size:28px;
}

/*
|--------------------------------------------------------------------------
| FILTER
|--------------------------------------------------------------------------
*/

.filter-area{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.search-input{
    padding:12px;
    width:250px;
    border:1px solid #ccc;
    border-radius:10px;
    outline:none;
}

.search-input:focus{
    border-color:#4f7f16;
}

.filter-tahun{
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
    outline:none;
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

thead{
    background:#eef7df;
}

th{
    padding:15px;
    text-align:left;
    color:#4f7f16;
    font-size:15px;
}

td{
    padding:14px;
    border-bottom:1px solid #e5e5e5;
    vertical-align:middle;
}

tr:hover{
    background:#fafafa;
}

/*
|--------------------------------------------------------------------------
| BADGE STATUS
|--------------------------------------------------------------------------
*/

.badge{
    padding:7px 12px;
    border-radius:20px;
    color:white;
    font-size:12px;
    font-weight:bold;
    display:inline-block;
}

.pending{
    background:#f39c12;
}

.disetujui{
    background:#27ae60;
}

.ditolak{
    background:#e74c3c;
}

/*
|--------------------------------------------------------------------------
| SELECT STATUS
|--------------------------------------------------------------------------
*/

.status-select{
    padding:9px;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
    width:140px;
}

/*
|--------------------------------------------------------------------------
| BUTTON
|--------------------------------------------------------------------------
*/

.btn{
    background:#4f7f16;
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
    font-weight:bold;
}

.btn:hover{
    background:#35580d;
}

/*
|--------------------------------------------------------------------------
| MESSAGE
|--------------------------------------------------------------------------
*/

.success-message{
    color:green;
    margin-top:6px;
    font-size:13px;
}

.error-message{
    color:red;
    margin-top:6px;
    font-size:13px;
}

/*
|--------------------------------------------------------------------------
| BACK BUTTON
|--------------------------------------------------------------------------
*/

.back-link{
    display:inline-block;
    margin-top:25px;
    text-decoration:none;
    color:#4f7f16;
    font-weight:bold;
}

.back-link:hover{
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
    padding:30px;
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

    .header{
        flex-direction:column;
        align-items:flex-start;
    }

    .filter-area{
        flex-direction:column;
        width:100%;
    }

    .search-input{
        width:100%;
    }

    .filter-tahun{
        width:100%;
    }

    table{
        font-size:14px;
    }

    .btn{
        width:100%;
    }

}

</style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <h2>
            Approval Cuti Pegawai
        </h2>

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

        <table id="cutiTable">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama Pegawai</th>

                    <th>Jenis Cuti</th>

                    <th>Tanggal</th>

                    <th>Bidang</th>

                    <th>Status Saat Ini</th>

                    <th>Ubah Status</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($cuti as $index => $item)

                <tr>

                    <td>
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item['nama'] }}
                    </td>

                    <td>
                        {{ $item['jenis_cuti'] }}
                    </td>

                    <td class="tanggal">
                        {{ $item['tanggal'] }}
                    </td>

                    <td>
                        {{ $item['bidang'] }}
                    </td>

                    <td>

                        <span
                            id="badge-{{ $item['id'] }}"
                            class="badge
                            {{ $item['status'] == 'Pending' ? 'pending' : '' }}
                            {{ $item['status'] == 'Disetujui' ? 'disetujui' : '' }}
                            {{ $item['status'] == 'Ditolak' ? 'ditolak' : '' }}"
                        >

                            {{ $item['status'] }}

                        </span>

                    </td>

                    <td>

                        <select
                            id="status-{{ $item['id'] }}"
                            class="status-select"
                        >

                            <option
                                value="Pending"
                                {{ $item['status'] == 'Pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="Disetujui"
                                {{ $item['status'] == 'Disetujui' ? 'selected' : '' }}
                            >
                                Disetujui
                            </option>

                            <option
                                value="Ditolak"
                                {{ $item['status'] == 'Ditolak' ? 'selected' : '' }}
                            >
                                Ditolak
                            </option>

                        </select>

                    </td>

                    <td>

                        <button
                            type="button"
                            class="btn"
                            onclick="simpanStatus({{ $item['id'] }})"
                        >
                            Simpan
                        </button>

                        <div id="msg-{{ $item['id'] }}"></div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8"
                        class="empty-data">

                        Data cuti tidak tersedia

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <!-- BACK -->
    <a href="{{ route('dashboard') }}"
       class="back-link">

        ← Kembali ke Dashboard

    </a>

</div>

<script>

/*
|--------------------------------------------------------------------------
| SIMPAN STATUS TANPA REFRESH
|--------------------------------------------------------------------------
*/

function simpanStatus(id)
{
    let status =
        document.getElementById(
            'status-' + id
        ).value;

    fetch('/cuti/update-status/' + id,
    {

        method:'POST',

        headers:
        {
            'Content-Type':'application/json',

            'X-CSRF-TOKEN':
            document.querySelector(
                'meta[name="csrf-token"]'
            ).content
        },

        body:JSON.stringify(
        {
            status:status
        })

    })

    .then(response =>
    {
        if(!response.ok)
        {
            throw new Error('Gagal');
        }

        return response.json();
    })

    .then(data =>
    {

        /*
        |--------------------------------------------------------------------------
        | UPDATE BADGE STATUS
        |--------------------------------------------------------------------------
        */

        let badge =
            document.getElementById(
                'badge-' + id
            );

        badge.innerHTML = status;

        badge.className = 'badge';

        if(status === 'Pending')
        {
            badge.classList.add('pending');
        }

        if(status === 'Disetujui')
        {
            badge.classList.add('disetujui');
        }

        if(status === 'Ditolak')
        {
            badge.classList.add('ditolak');
        }

        /*
        |--------------------------------------------------------------------------
        | SUCCESS MESSAGE
        |--------------------------------------------------------------------------
        */

        let msg =
            document.getElementById(
                'msg-' + id
            );

        msg.className =
            'success-message';

        msg.innerHTML =
            '✔ Status berhasil disimpan';

        setTimeout(() =>
        {
            msg.innerHTML = '';
        }, 2500);

    })

    .catch(error =>
    {

        let msg =
            document.getElementById(
                'msg-' + id
            );

        msg.className =
            'error-message';

        msg.innerHTML =
            '❌ Gagal menyimpan';

        console.log(error);

    });
}

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
            'cutiTable'
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
            '#cutiTable tbody tr'
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