<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Approval Cuti</title>

<style>
body{
    font-family:Arial;
    background:#f4f7f1;
}

h2{
    color:#4f7f16;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th{
    background:#eef7df;
    padding:12px;
    color:#4f7f16;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

select{
    padding:6px;
    border-radius:8px;
}

.btn{
    background:#4f7f16;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:8px;
    cursor:pointer;
}

.btn:hover{
    background:#35580d;
}
</style>
</head>

<body>

<h2>Approval Cuti Pegawai</h2>

<input placeholder="Cari pegawai..." style="padding:10px;width:200px;">

<select>
    <option>2026</option>
    <option>2027</option>
    <option>2028</option>
</select>

<br><br>

<table>
<tr>
    <th>Nama</th>
    <th>Jenis Cuti</th>
    <th>Tanggal</th>
    <th>Bidang</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<tr>
    <td>Budi Santoso</td>
    <td>Cuti Tahunan</td>
    <td>10-05-2026</td>
    <td>Keuangan</td>

    <td>
        <select>
            <option selected>Pending</option>
            <option>Disetujui</option>
            <option>Ditolak</option>
        </select>
    </td>

    <td>
        <button class="btn">Simpan</button>
    </td>
</tr>

</table>

<br>
<a href="{{ route('dashboard') }}" style="color:#4f7f16;">← Kembali</a>

</body>
</html>