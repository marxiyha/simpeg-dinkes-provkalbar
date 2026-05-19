<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPEG PETINGGI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #6aad1a, #3d690c);
            min-height: 100vh;
            font-family: 'Segoe UI';
        }

        .auth-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .left-side {
            background: #3d690c;
            color: white;
            padding: 50px;
        }

        .btn-leaf {
            background: #6aad1a;
            border: none;
            color: white;
            font-weight: bold;
        }

        .btn-leaf:hover {
            background: #3d690c;
        }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    @yield('content')
</div>

</body>
</html>