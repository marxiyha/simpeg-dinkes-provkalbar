<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN SI-REKAP</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Segoe UI", Arial, sans-serif; }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f3f4f6;
        }

        .box {
            width: 420px;
            background: #fff;
            padding: 32px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .header { text-align: center; margin-bottom: 24px; }
        .header h1 { font-size: 18px; font-weight: 800; color: #111827; }
        .header p { font-size: 13px; color: #6b7280; margin-top: 5px; }

        label { font-size: 13px; font-weight: 600; color: #374151; display: block; margin-top: 12px; }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #00A843;
            box-shadow: 0 0 0 3px rgba(0, 168, 67, 0.15);
        }

        .btn {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background: #00A843;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover { background: #008d38; }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            font-size: 12px;
            text-align: center;
            margin-bottom: 15px;
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            font-size: 12px;
        }

        .links a { color: #00A843; text-decoration: none; font-weight: 600; }
        .links a:hover { text-decoration: underline; }

        .footer { text-align: center; margin-top: 24px; font-size: 11px; color: #9ca3af; }
    </style>
</head>

<body>

<div class="box">

    <div class="header">
        <h1>Sistem Informasi Rekapitulasi dan Evaluasi Kepegawaian</h1>
        <h1>Dinas Kesehatan Provinsi Kalimantan Barat</h1>
    </div>

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" placeholder="contoh@email.com" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>

        <button type="submit" class="btn">LOGIN</button>
    </form>

    <div class="links">
        <a href="{{ url('/register') }}">Daftar Akun</a>
        <a href="{{ url('/forgot-password') }}">Lupa Password?</a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Sistem Informasi Rekapitulasi dan Evaluasi Kepegawaian Dinas Kesehatan Kalimantan Barat
    </div>

</div>

</body>
</html>