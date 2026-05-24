<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>

    <h2>Reset Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- TOKEN WAJIB -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- EMAIL -->
        <div>
            <label>Email</label><br>
            <input type="email" name="email" value="{{ $email }}" required>
        </div>

        <br>

        <!-- PASSWORD BARU -->
        <div>
            <label>Password Baru</label><br>
            <input type="password" name="password" required>
        </div>

        <br>

        <!-- KONFIRMASI PASSWORD -->
        <div>
            <label>Konfirmasi Password</label><br>
            <input type="password" name="password_confirmation" required>
        </div>

        <br>

        <button type="submit">Reset Password</button>
    </form>

</body>
</html>