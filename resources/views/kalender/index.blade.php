@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold text-green-700 mb-6">
    Kalender Dinas Luar
</h1>

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded-xl mb-5">
    {{ session('success') }}
</div>
@endif

{{-- ===================== --}}
{{-- FORM TAMBAH --}}
{{-- ===================== --}}
<div class="bg-white p-6 rounded-2xl shadow mb-6">

<form method="POST" action="/kalender/store" class="space-y-4">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <input type="text"
               name="nama_pegawai"
               placeholder="Nama Pegawai"
               class="border p-3 rounded-xl"
               required>

        <input type="date"
               name="tanggal"
               class="border p-3 rounded-xl"
               required>

        <input type="text"
               name="lokasi"
               placeholder="Lokasi"
               class="border p-3 rounded-xl"
               required>

        <input type="text"
               name="tag_user"
               placeholder="Tag User (optional)"
               class="border p-3 rounded-xl">

    </div>

    <textarea name="keterangan"
              class="border p-3 rounded-xl w-full h-24"
              placeholder="Keterangan"></textarea>

    <button class="bg-green-700 text-white px-6 py-3 rounded-xl">
        Simpan
    </button>
</form>

</div>

{{-- ===================== --}}
{{-- CALENDAR --}}
{{-- ===================== --}}
<div class="bg-white p-6 rounded-2xl shadow">

    <div id="calendar"></div>

</div>

{{-- ===================== --}}
{{-- FULLCALENDAR --}}
{{-- ===================== --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        height: 700,

        // 🔥 DATA DARI WEB.PHP
        events: @json($events),

        eventColor: '#16a34a',

        // =====================
        // CLICK EVENT (EDIT / DELETE)
        // =====================
        eventClick: function(info) {

            let action = confirm(
                "Nama: " + info.event.title + "\n" +
                "Klik OK untuk EDIT, Cancel untuk HAPUS"
            );

            if (action) {
                window.location.href = "/kalender/edit/" + info.event.id;
            } else {
                if (confirm("Yakin mau hapus data ini?")) {
                    fetch("/kalender/delete/" + info.event.id, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(res => res.json())
                    .then(() => location.reload());
                }
            }
        }

    });

    calendar.render();
});
</script>

@endsection