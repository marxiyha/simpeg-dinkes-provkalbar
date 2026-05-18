@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold text-green-700 mb-8">
Export Data Sistem
</h1>

<p class="text-gray-600 mb-8">
Pilih data yang ingin diexport ke Excel atau PDF.
Semua file akan otomatis terunduh.
</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

<!-- ========================= -->
<!-- PEGAWAI -->
<!-- ========================= -->
<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-2xl font-bold text-green-700 mb-4">
Export Data Pegawai
</h2>

<p class="text-gray-600 mb-6">
Data Dinas Kesehatan dan seluruh UPT.
</p>

<div class="flex gap-4">

<a href="/export/pegawai/excel"
   class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl shadow">
   Export Excel
</a>

<a href="/export/pegawai/pdf"
   class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow">
   Export PDF
</a>

</div>

</div>

<!-- ========================= -->
<!-- CUTI -->
<!-- ========================= -->
<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-2xl font-bold text-green-700 mb-4">
Export Pengajuan Cuti
</h2>

<p class="text-gray-600 mb-6">
Semua data pengajuan cuti pegawai.
</p>

<div class="flex gap-4">

<a href="/export/cuti/excel"
   class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl shadow">
   Export Excel
</a>

<a href="/export/cuti/pdf"
   class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow">
   Export PDF
</a>

</div>

</div>

<!-- ========================= -->
<!-- KALENDER DINAS LUAR -->
<!-- ========================= -->
<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-2xl font-bold text-green-700 mb-4">
Export Kalender Dinas Luar
</h2>

<p class="text-gray-600 mb-6">
Jadwal kegiatan dinas luar pegawai.
</p>

<div class="flex gap-4">

<a href="/export/kalender/excel"
   class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl shadow">
   Export Excel
</a>

<a href="/export/kalender/pdf"
   class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow">
   Export PDF
</a>

</div>

</div>

<!-- ========================= -->
<!-- REKAPITULASI -->
<!-- ========================= -->
<div class="bg-white p-8 rounded-3xl shadow-lg">

<h2 class="text-2xl font-bold text-green-700 mb-4">
Export Rekapitulasi
</h2>

<p class="text-gray-600 mb-6">
Statistik total pegawai, UPT, dan cuti.
</p>

<div class="flex gap-4">

<a href="/export/rekap/excel"
   class="bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-xl shadow">
   Export Excel
</a>

<a href="/export/rekap/pdf"
   class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow">
   Export PDF
</a>

</div>

</div>

</div>

<!-- INFO BOTTOM -->
<div class="mt-10 bg-green-50 p-6 rounded-xl text-sm text-gray-700">

✔ Excel = download file .xlsx langsung  
✔ PDF = versi preview (siap upgrade dompdf kalau mau)  
✔ Data otomatis dari database  
✔ Tidak perlu input manual  

</div>

@endsection