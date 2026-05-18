<!DOCTYPE html>
<html>
<head>
    <title>Rekapitulasi Pegawai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50">

<div class="p-8">

    <!-- HEADER -->
    <h1 class="text-3xl font-bold text-green-700 mb-8">
        Rekapitulasi Pegawai (Dinkes & UPT)
    </h1>

    <!-- GRID UNIT -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($data as $unit => $value)

        <div class="bg-white rounded-2xl shadow p-5">

            <!-- UNIT NAME -->
            <h2 class="text-xl font-bold text-green-700 mb-4">
                {{ $unit }}
            </h2>

            <!-- JABATAN -->
            <div class="mb-3">
                <h3 class="font-semibold text-gray-700">Jabatan</h3>
                @foreach($value['jabatan'] ?? [] as $nama => $jumlah)
                    <p class="text-sm">{{ $nama }} : {{ $jumlah }}</p>
                @endforeach
            </div>

            <!-- JENIS KELAMIN -->
            <div class="mb-3">
                <h3 class="font-semibold text-gray-700">Jenis Kelamin</h3>
                @foreach($value['gender'] ?? [] as $nama => $jumlah)
                    <p class="text-sm">{{ $nama }} : {{ $jumlah }}</p>
                @endforeach
            </div>

            <!-- PENDIDIKAN -->
            <div class="mb-3">
                <h3 class="font-semibold text-gray-700">Pendidikan</h3>
                @foreach($value['pendidikan'] ?? [] as $nama => $jumlah)
                    <p class="text-sm">{{ $nama }} : {{ $jumlah }}</p>
                @endforeach
            </div>

            <!-- STATUS PEGAWAI -->
            <div class="mb-3">
                <h3 class="font-semibold text-gray-700">Status Pegawai</h3>
                @foreach($value['status'] ?? [] as $nama => $jumlah)
                    <p class="text-sm">{{ $nama }} : {{ $jumlah }}</p>
                @endforeach
            </div>

            <!-- TOTAL (FIX ERROR ARRAY_SUM) -->
            <div class="border-t pt-3 mt-3 text-sm text-gray-600">

                <b>Total Pegawai:</b>
                {{
                    collect($value['jabatan'] ?? [])->sum()
                }}

            </div>

        </div>

        @endforeach

    </div>

    <!-- ========================= -->
    <!-- RINGKASAN TOTAL GLOBAL -->
    <!-- ========================= -->

    <div class="mt-10 bg-white p-6 rounded-2xl shadow">

        <h2 class="text-2xl font-bold text-green-700 mb-5">
            Ringkasan Keseluruhan
        </h2>

        @php
            $totalPNS = 0;
            $totalPPPK = 0;
            $totalL = 0;
            $totalP = 0;
        @endphp

        @foreach($data as $unit)
            @php
                $totalPNS += $unit['status']['PNS'] ?? 0;
                $totalPPPK += $unit['status']['PPPK'] ?? 0;
                $totalL += $unit['gender']['Laki-laki'] ?? 0;
                $totalP += $unit['gender']['Perempuan'] ?? 0;
            @endphp
        @endforeach

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div class="bg-green-100 p-4 rounded-xl">
                <div class="text-sm text-gray-600">Total PNS</div>
                <div class="text-xl font-bold">{{ $totalPNS }}</div>
            </div>

            <div class="bg-green-100 p-4 rounded-xl">
                <div class="text-sm text-gray-600">Total PPPK</div>
                <div class="text-xl font-bold">{{ $totalPPPK }}</div>
            </div>

            <div class="bg-green-100 p-4 rounded-xl">
                <div class="text-sm text-gray-600">Laki-laki</div>
                <div class="text-xl font-bold">{{ $totalL }}</div>
            </div>

            <div class="bg-green-100 p-4 rounded-xl">
                <div class="text-sm text-gray-600">Perempuan</div>
                <div class="text-xl font-bold">{{ $totalP }}</div>
            </div>

        </div>

    </div>

</div>

</body>
</html>