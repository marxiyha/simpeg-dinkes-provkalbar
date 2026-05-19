<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Kalender Dinas Luar</title>

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css"
      rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>

body{
    font-family:Arial, sans-serif;
    background:#f4f7f1;
    margin:0;
    padding:30px;
}

/*
|--------------------------------------------------------------------------
| CONTAINER
|--------------------------------------------------------------------------
*/

.container{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

/*
|--------------------------------------------------------------------------
| TITLE
|--------------------------------------------------------------------------
*/

h2{
    color:#4f7f16;
    margin-bottom:20px;
}

/*
|--------------------------------------------------------------------------
| FILTER AREA
|--------------------------------------------------------------------------
*/

.filter-area{
    margin-bottom:20px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.filter-tahun{
    padding:10px;
    border-radius:8px;
    border:1px solid #ccc;
    outline:none;
    min-width:180px;
}

/*
|--------------------------------------------------------------------------
| CALENDAR
|--------------------------------------------------------------------------
*/

#calendar{
    background:white;
    padding:20px;
    border-radius:15px;
}

/*
|--------------------------------------------------------------------------
| BACK BUTTON
|--------------------------------------------------------------------------
*/

.btn-back{
    display:inline-block;
    margin-top:20px;
    color:#4f7f16;
    text-decoration:none;
    font-weight:bold;
}

.btn-back:hover{
    text-decoration:underline;
}

/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media(max-width:768px){

    body{
        padding:15px;
    }

    .filter-area{
        flex-direction:column;
    }

    .filter-tahun{
        width:100%;
    }

}

</style>

</head>

<body>

<div class="container">

    <h2>Kalender Dinas Luar</h2>

    <!-- FILTER -->
    <div class="filter-area">

        <!-- FILTER TAHUN 2026+ -->
        <select
            id="tahunFilter"
            class="filter-tahun"
        >

            @for($i = 2026; $i <= 2035; $i++)

                <option value="{{ $i }}"
                    {{ $i == 2026 ? 'selected' : '' }}
                >

                    {{ $i }}

                </option>

            @endfor

        </select>

    </div>

    <!-- CALENDAR -->
    <div id="calendar"></div>

    <!-- BACK -->
    <a href="{{ route('dashboard') }}"
       class="btn-back">

        ← Kembali

    </a>

</div>

<script>

document.addEventListener('DOMContentLoaded',
function()
{

    let calendarEl =
        document.getElementById(
            'calendar'
        );

    let tahunFilter =
        document.getElementById(
            'tahunFilter'
        );

    /*
    |--------------------------------------------------------------------------
    | DATA EVENT
    |--------------------------------------------------------------------------
    */

    let semuaEvent =
    [
        {
            title:
                'Budi Santoso - Jakarta',

            start:
                '2026-05-10'
        },

        {
            title:
                'Dewi Kurnia - Pontianak',

            start:
                '2026-05-15'
        },

        {
            title:
                'Andi Saputra - Bandung',

            start:
                '2027-03-12'
        },

        {
            title:
                'Maria Grace - Surabaya',

            start:
                '2028-08-20'
        }
    ];

    /*
    |--------------------------------------------------------------------------
    | FILTER EVENT BERDASARKAN TAHUN
    |--------------------------------------------------------------------------
    */

    function filterEventsByYear(tahun)
    {
        return semuaEvent.filter(event =>
        {
            return event.start.includes(tahun);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FULLCALENDAR
    |--------------------------------------------------------------------------
    */

    let calendar =
        new FullCalendar.Calendar(
            calendarEl,
        {

            initialView:
                'dayGridMonth',

            initialDate:
                tahunFilter.value + '-01-01',

            events:
                filterEventsByYear(
                    tahunFilter.value
                )

        });

    calendar.render();

    /*
    |--------------------------------------------------------------------------
    | GANTI TAHUN
    |--------------------------------------------------------------------------
    */

    tahunFilter.addEventListener(
        'change',
        function()
    {

        let tahun =
            this.value;

        /*
        |--------------------------------------------------------------------------
        | PINDAH KE TAHUN YANG DIPILIH
        |--------------------------------------------------------------------------
        */

        calendar.gotoDate(
            tahun + '-01-01'
        );

        /*
        |--------------------------------------------------------------------------
        | HAPUS EVENT LAMA
        |--------------------------------------------------------------------------
        */

        calendar.removeAllEvents();

        /*
        |--------------------------------------------------------------------------
        | TAMBAH EVENT BARU
        |--------------------------------------------------------------------------
        */

        filterEventsByYear(tahun)
        .forEach(event =>
        {
            calendar.addEvent(event);
        });

    });

});

</script>

</body>
</html>