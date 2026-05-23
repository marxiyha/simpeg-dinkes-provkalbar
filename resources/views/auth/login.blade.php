<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Sistem - Dinas Kesehatan Provinsi Kalimantan Barat</title>

<style>

/* =========================
   GLOBAL STYLE
========================= */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Segoe UI", Arial, sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f3f4f6;
}

/* =========================
   LOGIN BOX
========================= */
.login-box{
    width:420px;
    background:#ffffff;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:32px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

/* =========================
   HEADER INSTANSI
========================= */
.header{
    text-align:center;
    margin-bottom:25px;
}

.header img{
    width:70px;
    margin-bottom:10px;
}

.header h1{
    font-size:16px;
    font-weight:700;
    color:#111827;
    line-height:1.4;
}

.header p{
    font-size:13px;
    color:#6b7280;
    margin-top:4px;
}

/* =========================
   FORM
========================= */
.form-group{
    margin-bottom:14px;
}

label{
    display:block;
    font-size:13px;
    font-weight:600;
    color:#374151;
    margin-bottom:6px;
}

input{
    width:100%;
    padding:11px 12px;
    border:1px solid #d1d5db;
    border-radius:8px;
    font-size:14px;
    outline:none;
    transition:0.2s;
}

input:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
}

/* =========================
   BUTTON
========================= */
.btn-login{
    width:100%;
    padding:11px;
    border:none;
    border-radius:8px;
    background:#2563eb;
    color:white;
    font-weight:700;
    cursor:pointer;
    margin-top:10px;
    transition:0.2s;
}

.btn-login:hover{
    background:#1d4ed8;
}

/* =========================
   LINKS
========================= */
.links{
    display:flex;
    justify-content:space-between;
    margin-top:14px;
    font-size:12px;
}

.links a{
    color:#2563eb;
    text-decoration:none;
    font-weight:600;
}

.links a:hover{
    text-decoration:underline;
}

/* =========================
   FOOTER
========================= */
.footer{
    margin-top:18px;
    text-align:center;
    font-size:11px;
    color:#9ca3af;
    line-height:1.5;
}

/* =========================
   RESPONSIVE
========================= */
@media(max-width:500px){
    .login-box{
        width:92%;
    }
}

</style>

</head>

<body>

<div class="login-box">

    <!-- HEADER INSTANSI -->
    <div class="header">

        <!-- kalau ada logo, bisa dipakai -->
        <!-- <img src="{{ asset('logo.png') }}" alt="Logo"> -->

        <h1>
            SISTEM INFORMASI DINAS KESEHATAN
            <br>
            PROVINSI KALIMANTAN BARAT
        </h1>

        <p>
            Silakan login untuk mengakses sistem
        </p>

    </div>

    <!-- FORM LOGIN -->
    <form method="POST" action="{{ route('login') }}">

        @csrf

        <div class="form-group">
            <label>Username / Email</label>
            <input type="text" name="login" placeholder="Masukkan username atau email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn-login">
            MASUK
        </button>

    </form>

    <!-- LINKS -->
    <div class="links">

        <a href="{{ url('/register') }}">
            Daftar Akun
        </a>

        <a href="{{ url('/forgot-password') }}">
            Lupa Password
        </a>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        © {{ date('Y') }} Dinas Kesehatan Provinsi Kalimantan Barat<br>
        Sistem Informasi Internal Pemerintah Daerah
    </div>

</div>

</body>
</html>