<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SUPER ADMIN DINKES</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Segoe UI', sans-serif;
            background:#5f8f2f;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .auth-container{
            width:420px;
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 15px 35px rgba(0,0,0,0.2);
        }

        .title{
            text-align:center;
            font-size:30px;
            color:#3f6f1f;
            margin-bottom:25px;
            font-weight:bold;
        }

        .input-group{
            margin-bottom:18px;
            position:relative;
        }

        .form-control{
            width:100%;
            padding:14px;
            border-radius:10px;
            border:1px solid #ccc;
            font-size:15px;
            outline:none;
        }

        .form-control:focus{
            border-color:#5f8f2f;
        }

        .toggle-password{
            position:absolute;
            right:15px;
            top:15px;
            cursor:pointer;
            color:#666;
            font-size:14px;
        }

        .btn-auth{
            width:100%;
            padding:14px;
            border:none;
            border-radius:10px;
            background:#5f8f2f;
            color:white;
            font-size:16px;
            cursor:pointer;
        }

        .btn-auth:hover{
            background:#4d7725;
        }

        .link{
            text-align:center;
            margin-top:15px;
        }

        .link a{
            color:#3f6f1f;
            text-decoration:none;
            font-weight:bold;
        }

        .link a:hover{
            text-decoration:underline;
        }

    </style>

</head>

<body>

<div class="auth-container">

    {{ $slot }}

</div>

<script>

    function togglePassword(id){

        const input = document.getElementById(id);

        if(input.type === 'password'){

            input.type = 'text';

        }else{

            input.type = 'password';

        }

    }

</script>

</body>
</html>