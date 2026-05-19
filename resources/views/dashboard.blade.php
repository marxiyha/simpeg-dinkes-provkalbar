<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>SIMPEG PETINGGI</title>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap"
      rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    margin:0;
    font-family:'Plus Jakarta Sans', sans-serif;
    background:#f4f7f1;
}

/*
|--------------------------------------------------------------------------
| TOPBAR
|--------------------------------------------------------------------------
*/

.topbar{
    background:linear-gradient(90deg,#35580d,#6ba51e);
    padding:18px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    color:white;
    flex-wrap:wrap;
    gap:15px;
}

.menu{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

/*
|--------------------------------------------------------------------------
| BUTTON
|--------------------------------------------------------------------------
*/

.btn{
    padding:10px 14px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover{
    opacity:0.9;
}

.btn-white{
    background:white;
    color:#4f7f16;
}

.btn-red{
    background:#b91c1c;
    color:white;
}

/*
|--------------------------------------------------------------------------
| CONTAINER
|--------------------------------------------------------------------------
*/

.container{
    padding:30px;
}

/*
|--------------------------------------------------------------------------
| MENU GRID
|--------------------------------------------------------------------------
*/

.menu-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:15px;
    margin-top:20px;
}

/*
|--------------------------------------------------------------------------
| CARD
|--------------------------------------------------------------------------
*/

.card{
    background:white;
    padding:20px;
    border-radius:15px;
    cursor:pointer;
    border:2px solid transparent;
    transition:0.3s;
    font-weight:600;
}

.card:hover{
    border-color:#6ba51e;
    transform:translateY(-3px);
}

/*
|--------------------------------------------------------------------------
| TABLE BOX
|--------------------------------------------------------------------------
*/

.table-box{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-top:20px;
}

/*
|--------------------------------------------------------------------------
| FILTER
|--------------------------------------------------------------------------
*/

.filter-area{
    margin-top:20px;
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
| PROFILE MODAL
|--------------------------------------------------------------------------
*/

.modal-profile{
    display:none;
    position:fixed;
    top:20%;
    left:50%;
    transform:translateX(-50%);
    background:white;
    padding:25px;
    border-radius:15px;
    width:350px;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);
    z-index:999;
}

.modal-profile input{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
}

/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media(max-width:768px){

    .container{
        padding:15px;
    }

    .topbar{
        flex-direction:column;
        align-items:flex-start;
    }

    .modal-profile{
        width:90%;
    }

}

</style>

</head>

<body>

<!-- TOPBAR -->
<div class="topbar">

    <div>

        <b>SIMPEG PETINGGI</b>

    </div>

    <div class="menu">

        <!-- PROFIL -->
        <button
            class="btn btn-white"
            onclick="document.getElementById('profile').style.display='block'"
        >
            Profil
        </button>

        <!-- LOGOUT -->
        <form method="POST"
              action="{{ route('logout') }}">

            @csrf

            <button class="btn btn-red">

                Logout

            </button>

        </form>

    </div>

</div>

<!-- CONTENT -->
<div class="container">

    <h3>
        Selamat datang,
        {{ auth()->user()->name }}
    </h3>

    <!-- MENU -->
    <div class="menu-grid">

        <div class="card"
             onclick="location.href='/cuti/approval'">

            Approval Cuti

        </div>

        <div class="card"
             onclick="location.href='/cuti/rekap'">

            Rekap Cuti

        </div>

        <div class="card"
             onclick="location.href='/dinasluar/kalender'">

            Kalender DL

        </div>

        <div class="card"
             onclick="location.href='/dinasluar/rekap'">

            Rekap DL

        </div>

    </div>

    <!-- FILTER -->
    <div class="filter-area">

        <!-- FILTER TAHUN 2026+ -->
        <select
            id="tahunFilter"
            class="filter-tahun"
        >

            @for($i = 2026; $i <= 2035; $i++)

                <option value="{{ $i }}">

                    {{ $i }}

                </option>

            @endfor

        </select>

    </div>

    <!-- CHART -->
    <div class="table-box">

        <canvas id="chart"></canvas>

    </div>

</div>

<!-- PROFILE MODAL -->
<div id="profile"
     class="modal-profile">

    <h3>Profil</h3>

    <br>

    <p>
        <b>Nama:</b>
        {{ auth()->user()->name }}
    </p>

    <br>

    <p>
        <b>Email:</b>
        {{ auth()->user()->email }}
    </p>

    <br>

    <hr>

    <br>

    <!-- UBAH PASSWORD -->
    <form method="POST"
          action="/profile/password">

        @csrf

        <input
            type="password"
            name="password"
            placeholder="Password Baru"
            required
        >

        <br><br>

        <input
            type="password"
            name="password_confirmation"
            placeholder="Konfirmasi Password"
            required
        >

        <br><br>

        <button
            class="btn btn-white"
            type="submit"
        >

            Ubah Password

        </button>

    </form>

    <br>

    <!-- HAPUS AKUN -->
    <form method="POST"
          action="/profile/delete">

        @csrf

        @method('DELETE')

        <button
            class="btn btn-red"
            onclick="return confirm('Yakin hapus akun?')"
        >

            Hapus Akun

        </button>

    </form>

    <br>

    <!-- CLOSE -->
    <button
        class="btn btn-white"
        onclick="document.getElementById('profile').style.display='none'"
    >

        Tutup

    </button>

</div>

<!-- CHART -->
<script>

const ctx =
    document.getElementById('chart');

new Chart(ctx,
{
    type:'bar',

    data:
    {
        labels:
        [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun'
        ],

        datasets:
        [
            {
                label:'Cuti',

                data:
                [
                    5,
                    10,
                    7,
                    12,
                    8,
                    15
                ],

                backgroundColor:'#4f7f16'
            }
        ]
    },

    options:
    {
        responsive:true,

        plugins:
        {
            legend:
            {
                display:true
            }
        }
    }
});

</script>

</body>
</html>