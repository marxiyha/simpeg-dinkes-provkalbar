<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Dinas Kesehatan Kalbar</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Segoe UI", Arial; }
        body { height: 100vh; display: flex; justify-content: center; align-items: center; background: #f3f4f6; }
        .box { width: 420px; background: #fff; padding: 32px; border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 8px 25px rgba(0,0,0,0.08); }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 18px; font-weight: 700; color: #111827; }
        .header p { font-size: 13px; color: #6b7280; margin-top: 5px; }
        
        /* Error Message Style */
        .error-box { background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; font-size: 12px; margin-bottom: 15px; }
        
        label { font-size: 13px; font-weight: 600; color: #374151; display: block; margin-top: 10px; }
        input { width: 100%; padding: 11px; margin-top: 4px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; }
        input:focus { border-color: #00A843; box-shadow: 0 0 0 3px rgba(0,168,67,0.15); }
        
        .btn { width: 100%; padding: 12px; margin-top: 20px; background: #00A843; border: none; border-radius: 8px; color: white; font-weight: 700; cursor: pointer; }
        .btn:hover { background: #008d38; }
        
        .links { display: flex; justify-content: space-between; margin-top: 14px; font-size: 12px; }
        .links a { color: #00A843; text-decoration: none; font-weight: 600; }
        
        .footer { text-align: center; margin-top: 18px; font-size: 11px; color: #9ca3af; }
    </style>
</head>
<body>

<div class="box">
    <div class="header">
        <h1>RESET PASSWORD</h1>
        <p>Masukkan email dan password baru Anda</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <ul style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>

        <label>Password Baru</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit" class="btn">SIMPAN PASSWORD</button>
    </form>

    <div class="links">
        <a href="{{ route('login') }}">← Kembali Login</a>
        <a href="{{ route('register') }}">Daftar Baru</a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Dinas Kesehatan Kalbar
    </div>
</div>

</body>
</html>