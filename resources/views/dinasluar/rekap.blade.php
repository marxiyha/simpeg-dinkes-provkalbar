<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Rekap Dinas Luar</title>

<style>
body{
    font-family:Arial;
    background:#f4f7f1;
}

h2{
    color:#4f7f16;
}

.container{
    padding:20px;
}

input,select{
    padding:10px;
    margin:5px;
    border-radius:8px;
    border:1px solid #ccc;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    margin-top:15px;
}

th{
    background:#eef7df;
    color:#4f7f16;
    padding:12px;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

.btn-back{
    display:inline-block;
    margin-top:15px;
    color:#4f7f16;
}
</style>
</head>

<body>

<div class="container">

<h2>Rekap Dinas Luar</h2>

<!-- FILTER -->
<input type="text" placeholder="Cari nama pegawai...">

<select>
    <option>2026</option>
    <option>2027</option>
    <option>2028</option>
</select>

<!-- TABLE -->
<table>
<tr>
    <th>Nama</th>
    <th>Tanggal Dinas</th>
    <th>Lokasi</th>
    <th>Keterangan</th>
</tr>

<tr>
    <td>Budi Santoso</td>
    <td>10-05-2026</td>
    <td>Jakarta</td>
    <td>Monitoring Puskesmas</td>
</tr>

<tr>
    <td>Dewi Kurnia</td>
    <td>15-05-2026</td>
    <td>Pontianak</td>
    <td>Survey Lapangan</td>
</tr>

</table>

<a href="{{ route('dashboard') }}" class="btn-back">← Kembali</a>

</div>

</body>
</html>