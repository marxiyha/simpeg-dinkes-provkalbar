<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP SI-REKAP</title>

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

        .timer {
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            color: #00A843;
            margin-bottom: 20px;
            padding: 8px;
            background: #f0fdf4;
            border-radius: 8px;
        }

        .otp-container {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 25px;
        }

        .otp-input {
            width: 50px;
            height: 55px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            outline: none;
            transition: 0.3s;
        }

        .otp-input:focus {
            border-color: #00A843;
            box-shadow: 0 0 0 3px rgba(0, 168, 67, 0.15);
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #00A843;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover { background: #008d38; }

        .resend-btn {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #f9fafb;
            color: #374151;
            font-weight: 600;
            cursor: pointer;
        }

        .error { background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 8px; font-size: 12px; text-align: center; margin-bottom: 15px; }
        .success { background: #dcfce7; color: #166534; padding: 10px; border-radius: 8px; font-size: 12px; text-align: center; margin-bottom: 15px; }
    </style>
</head>

<body>

<div class="box">
    <div class="header">
        <h1>VERIFIKASI OTP SI-REKAP</h1>
        <h1>Sistem Informasi Rekapitulasi dan Evaluasi Kepegawaian</h1>
        <p>Masukkan 6 digit kode dari log Laravel</p>
    </div>

    <div class="timer" id="timer">OTP expired dalam: 05:00</div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST" id="otpForm">
        @csrf
        <div class="otp-container">
            <input type="text" maxlength="1" class="otp-input" pattern="\d*">
            <input type="text" maxlength="1" class="otp-input" pattern="\d*">
            <input type="text" maxlength="1" class="otp-input" pattern="\d*">
            <input type="text" maxlength="1" class="otp-input" pattern="\d*">
            <input type="text" maxlength="1" class="otp-input" pattern="\d*">
            <input type="text" maxlength="1" class="otp-input" pattern="\d*">
        </div>
        <input type="hidden" name="otp" id="otp">
        <button type="submit" class="btn">VERIFIKASI</button>
    </form>

    <form action="{{ route('otp.resend') }}" method="POST">
        @csrf
        <button type="submit" class="resend-btn">Kirim Ulang OTP</button>
    </form>
</div>

<script>
    // Logika Auto-Focus dan Timer sama seperti sebelumnya
    const inputs = document.querySelectorAll('.otp-input');
    const hiddenInput = document.getElementById('otp');
    const form = document.getElementById('otpForm');

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/[^0-9]/g, '');
            if (input.value && index < inputs.length - 1) inputs[index + 1].focus();
            updateOtp();
            if (hiddenInput.value.length === 6) form.submit();
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) inputs[index - 1].focus();
        });
    });

    function updateOtp() {
        let otp = '';
        inputs.forEach(input => otp += input.value);
        hiddenInput.value = otp;
    }

    let duration = 300;
    const timerDisplay = document.getElementById('timer');
    setInterval(() => {
        let m = Math.floor(duration / 60);
        let s = duration % 60;
        timerDisplay.innerHTML = `OTP expired dalam: ${m < 10 ? '0'+m : m}:${s < 10 ? '0'+s : s}`;
        duration--;
        if (duration < 0) timerDisplay.innerHTML = 'OTP sudah expired';
    }, 1000);
</script>

</body>
</html>