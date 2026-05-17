<!DOCTYPE html>
<html>
<head>
<title>Kalender Dinas Luar</title>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>
body{
    font-family:Arial;
    background:#f4f7f1;
}

h2{
    color:#4f7f16;
}

#calendar{
    background:white;
    padding:20px;
    border-radius:15px;
}
</style>
</head>

<body>

<h2>Kalender Dinas Luar</h2>

<div id="calendar"></div>

<br>
<a href="{{ route('dashboard') }}" style="color:#4f7f16;">← Kembali</a>

<script>
document.addEventListener('DOMContentLoaded', function() {

    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

        events: [
            {
                title: 'Budi Santoso - Jakarta',
                start: '2026-05-10'
            },
            {
                title: 'Dewi Kurnia - Pontianak',
                start: '2026-05-15'
            }
        ]
    });

    calendar.render();
});
</script>

</body>
</html>