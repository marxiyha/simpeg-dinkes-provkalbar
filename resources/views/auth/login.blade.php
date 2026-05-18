<!DOCTYPE html>
<html>
<head>

    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-green-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-14 rounded-[35px] shadow-2xl w-[620px]">

        <h1 class="text-6xl font-bold text-green-700 text-center mb-12">
            SUPER ADMIN LOGIN
        </h1>

        <!-- FORM LOGIN -->
        <form action="/login" method="POST">

            @csrf

            <!-- EMAIL -->
            <input
                type="email"
                name="email"
                placeholder="Masukkan Email"
                class="w-full p-6 mb-8 rounded-3xl bg-slate-200 text-3xl outline-none"
                required
            >

            <!-- PASSWORD -->
            <input
                type="password"
                name="password"
                placeholder="Masukkan Password"
                class="w-full p-6 mb-8 rounded-3xl bg-slate-200 text-3xl outline-none"
                required
            >

            <!-- BUTTON LOGIN -->
            <button
                type="submit"
                class="w-full bg-green-700 hover:bg-green-800 text-white text-3xl py-5 rounded-3xl"
            >
                Login
            </button>

        </form>

        <!-- MENU BAWAH -->
        <div class="flex justify-between mt-10 text-green-700 text-2xl">

            <a href="/register">
                Register
            </a>

            <a href="/forgot-password">
                Lupa Password
            </a>

        </div>

    </div>

</body>
</html>