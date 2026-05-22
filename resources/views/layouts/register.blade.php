<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Dinas Kesehatan Kalbar</title>

<style>

/* SAME STYLE LOGIN (CONSISTENT) */
*{margin:0;padding:0;box-sizing:border-box;font-family:"Segoe UI",Arial;}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f3f4f6;
}

.box{
    width:420px;
    background:#fff;
    padding:32px;
    border-radius:12px;
    border:1px solid #e5e7eb;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.header{
    text-align:center;
    margin-bottom:20px;
}

.header h1{
    font-size:16px;
    font-weight:700;
    color:#111827;
}

.header p{
    font-size:13px;
    color:#6b7280;
}

label{
    font-size:13px;
    font-weight:600;
    color:#374151;
}

input{
    width:100%;
    padding:11px;
    margin-top:6px;
    margin-bottom:12px;
    border:1px solid #d1d5db;
    border-radius:8px;
}

input:focus{
    border-color:#00A843;
    box-shadow:0 0 0 3px rgba(0,168,67,0.15);
}

.btn{
    width:100%;
    padding:11px;
    background:#00A843;
    border:none;
    border-radius:8px;
    color:white;
    font-weight:700;
}

.btn:hover{
    background:#008d38;
}

.links{
    text-align:center;
    margin-top:14px;
    font-size:12px;
}

.links a{
    color:#00A843;
    font-weight:600;
    text-decoration:none;
}

.footer{
    text-align:center;
    margin-top:18px;
    font-size:11px;
    color:#9ca3af;
}

</style>

</head>

<body>

<div class="box">

    <div class="header">
        <h1>REGISTRASI AKUN</h1>
        <p>Dinas Kesehatan Provinsi Kalimantan Barat</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Nama</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>

        <button class="btn">DAFTAR</button>
    </form>

    <div class="links">
        <a href="{{ url('/login') }}">Sudah punya akun? Login</a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Dinas Kesehatan Kalbar
    </div>

</div>

</body>
</html>