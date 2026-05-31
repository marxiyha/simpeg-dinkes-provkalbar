<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Persetujuan Cuti Pegawai</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
    --primary:#00A843;
    --dark:#008635;

    --pending:#f6c453;
    --approved:#48bb78;
    --rejected:#f56565;

    --text:#2d3748;
}

*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:'Plus Jakarta Sans', sans-serif;
    background:linear-gradient(135deg,var(--primary),#00732e);
    padding:30px;
    color:var(--text);
}

/* CONTAINER */
.container{
    background:white;
    max-width:1200px;
    margin:auto;
    border-radius:25px;
    padding:30px;
    box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    margin-bottom:20px;
}

.header h2{
    font-size:26px;
    color:#166534;
}

.nav{
    display:flex;
    gap:10px;
}

.btn{
    padding:10px 14px;
    border-radius:12px;
    text-decoration:none;
    font-weight:700;
    display:inline-flex;
    align-items:center;
}

.btn-back{
    background:white;
    border:1px solid #ddd;
    color:#333;
}

.btn-primary{
    background:var(--primary);
    color:white;
}

/* FILTER */
.filter{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin:15px 0;
}

input,select{
    padding:12px;
    border-radius:12px;
    border:2px solid #e2e8f0;
    outline:none;
}

input{
    flex:1;
    min-width:220px;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    border-radius:15px;
    overflow:hidden;
}

thead{
    background:linear-gradient(90deg,#00A843,#008d38);
    color:white;
}

th,td{
    padding:14px;
    font-size:14px;
    border-bottom:1px solid #eee;
}

tr:hover td{
    background:#f8fff9;
}

/* BADGE */
.badge{
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:700;
    color:white;
}

.pending{background:var(--pending);color:#5a3d00;}
.disetujui{background:var(--approved);}
.ditolak{background:var(--rejected);}

/* BUTTON */
button{
    padding:8px 12px;
    border:none;
    border-radius:10px;
    background:var(--primary);
    color:white;
    cursor:pointer;
}

button:hover{background:var(--dark);}

.msg{
    font-size:12px;
    margin-top:4px;
}
</style>
</head>

<body>

<div class="container">

<!-- HEADER -->
<div class="header">
    <h2>Persetujuan Cuti Pegawai</h2>

    <div class="nav">
        <a href="{{ route('dashboard') }}" class="btn btn-back">Dashboard</a>
        <a href="{{ route('cuti.rekap') }}" class="btn btn-primary">Rekap Cuti</a>
    </div>
</div>

<!-- FILTER -->
<div class="filter">
    <input type="text" id="searchBox" placeholder="Cari nama / jenis / status...">

    <select id="tahunFilter">
        <option value="">Semua Tahun</option>
        @for($i=2024;$i<=2029;$i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
</div>

<!-- TABLE -->
<table id="tableCuti">

<thead>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Jenis</th>
    <th>Tanggal Mulai</th>
    <th>Tanggal Selesai</th>
    <th>Alasan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse($cuti as $i => $item)
<tr>

    <td>{{ $i+1 }}</td>

    <td><b>{{ $item['nama'] }}</b></td>
    <td>{{ $item['jenis_cuti'] }}</td>

    <td class="tanggal">{{ $item['tanggal_mulai'] }}</td>
    <td class="tanggal">{{ $item['tanggal_selesai'] }}</td>

    <td>{{ $item['alasan_cuti'] }}</td>

    <td>
        <span id="badge-{{ $item['id'] }}"
        class="badge 
        @if($item['status']=='Pending') pending
        @elseif($item['status']=='Disetujui') disetujui
        @else ditolak @endif">
        {{ $item['status'] }}
        </span>
    </td>

    <td>
        <select id="status-{{ $item['id'] }}">
            <option value="Pending">Pending</option>
            <option value="Disetujui">Disetujui</option>
            <option value="Ditolak">Ditolak</option>
        </select>

        <button onclick="updateStatus({{ $item['id'] }})">Simpan</button>

        <div class="msg" id="msg-{{ $item['id'] }}"></div>
    </td>

</tr>
@empty
<tr>
    <td colspan="8" style="text-align:center;">Tidak ada data cuti</td>
</tr>
@endforelse

</tbody>

</table>

</div>

<script>

/* SEARCH */
document.getElementById('searchBox').addEventListener('keyup', function () {
    let val = this.value.toLowerCase();

    document.querySelectorAll('#tableCuti tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(val) ? '' : 'none';
    });
});

/* FILTER TAHUN */
document.getElementById('tahunFilter').addEventListener('change', function () {
    let tahun = this.value;

    document.querySelectorAll('#tableCuti tbody tr').forEach(row => {
        let tgl = row.querySelectorAll('.tanggal');
        let match = false;

        tgl.forEach(td => {
            if (td.innerText.includes(tahun)) {
                match = true;
            }
        });

        if (tahun === '' || match) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

/* UPDATE STATUS */
function updateStatus(id){

    let status = document.getElementById('status-'+id).value;
    let badge  = document.getElementById('badge-'+id);
    let msg    = document.getElementById('msg-'+id);

    msg.innerHTML = "Menyimpan...";

    fetch('/petinggi/cuti/update-status/'+id,{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
        },
        body:JSON.stringify({status})
    })
    .then(res=>res.json())
    .then(data=>{

        if(!data.success){
            msg.innerHTML="❌ Gagal";
            return;
        }

        badge.innerHTML = status;
        badge.className = "badge";

        if(status==="Pending") badge.classList.add("pending");
        if(status==="Disetujui") badge.classList.add("disetujui");
        if(status==="Ditolak") badge.classList.add("ditolak");

        msg.innerHTML="✔ Tersimpan";

        setTimeout(()=>msg.innerHTML="",2000);
    })
    .catch(()=>{
        msg.innerHTML="❌ Error server";
    });
}

</script>

</body>
</html>