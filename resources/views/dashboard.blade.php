@extends('layouts.app')

@section('title', 'Dashboard Super Admin')

@section('content')

<style>
    :root { --primary: #059669; --bg: #f8fafc; --text: #1e293b; }
    .dashboard-container { padding: 32px; font-family: 'Inter', sans-serif; background-color: var(--bg); min-height: 100vh; }
    
    /* Header Panel */
    .header-panel { background: white; padding: 32px; border-radius: 24px; margin-bottom: 32px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .header-panel h1 { font-size: 28px; color: #064e3b; margin: 0; font-weight: 800; }
    
    /* Menu Grid */
    .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .menu-card { background: white; padding: 24px; border-radius: 20px; border: 1px solid #e2e8f0; transition: all 0.3s ease; text-decoration: none; color: var(--text); box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .menu-card:hover { transform: translateY(-8px); border-color: var(--primary); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
    .menu-card h3 { color: var(--primary); margin-top: 0; }
    
    /* Chart Box */
    .chart-box { background: white; padding: 32px; border-radius: 24px; border: 1px solid #e2e8f0; }
    .select-tahun { padding: 10px 20px; border-radius: 12px; border: 1px solid #cbd5e1; font-weight: 600; color: var(--primary); cursor: pointer; }
    
    /* Modal */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; }
    .modal-content { background: white; width: 90%; max-width: 700px; padding: 40px; border-radius: 24px; max-height: 80vh; overflow-y: auto; }
</style>

<div class="dashboard-container">
    <div class="header-panel">
        <div>
            <h1>Dashboard Super Admin</h1>
            <p style="color: #64748b; margin-top: 5px;">Sistem Pengawasan Kepegawaian Internal</p>
        </div>
        <button onclick="toggleModal(true)" style="background: var(--primary); color: white; padding: 12px 24px; border-radius: 12px; border: none; font-weight: 600; cursor: pointer;">📘 Panduan Sistem</button>
    </div>

    <div class="menu-grid">
        <a href="/dinkes" class="menu-card"><h3>🏥 Data Dinas Kesehatan</h3></a>
        <a href="/upt" class="menu-card"><h3>🏢 Data Unit Pelaksana Teknis</h3></a>
        <a href="/kalender" class="menu-card"><h3>📅 Kalender Kedinasan</h3></a>
        <a href="/users" class="menu-card"><h3>👥 Manajemen Pengguna</h3></a>
    </div>

    <div class="chart-box">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="margin: 0;">Statistik Pengajuan Cuti</h2>
            <select id="tahunFilter" class="select-tahun" onchange="updateChart()">
                @for($y = 2024; $y <= 2029; $y++) <option value="{{$y}}" {{$y==2026?'selected':''}}>{{$y}}</option> @endfor
            </select>
        </div>
        <div style="height: 300px;"><canvas id="cutiChart"></canvas></div>
    </div>
</div>

<div id="modalPanduan" class="modal-overlay">
    <div class="modal-content">
        <h2 style="color: var(--primary); margin-top: 0; border-bottom: 2px solid var(--primary); padding-bottom: 10px;">Panduan Operasional Super Admin</h2>
        
        <div style="line-height: 1.7; color: #334155; font-size: 14px; text-align: justify;">
            <p><strong>Selamat Datang, Super Admin.</strong> Anda memegang kendali penuh sebagai pengawas utama sistem. Berikut adalah deskripsi mendalam mengenai tanggung jawab dan alur kerja pada setiap modul:</p>
            
            <div class="guide-item">
                <h3 style="margin: 15px 0 5px 0; color: #064e3b;">🏥 Data Dinas Kesehatan</h3>
                <p>Modul ini berfungsi sebagai pusat monitoring data induk pegawai. Anda memiliki akses untuk memantau integritas data kepegawaian yang diinput oleh Operator. Pastikan data yang tersaji selalu akurat, mutakhir, dan sesuai dengan dokumen fisik yang ada.</p>
            </div>

            <div class="guide-item">
                <h3 style="margin: 15px 0 5px 0; color: #064e3b;">🏢 Data Unit Pelaksana Teknis (UPT)</h3>
                <p>Tanggung jawab pemantauan operasional mencakup empat UPT utama: UPT Sungai Bangkong, UPT Pratama, UPT Labkes, dan UPT Pelatihan. Anda bertindak sebagai supervisor untuk memastikan seluruh data inputan dari masing-masing UPT memenuhi standar administrasi yang ditetapkan instansi.</p>
            </div>

        

            <div class="guide-item">
                <h3 style="margin: 15px 0 5px 0; color: #064e3b;">📅 Kalender Kedinasan</h3>
                <p>Fitur ini memvisualisasikan seluruh agenda kedinasan dan perjalanan dinas pegawai. Super Admin bertugas memantau jadwal agar tidak terjadi tumpang tindih agenda (<em>scheduling conflict</em>) yang dapat mengganggu pelayanan publik instansi.</p>
            </div>

            <div class="guide-item">
                <h3 style="margin: 15px 0 5px 0; color: #064e3b;">👥 Manajemen Pengguna</h3>
                <p>Pusat kendali akun sistem. Anda memiliki otoritas penuh untuk:
                    <ul style="margin: 5px 0; padding-left: 20px;">
                        <li><strong>Registrasi:</strong> Membuat kredensial akun baru bagi staf yang baru bergabung.</li>
                        <li><strong>Penetapan Peran (Role):</strong> Mengatur hirarki akses pengguna antara Pegawai, Operator, Petinggi, dan Admin.</li>
                        <li><strong>Audit:</strong> Melakukan pembersihan akun untuk menjaga keamanan sistem dari akses pihak yang tidak berwenang.</li>
                    </ul>
                </p>
            </div>
        </div>

        <button onclick="toggleModal(false)" style="margin-top: 25px; width:100%; padding: 14px; background: var(--primary); color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer;">Tutup Panduan dan Lanjutkan</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataCuti = { 2024:[5,8,4,11,7,14,9,12,6,10,5,7], 2025:[9,11,7,13,10,16,12,14,9,11,8,10], 2026:[12,15,11,18,14,22,16,19,13,17,11,14], 2027:[14,16,13,19,16,24,18,21,15,18,12,15], 2028:[15,18,14,21,18,26,20,23,17,20,14,17], 2029:[18,20,16,24,20,28,22,25,19,22,16,20] };
    let chart = new Chart(document.getElementById('cutiChart'), {
        type: 'bar',
        data: { labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'], datasets: [{ data: dataCuti[2026], backgroundColor: '#059669', borderRadius: 8 }] },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { display: false }, x: { grid: { display: false } } } }
    });
    function updateChart() { chart.data.datasets[0].data = dataCuti[document.getElementById('tahunFilter').value]; chart.update(); }
    function toggleModal(show) { document.getElementById('modalPanduan').style.display = show ? 'flex' : 'none'; }
</script>

@endsection