<!DOCTYPE html> 
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-REKAP PETINGGI</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Plus Jakarta Sans', sans-serif;
            background:#00A843;
            color:#1f2937;
        }

        /*
        ==========================================================
        SIDEBAR
        ==========================================================
        */

        .sidebar{
            width:250px;
            height:100vh;
            background:#ffffff;
            position:fixed;
            left:0;
            top:0;
            padding:20px 16px;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
            border-right:1px solid #d1d5db;
            z-index:100;
        }

        .sidebar-top{
            display:flex;
            flex-direction:column;
        }

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:30px;
        }

        .logo-icon{
            width:44px;
            height:44px;
            border-radius:14px;
            background:#00A843;
            color:white;
            display:flex;
            justify-content:center;
            align-items:center;
            font-weight:800;
            font-size:16px;
            box-shadow:0 4px 12px rgba(0,168,67,0.3);
        }

        .logo-text{
            font-size:24px;
            font-weight:800;
            color:#166534;
        }

        .menu-title{
            font-size:13px;
            color:#6b7280;
            margin-bottom:12px;
            font-weight:700;
            letter-spacing:1px;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .menu-item{
            padding:15px 16px;
            border-radius:16px;
            cursor:pointer;
            transition:0.3s;
            font-weight:700;
            color:#374151;
            background:#f9fafb;
            border:1px solid transparent;
        }

        .menu-item:hover{
            background:#dcfce7;
            border-color:#86efac;
            transform:translateX(5px);
            color:#166534;
        }

        .menu-item.active{
            background:#dcfce7;
            border-color:#22c55e;
            color:#166534;
            box-shadow:0 4px 10px rgba(34,197,94,0.15);
        }

        .sidebar-bottom{
            display:flex;
            flex-direction:column;
            gap:16px;
        }

        .profile-box{
            display:flex;
            align-items:center;
            gap:12px;
            padding:14px;
            background:#f3f4f6;
            border-radius:16px;
        }

        .profile-avatar{
            width:44px;
            height:44px;
            border-radius:50%;
            background:#00A843;
            color:white;
            display:flex;
            justify-content:center;
            align-items:center;
            font-weight:800;
            font-size:16px;
        }

        .logout-btn{
            background:#ef4444;
            color:white;
            border:none;
            padding:13px;
            border-radius:14px;
            cursor:pointer;
            font-weight:700;
            transition:0.3s;
            width:100%;
            font-family:'Plus Jakarta Sans', sans-serif;
        }

        .logout-btn:hover{
            background:#dc2626;
            transform:translateY(-2px);
        }

        /*
        ==========================================================
        MAIN
        ==========================================================
        */

        .main{
            margin-left:250px;
            min-height:100vh;
        }

        /*
        ==========================================================
        TOPBAR
        ==========================================================
        */

        .topbar{
            background:white;
            padding:20px 28px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            border-bottom:1px solid #e5e7eb;
            box-shadow:0 2px 8px rgba(0,0,0,0.03);
        }

        .topbar h2{
            color:#166534;
            font-size:28px;
            font-weight:800;
        }

        .topbar-right{
            display:flex;
            gap:12px;
            align-items:center;
        }

        .btn{
            border:none;
            padding:13px 18px;
            border-radius:14px;
            cursor:pointer;
            font-weight:700;
            transition:0.3s;
            font-family:'Plus Jakarta Sans', sans-serif;
        }

        .btn:hover{
            transform:translateY(-2px);
        }

        .btn-green{
            background:#00A843;
            color:white;
            box-shadow:0 4px 12px rgba(0,168,67,0.25);
        }

        .btn-green:hover{
            background:#008d38;
        }

        .btn-white{
            background:white;
            color:#166534;
            border:1px solid #d1d5db;
        }

        .btn-white:hover{
            background:#f9fafb;
        }

        .btn-red{
            background:#ef4444;
            color:white;
        }

        .btn-red:hover{
            background:#dc2626;
        }

        /*
        ==========================================================
        DASHBOARD
        ==========================================================
        */

        .dashboard{
            padding:28px;
        }

        .welcome-box{
            background:white;
            border-radius:28px;
            padding:32px;
            margin-bottom:28px;
            box-shadow:0 8px 24px rgba(0,0,0,0.06);
            border-left:8px solid #00A843;
            position:relative;
            overflow:hidden;
        }

        .welcome-box::after{
            content:'';
            position:absolute;
            width:220px;
            height:220px;
            border-radius:50%;
            background:rgba(0,168,67,0.06);
            top:-80px;
            right:-80px;
        }

        .welcome-box h1{
            font-size:38px;
            color:#166534;
            margin-bottom:10px;
            font-weight:800;
            position:relative;
            z-index:2;
        }

        .welcome-box p{
            color:#6b7280;
            line-height:1.8;
            font-size:15px;
            position:relative;
            z-index:2;
        }

        /*
        ==========================================================
        MENU GRID
        ==========================================================
        */

        .menu-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            gap:22px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            border-radius:24px;
            padding:28px;
            box-shadow:0 6px 20px rgba(0,0,0,0.05);
            transition:0.3s;
            cursor:pointer;
            border:2px solid transparent;
            position:relative;
            overflow:hidden;
        }

        .card::before{
            content:'';
            position:absolute;
            width:140px;
            height:140px;
            border-radius:50%;
            background:rgba(0,168,67,0.05);
            top:-50px;
            right:-50px;
        }

        .card:hover{
            transform:translateY(-6px);
            border-color:#00A843;
            box-shadow:0 10px 24px rgba(0,0,0,0.08);
        }

        .card h3{
            font-size:22px;
            color:#166534;
            font-weight:800;
            position:relative;
            z-index:2;
        }

        /*
        ==========================================================
        CHART BOX
        ==========================================================
        */

        .chart-box{
            background:white;
            border-radius:28px;
            padding:30px;
            box-shadow:0 6px 20px rgba(0,0,0,0.05);
        }

        .chart-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:15px;
            margin-bottom:24px;
        }

        .chart-title{
            font-size:30px;
            font-weight:800;
            color:#166534;
        }

        .chart-subtitle{
            margin-top:8px;
            color:#6b7280;
            font-size:14px;
            line-height:1.7;
        }

        .filter-box{
            display:flex;
            align-items:center;
            gap:12px;
            background:#f9fafb;
            padding:12px 16px;
            border-radius:16px;
        }

        .filter-box select{
            padding:10px 14px;
            border-radius:12px;
            border:1px solid #d1d5db;
            outline:none;
            font-weight:700;
            font-family:'Plus Jakarta Sans', sans-serif;
            cursor:pointer;
        }

        .chart-container{
            height:420px;
        }

        /*
        ==========================================================
        MODAL
        ==========================================================
        */

        .overlay{
            display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.45);
            z-index:998;
            backdrop-filter:blur(3px);
        }

        .modal{
            display:none;
            position:fixed;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            width:950px;
            max-width:94%;
            max-height:92vh;
            overflow-y:auto;
            background:white;
            border-radius:28px;
            z-index:999;
            box-shadow:0 15px 40px rgba(0,0,0,0.25);
            animation:fadeIn 0.25s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translate(-50%,-46%);
            }
            to{
                opacity:1;
                transform:translate(-50%,-50%);
            }
        }

        .modal-header{
            background:linear-gradient(135deg,#00A843,#008d38);
            padding:28px;
            color:white;
            border-radius:28px 28px 0 0;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .modal-header h2{
            font-size:30px;
            font-weight:800;
            margin-bottom:6px;
        }

        .modal-header p{
            opacity:0.9;
        }

        .close-btn{
            width:46px;
            height:46px;
            border:none;
            border-radius:50%;
            background:white;
            color:#00A843;
            font-size:20px;
            font-weight:800;
            cursor:pointer;
            transition:0.3s;
        }

        .close-btn:hover{
            transform:rotate(90deg);
        }

        .modal-body{
            padding:28px;
            background:#f9fafb;
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .panduan-card{
            background:white;
            border-radius:22px;
            padding:24px;
            border-left:7px solid #00A843;
            box-shadow:0 4px 14px rgba(0,0,0,0.05);
            transition:0.3s;
        }

        .panduan-card:hover{
            transform:translateY(-3px);
        }

        .panduan-card h3{
            color:#166534;
            font-size:24px;
            margin-bottom:14px;
            font-weight:800;
        }

        .panduan-card p{
            color:#4b5563;
            line-height:1.9;
            font-size:14px;
        }

        .status-group{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
            margin-top:16px;
            margin-bottom:16px;
        }

        .status{
            padding:10px 18px;
            border-radius:999px;
            font-size:13px;
            font-weight:700;
        }

        .pending{
            background:#fef3c7;
            color:#b45309;
        }

        .approved{
            background:#dcfce7;
            color:#15803d;
        }

        .rejected{
            background:#fee2e2;
            color:#b91c1c;
        }

        /*
        ==========================================================
        PROFILE MODAL
        ==========================================================
        */

        .profile-content{
            padding:28px;
        }

        .profile-item{
            margin-bottom:20px;
        }

        .profile-item label{
            display:block;
            margin-bottom:8px;
            font-weight:700;
            color:#374151;
        }

        .profile-text{
            color:#4b5563;
            line-height:1.8;
            font-size:15px;
        }

        /*
        ==========================================================
        RESPONSIVE
        ==========================================================
        */

        @media(max-width:768px){
            .sidebar{
                width:100%;
                height:auto;
                position:relative;
                padding: 16px;
            }

            .main{
                margin-left:0;
            }

            .dashboard{
                padding:16px;
            }

            .menu-grid{
                grid-template-columns:1fr;
            }

            .chart-container{
                height:320px;
            }

            .topbar{
                flex-direction:column;
                align-items:flex-start;
                gap:14px;
            }

            .topbar h2{
                font-size:24px;
            }

            .welcome-box h1{
                font-size:30px;
            }

            .chart-title{
                font-size:24px;
            }
        }
    </style>
</head>

<body>

    <div id="overlay" class="overlay"></div>

    <div class="sidebar">
        <div class="sidebar-top">
            <div class="logo">
                <div class="logo-icon">DK</div>
                <div class="logo-text">SI-REKAP</div>
            </div>

            <div class="menu-title">MENU UTAMA</div>

            <div class="menu">
                <div class="menu-item active" onclick="location.href='{{ route('dashboard') }}'">
                    Dashboard
                </div>

                <div class="menu-item" onclick="location.href='{{ route('cuti.approval') }}'">
                    Persetujuan Cuti
                </div>

                <div class="menu-item" onclick="location.href='{{ route('cuti.rekap') }}'">
                    Rekapitulasi Cuti
                </div>

                <div class="menu-item" onclick="location.href='{{ route('dinasluar.kalender') }}'">
                    Kalender Dinas Luar
                </div>

                <div class="menu-item" onclick="location.href='{{ route('dinasluar.rekap') }}'">
                    Rekapitulasi Kalender Dinas Luar
                </div>
            </div>
        </div>

        <div class="sidebar-bottom">
            <div class="profile-box">
                <div class="profile-avatar">P</div>
                <div>
                    <b>Petinggi</b>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <h2>Dashboard SI-REKAP Petinggi</h2>
            <h3>Sistem Informasi Rekapitulasi dan Evaluasi Kepegawaian</h3>
            <div class="topbar-right">
                <button class="btn btn-green" onclick="openPanduan()">Panduan</button>
                <button class="btn btn-white" onclick="openProfile()">Profil</button>
            </div>
        </div>

        <div class="dashboard">
            <div class="welcome-box">
                <h1>Selamat Datang</h1>
                <p>Sistem Informasi Rekapitulasi dan Evaluasi Kepegawaian (SI-REKAP) untuk Petinggi.</p>
            </div>

            <div class="menu-grid">
                <div class="card" onclick="location.href='{{ route('cuti.approval') }}'">
                    <h3>Persetujuan Cuti</h3>
                </div>

                <div class="card" onclick="location.href='{{ route('cuti.rekap') }}'">
                    <h3>Rekapitulasi Cuti</h3>
                </div>

                <div class="card" onclick="location.href='{{ route('dinasluar.kalender') }}'">
                    <h3>Kalender Dinas Luar</h3>
                </div>

                <div class="card" onclick="location.href='{{ route('dinasluar.rekap') }}'">
                    <h3>Rekapitulasi Kalender Dinas Luar</h3>
                </div>
            </div>

            <div class="chart-box">
                <div class="chart-header">
                    <div>
                        <div class="chart-title" id="judulChart">
                            Statistik Pengajuan Cuti Tahun 2026
                        </div>
                        <div class="chart-subtitle">
                            Grafik pengajuan cuti pegawai berdasarkan tahun yang dipilih.
                        </div>
                    </div>

                    <div class="filter-box">
                        <b>Tahun</b>
                        <select id="tahunFilter">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026" selected>2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                        </select>
                    </div>
                </div>

                <div class="chart-container">
                    <canvas id="chartCuti"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div id="panduanModal" class="modal">
        <div class="modal-header">
            <div>
                <h2>Panduan Penggunaan</h2>
                <p>Sistem Informasi Kepegawaian Dinas Kesehatan</p>
            </div>
            <button class="close-btn" onclick="closePanduan()">✕</button>
        </div>

        <div class="modal-body">
            <div class="panduan-card">
                <h3>Dashboard Monitoring Kepegawaian</h3>
                <p>Dashboard Monitoring Kepegawaian digunakan sebagai pusat pemantauan seluruh aktivitas kepegawaian pada Sistem Informasi Kepegawaian Dinas Kesehatan. Melalui dashboard ini, petinggi dapat melihat statistik pengajuan cuti pegawai, aktivitas dinas luar, serta memantau data secara terintegrasi berdasarkan tahun yang dipilih secara interaktif.</p>
            </div>

            <div class="panduan-card">
                <h3>Persetujuan Cuti</h3>
                <p>Menu Persetujuan Cuti digunakan untuk melakukan pemeriksaan data pengajuan cuti pegawai secara terstruktur. Petinggi dapat melihat informasi pegawai, tanggal cuti, alasan pengajuan, dan status pengajuan sebelum memberikan keputusan.</p>
                <div class="status-group">
                    <div class="status pending">Pending</div>
                    <div class="status approved">Disetujui</div>
                    <div class="status rejected">Ditolak</div>
                </div>
            </div>

            <div class="panduan-card">
                <h3>Rekapitulasi Cuti</h3>
                <p>Menu Rekapitulasi Cuti digunakan untuk melihat seluruh riwayat pengajuan cuti pegawai berdasarkan periode tertentu.</p>
            </div>

            <div class="panduan-card">
                <h3>Kalender Dinas Luar</h3>
                <p>Kalender Dinas Luar digunakan untuk melihat jadwal kegiatan dinas luar seluruh pegawai berdasarkan tanggal kegiatan yang telah terdaftar di dalam sistem.</p>
            </div>

            <div class="panduan-card">
                <h3>Rekapitulasi Kalender Dinas Luar</h3>
                <p>Menu Rekapitulasi Kalender Dinas Luar digunakan untuk melihat data dan riwayat kegiatan dinas luar pegawai secara lengkap berdasarkan periode tertentu.</p>
            </div>

            <div class="panduan-card">
                <h3>Profil Pengguna</h3>
                <p>Menu Profil digunakan untuk melihat informasi akun pengguna seperti nama dan email yang terdaftar pada sistem.</p>
            </div>
        </div>
    </div>

    <div id="profileModal" class="modal" style="width:520px;">
        <div class="modal-header">
            <div>
                <h2>Profil Pengguna</h2>
            </div>
            <button class="close-btn" onclick="closeProfile()">✕</button>
        </div>

        <div class="profile-content">
            <div class="profile-item">
                <label>Nama</label>
                <div class="profile-text">{{ auth()->user()->name }}</div>
            </div>

            <div class="profile-item">
                <label>Email</label>
                <div class="profile-text">{{ auth()->user()->email }}</div>
            </div>

            <hr style="margin:24px 0; border:none; border-top:1px solid #e5e7eb;">

            <form method="POST" action="{{ route('hapus.akun') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-red" onclick="return confirm('Yakin ingin menghapus akun?')">
                    Hapus Akun
                </button>
            </form>
        </div>
    </div>

    <script>
        /* DATA TAHUNAN */
        const dataTahunan = {
            2024:[8,10,9,11,12,13,14,12,11,10,9,8],
            2025:[10,12,11,14,15,16,17,15,14,13,12,11],
            2026:[12,14,13,16,18,20,22,20,18,17,15,14],
            2027:[14,15,16,18,20,22,24,23,21,20,18,16],
            2028:[15,17,18,20,22,24,26,25,23,21,20,18],
            2029:[18,20,21,23,25,27,29,28,26,24,22,20]
        };

        /* CHART INITIALIZATION */
        const ctx = document.getElementById('chartCuti');
        let chart = new Chart(ctx, {
            type:'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label:'Jumlah Pengajuan',
                    data:dataTahunan[2026],
                    backgroundColor: [
                        '#007A2F', '#008533', '#009137', '#00A843',
                        '#14B84F', '#27C45A', '#39CF65', '#4BDA70',
                        '#5CE37A', '#6EEB84', '#82F191', '#95F59D'
                    ],
                    borderRadius:14,
                    borderSkipped:false,
                    barThickness:32
                }]
            },
            options: {
                responsive:true,
                maintainAspectRatio:false,
                animation: { duration:1200 },
                plugins: {
                    legend: { display:false },
                    tooltip: {
                        backgroundColor:'#166534',
                        titleColor:'#fff',
                        bodyColor:'#fff',
                        cornerRadius:14,
                        padding:14,
                        callbacks: {
                            label:function(context){
                                return ' Total Pengajuan : ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero:true,
                        ticks: { display:false },
                        border: { display:false },
                        grid: { color:'rgba(0,0,0,0.06)' }
                    },
                    x: { grid: { display:false } }
                }
            }
        });

        /* FILTER TAHUN */
        document.getElementById('tahunFilter').addEventListener('change', function(){
            const tahun = this.value;
            chart.data.datasets[0].data = dataTahunan[tahun];
            document.getElementById('judulChart').innerHTML = 'Statistik Pengajuan Cuti Tahun ' + tahun;
            chart.update();
        });

        /* OPEN / CLOSE PANDUAN */
        function openPanduan(){
            document.getElementById('overlay').style.display='block';
            document.getElementById('panduanModal').style.display='block';
            document.body.style.overflow='hidden';
        }
        function closePanduan(){
            document.getElementById('overlay').style.display='none';
            document.getElementById('panduanModal').style.display='none';
            document.body.style.overflow='auto';
        }

        /* OPEN / CLOSE PROFILE */
        function openProfile(){
            document.getElementById('overlay').style.display='block';
            document.getElementById('profileModal').style.display='block';
            document.body.style.overflow='hidden';
        }
        function closeProfile(){
            document.getElementById('overlay').style.display='none';
            document.getElementById('profileModal').style.display='none';
            document.body.style.overflow='auto';
        }
    </script>
</body>
</html>