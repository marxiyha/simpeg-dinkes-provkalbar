<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>SIMPEG PETINGGI</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
    margin:0;
    font-family:'Plus Jakarta Sans';
    background:#f4f7f1;
}

.topbar{
    background:linear-gradient(90deg,#35580d,#6ba51e);
    padding:18px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;
}

.menu{display:flex;gap:10px;}

.btn{
    padding:10px 14px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:bold;
}

.btn-white{background:white;color:#4f7f16}
.btn-red{background:#b91c1c;color:white}

.container{padding:30px}

.menu-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:15px;
    margin-top:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:15px;
    cursor:pointer;
    border:2px solid transparent;
}

.card:hover{border-color:#6ba51e}

.table-box{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-top:20px;
}

select{
    padding:8px;
    border-radius:8px;
    border:1px solid #ccc;
}
</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
    <div><b>SIMPEG PETINGGI</b></div>

    <div class="menu">

        <button class="btn btn-white"
        onclick="document.getElementById('profile').style.display='block'">
            Profil
        </button>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-red">Logout</button>
        </form>

    </div>
</div>

<div class="container">

<h3>Selamat datang, {{ auth()->user()->name }}</h3>

<!-- MENU -->
<div class="menu-grid">

    <div class="card" onclick="location.href='/cuti/approval'">Approval Cuti</div>
    <div class="card" onclick="location.href='/cuti/rekap'">Rekap Cuti</div>
    <div class="card" onclick="location.href='/dinasluar/kalender'">Kalender DL</div>
    <div class="card" onclick="location.href='/dinasluar/rekap'">Rekap DL</div>

</div>

<br>

<!-- FILTER TAHUN 2026+ -->
<select>
<?php for($i=2026;$i<=2035;$i++): ?>
<option value="<?= $i ?>"><?= $i ?></option>
<?php endfor; ?>
</select>

<!-- CHART -->
<div class="table-box">
<canvas id="chart"></canvas>
</div>

</div>

<!-- PROFILE MODAL -->
<div id="profile"
style="display:none;position:fixed;top:20%;left:35%;
background:white;padding:20px;border-radius:15px;width:350px;">

    <h3>Profil</h3>

    <p><b>Nama:</b> {{ auth()->user()->name }}</p>
    <p><b>Email:</b> {{ auth()->user()->email }}</p>

    <hr>

    <!-- UBAH PASSWORD -->
    <form method="POST" action="/profile/password">
        @csrf

        <input type="password" name="password" placeholder="Password Baru" required><br><br>

        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br><br>

        <button class="btn btn-white" type="submit">Ubah Password</button>
    </form>

    <br>

    <!-- HAPUS AKUN -->
    <form method="POST" action="/profile/delete">
        @csrf
        @method('DELETE')

        <button class="btn btn-red"
        onclick="return confirm('Yakin hapus akun?')">
            Hapus Akun
        </button>
    </form>

    <br>

    <button class="btn btn-white"
    onclick="this.parentElement.style.display='none'">
        Tutup
    </button>

</div>

<!-- CHART -->
<script>
new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
        datasets: [{
            label: 'Cuti',
            data: [5,10,7,12,8,15],
            backgroundColor: '#4f7f16'
        }]
    }
});
</script>

</body>
</html>