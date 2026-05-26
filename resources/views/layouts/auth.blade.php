<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SUPER ADMIN SI-REKAP</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>

        body{
            margin:0;
            padding:0;
            font-family:Segoe UI;
            background:#5d8f2a;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .auth-box{
            width:420px;
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }

        h1{
            text-align:center;
            color:#3d6820;
            margin-bottom:30px;
        }

        input{
            width:100%;
            padding:14px;
            margin-bottom:15px;
            border-radius:10px;
            border:1px solid #ccc;
            font-size:15px;
        }

        button{
            width:100%;
            padding:14px;
            border:none;
            border-radius:10px;
            background:#5d8f2a;
            color:white;
            font-size:16px;
            cursor:pointer;
        }

        button:hover{
            background:#4d7723;
        }

        a{
            color:#3d6820;
            text-decoration:none;
        }

        .text-center{
            text-align:center;
        }

        .mt-3{
            margin-top:15px;
        }

    </style>
</head>
<body>

<div class="auth-box">
    {{ $slot }}
</div>

</body>
</html>