<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Kalender Dinas Luar</title>

<!-- FULLCALENDAR -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

/* BODY */
body{
    font-family:'Plus Jakarta Sans', sans-serif;
    background: linear-gradient(135deg,#00A843,#0ea5e9);
    padding:30px;
    color:#1f2937;
}

/* ANIMATION */
@keyframes fadeIn{
    from{opacity:0; transform:translateY(10px);}
    to{opacity:1; transform:translateY(0);}
}

/* CONTAINER */
.container{
    background:white;
    border-radius:24px;
    padding:28px;
    box-shadow:0 8px 30px rgba(0,0,0,0.08);
    animation:fadeIn 0.5s ease;
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:16px;
    margin-bottom:24px;
}

.header-left h2{
    color:#166534;
    font-size:34px;
    font-weight:800;
}

.header-left p{
    color:#6b7280;
    font-size:14px;
    line-height:1.6;
    margin-top:6px;
}

/* FILTER */
.filter-area{
    display:flex;
    align-items:center;
    gap:10px;
}

.filter-area label{
    font-weight:700;
    color:#166534;
}

.filter-tahun{
    padding:10px 14px;
    border-radius:12px;
    border:1px solid #d1d5db;
    font-weight:700;
    outline:none;
}

/* CALENDAR WRAPPER */
.calendar-wrapper{
    background:white;
    border-radius:24px;
    padding:20px;
    border:1px solid #e5e7eb;
    transition:0.3s;
}

.calendar-wrapper:hover{
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

/* FULLCALENDAR */
.fc .fc-toolbar-title{
    font-size:26px;
    font-weight:800;
    color:#111827;
}

.fc .fc-button{
    background:#00A843 !important;
    border:none !important;
    border-radius:10px !important;
    transition:0.2s;
}

.fc .fc-button:hover{
    transform:translateY(-2px);
    box-shadow:0 6px 18px rgba(0,168,67,0.25);
}

.fc-daygrid-day:hover{
    background:#f0fdf4;
}

/* TODAY */
.fc-day-today{
    background:#dcfce7 !important;
}

/* HARI MINGGU */
.hari-libur{
    background:#fff1f2 !important;
}

/* EVENT DINAS */
.event-dinas{
    background:linear-gradient(135deg,#00A843,#16a34a) !important;
    color:white !important;
    border-radius:8px !important;
    box-shadow:0 4px 10px rgba(0,168,67,0.25);
    cursor:pointer;
}

/* EVENT LIBUR */
.event-libur{
    background:linear-gradient(135deg,#ef4444,#dc2626) !important;
    color:white !important;
}

/* MODAL */
.overlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.4);
    backdrop-filter: blur(6px);
    z-index:999;
}

.modal{
    display:none;
    position:fixed;
    top:50%;
    left:50%;
    transform:translate(-50%,-45%) scale(0.95);
    width:520px;
    max-width:92%;
    background:white;
    border-radius:20px;
    overflow:hidden;
    z-index:1000;
    opacity:0;
    transition:0.25s ease;
    box-shadow:0 15px 40px rgba(0,0,0,0.2);
}

.modal.show{
    opacity:1;
    transform:translate(-50%,-50%) scale(1);
}

/* MODAL HEADER */
.modal-header{
    background:#00A843;
    color:white;
    padding:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.modal-header h3{
    font-size:20px;
    font-weight:800;
}

.close-btn{
    width:38px;
    height:38px;
    border:none;
    border-radius:50%;
    background:white;
    color:#00A843;
    font-weight:900;
    cursor:pointer;
}

/* MODAL BODY */
.modal-body{
    padding:20px;
}

.detail-box{
    background:#f9fafb;
    border-radius:16px;
    padding:16px;
    border-left:5px solid #00A843;
}

.detail-label{
    font-size:12px;
    color:#6b7280;
    font-weight:700;
}

.detail-value{
    margin-bottom:12px;
    font-weight:600;
}

/* BUTTON */
.btn-back{
    display:inline-block;
    margin-top:20px;
    padding:12px 16px;
    background:#00A843;
    color:white;
    text-decoration:none;
    border-radius:12px;
    font-weight:700;
}

/* RESPONSIVE */
@media(max-width:768px){
    body{padding:14px;}
    .header{flex-direction:column; align-items:flex-start;}
}

</style>

</head>

<body>

<!-- OVERLAY -->
<div class="overlay" id="overlay"></div>

<!-- MODAL -->
<div class="modal" id="detailModal">

    <div class="modal-header">
        <h3>Detail Dinas Luar</h3>
        <button class="close-btn" onclick="closeModal()">✕</button>
    </div>

    <div class="modal-body">

        <div class="detail-box">

            <div class="detail-label">Nama</div>
            <div class="detail-value" id="modalNama">-</div>

            <div class="detail-label">Tanggal</div>
            <div class="detail-value" id="modalTanggal">-</div>

            <div class="detail-label">Lokasi</div>
            <div class="detail-value" id="modalLokasi">-</div>

            <div class="detail-label">Keterangan</div>
            <div class="detail-value" id="modalKeterangan">-</div>

        </div>

    </div>

</div>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <div class="header-left">
            <h2>Kalender Dinas Luar</h2>
        </div>

        <div class="filter-area">
            <label>Tahun</label>
            <select id="tahunFilter" class="filter-tahun">
                @for($i=2026;$i<=2035;$i++)
                    <option value="{{ $i }}" {{ $i==2026?'selected':'' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

    </div>

    <!-- CALENDAR -->
    <div class="calendar-wrapper">
        <div id="calendar"></div>
    </div>

    <a href="{{ route('dashboard') }}" class="btn-back">← Kembali ke Dashboard</a>

</div>

<script>

document.addEventListener('DOMContentLoaded', function(){

let semuaEvent = [

    {
        title:'Budi Santoso - Jakarta',
        start:'2026-05-10',
        className:'event-dinas',
        extendedProps:{
            nama:'Budi Santoso',
            tanggal:'10 Mei 2026',
            lokasi:'Jakarta',
            keterangan:'Monitoring kegiatan.'
        }
    },

    {
        title:'Dewi Kurnia - Pontianak',
        start:'2026-05-15',
        className:'event-dinas',
        extendedProps:{
            nama:'Dewi Kurnia',
            tanggal:'15 Mei 2026',
            lokasi:'Pontianak',
            keterangan:'Survey lapangan.'
        }
    },

    {
        title:'Hari Buruh',
        start:'2026-05-01',
        className:'event-libur'
    }

];

function filterEventsByYear(tahun){
    return semuaEvent.filter(e => e.start.includes(tahun));
}

let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {

    initialView:'dayGridMonth',
    locale:'id',
    height:'auto',
    initialDate: document.getElementById('tahunFilter').value + '-05-01',

    headerToolbar:{
        left:'prev,next today',
        center:'title',
        right:'dayGridMonth,timeGridWeek'
    },

    events: filterEventsByYear(document.getElementById('tahunFilter').value),

    eventClick:function(info){

        if(info.event.classNames.includes('event-dinas')){

            document.getElementById('modalNama').innerText = info.event.extendedProps.nama;
            document.getElementById('modalTanggal').innerText = info.event.extendedProps.tanggal;
            document.getElementById('modalLokasi').innerText = info.event.extendedProps.lokasi;
            document.getElementById('modalKeterangan').innerText = info.event.extendedProps.keterangan;

            document.getElementById('overlay').style.display='block';

            let modal=document.getElementById('detailModal');
            modal.style.display='block';

            setTimeout(()=>modal.classList.add('show'),10);

            document.body.style.overflow='hidden';
        }

    },

    dayCellDidMount:function(info){
        if(info.date.getDay()===0){
            info.el.classList.add('hari-libur');
        }
    }

});

calendar.render();

document.getElementById('tahunFilter').addEventListener('change',function(){
    calendar.removeAllEvents();
    filterEventsByYear(this.value).forEach(e=>calendar.addEvent(e));
    calendar.gotoDate(this.value+'-05-01');
});

});

function closeModal(){

let modal=document.getElementById('detailModal');
modal.classList.remove('show');

setTimeout(()=>{
    document.getElementById('overlay').style.display='none';
    modal.style.display='none';
},200);

document.body.style.overflow='auto';

}

document.addEventListener('keydown',function(e){
    if(e.key==='Escape') closeModal();
});

</script>

</body>
</html>