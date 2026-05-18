<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Super Admin Dinkes')
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <style>
        ::-webkit-scrollbar{ width:6px; }
        ::-webkit-scrollbar-thumb{
            background:#15803d;
            border-radius:10px;
        }
    </style>
</head>

<body class="bg-green-50">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-green-700 text-white fixed h-screen overflow-y-auto shadow-2xl">

        <div class="p-6 border-b border-green-600">
            <h1 class="text-3xl font-bold">SUPER ADMIN</h1>
            <p class="text-sm text-green-100 mt-2">Sistem Informasi Dinkes</p>
        </div>

        <div class="p-6">
            <ul class="space-y-2 text-[16px]">

                <li>
                    <a href="/dashboard"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('dashboard') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="/dinkes"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('dinkes*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Data Dinas Kesehatan
                    </a>
                </li>

                <li>
                    <a href="/upt"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('upt*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Data 4 UPT
                    </a>
                </li>

                <li>
                    <a href="/kalender"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('kalender*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Kalender Dinas Luar
                    </a>
                </li>

                <li>
                    <a href="/users"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('users*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Manajemen User
                    </a>
                </li>

                <li>
                    <a href="/cuti"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('cuti*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Pengajuan Cuti
                    </a>
                </li>

                <li>
                    <a href="/rekapitulasi"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('rekap*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Rekapitulasi
                    </a>
                </li>

                <li>
                    <a href="/export"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('export*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Export Data
                    </a>
                </li>

    

                <li>
                    <a href="/profil"
                       class="block px-4 py-3 rounded-xl
                       {{ request()->is('profil*') ? 'bg-green-600 font-bold' : 'hover:bg-green-600' }}">
                        Profil
                    </a>
                </li>

                <li class="pt-5">
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="w-full bg-red-600 hover:bg-red-700 px-4 py-3 rounded-xl">
                            Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>

    </aside>

    <!-- CONTENT -->
    <div class="ml-72 w-full flex flex-col min-h-screen">

        <!-- NAVBAR -->
        <nav class="bg-white shadow-md px-8 py-5 flex justify-between items-center">

            <div>
                <h2 class="text-2xl font-bold text-green-700">
                    @yield('page-title', 'Dashboard Super Admin')
                </h2>

                <p class="text-sm text-gray-500">
                    Sistem Informasi Kepegawaian Dinkes
                </p>
            </div>

            <div class="flex items-center gap-4">

                <div class="text-right">

                    <!-- FIX: pakai session, bukan Auth -->
                    <p class="font-bold text-green-700">
                        {{ session('nama') }}
                    </p>

                    <p class="text-sm text-gray-500">
                        Super Admin
                    </p>

                </div>

                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                     class="w-12 h-12 rounded-full border-2 border-green-600">

            </div>

        </nav>

        <!-- MAIN -->
        <main class="p-8 flex-1">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-5">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

        <footer class="bg-white border-t px-8 py-4 text-sm text-gray-500">
            © {{ date('Y') }} Sistem Informasi Super Admin Dinkes
        </footer>

    </div>

</div>

</body>
</html>