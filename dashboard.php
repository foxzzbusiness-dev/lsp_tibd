<?php
session_start();

// Logout: hapus session lalu kembali ke login
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Penjaga: kalau belum login, kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LSP TIBD</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background: #f0f2f5;
        }

        /* ===== AREA MENU ===== */
        #menu-area {
            display: none; /* awalnya disembunyikan */
        }
        header {
            background: #1f3a4a;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header small {
            font-size: 12px;
            color: #cfd8dc;
        }
        .kanan {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
        }
        .logout {
            background: #e74c3c;
            color: #fff;
            text-decoration: none;
            padding: 7px 16px;
            border-radius: 6px;
            font-size: 13px;
        }
        .logout:hover {
            background: #c0392b;
        }
        nav {
            background: #fff;
            padding: 14px;
            display: flex;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        nav button {
            background: #1f3a4a;
            color: #fff;
            border: none;
            padding: 8px 22px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
        }
        nav button:hover {
            background: #2d5368;
        }
        nav button.aktif {
            background: #1f4287;
        }
        main {
            max-width: 1000px;
            margin: 25px auto;
            padding: 0 20px;
        }
        .halaman {
            display: none;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .halaman.tampil {
            display: block;
        }
        .halaman h2 {
            color: #1f3a4a;
            margin-bottom: 12px;
        }
        .halaman p {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .kartu-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        .kartu {
            flex: 1 1 250px;
            background: #f7f9fb;
            border: 1px solid #e0e6ea;
            border-radius: 10px;
            padding: 15px;
        }
        .kartu h3 {
            font-size: 15px;
            margin-bottom: 6px;
            color: #1f3a4a;
        }
        .kartu p {
            font-size: 13px;
            margin: 0;
        }
        .judul-tabel {
            margin: 10px 0;
            font-size: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th {
            background: #1f3a4a;
            color: #fff;
            text-align: left;
            padding: 10px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #e0e6ea;
        }

        /* ===== DASHBOARD UTAMA ===== */
        .bar-utama {
            background: #1b3a7a;
            color: #fff;
            padding: 14px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .bar-utama h1 {
            font-size: 18px;
        }
        .link-utama {
            background: #fff;
            padding: 10px;
            display: flex;
            justify-content: center;
            gap: 25px;
        }
        .link-utama a {
            font-size: 13px;
            font-weight: bold;
            color: #1b3a7a;
            cursor: pointer;
        }
        .link-utama a:hover {
            text-decoration: underline;
        }
        .banner {
            background: #244782;
            color: #fff;
            text-align: center;
            padding: 45px 20px;
        }
        .banner h2 {
            margin-bottom: 8px;
        }
        .banner p {
            font-size: 13px;
        }
        .kartu-utama-wrap {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            padding: 25px;
        }
        .kartu-utama {
            width: 220px;
            background: #fff;
            border-radius: 10px;
            padding: 18px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
            cursor: pointer;
        }
        .kartu-utama:hover {
            transform: translateY(-3px);
        }
        .kartu-utama h3 {
            font-size: 15px;
            margin-bottom: 6px;
            color: #1b3a7a;
        }
        .kartu-utama p {
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>

    <!-- ===== DASHBOARD UTAMA ===== -->
    <div id="utama">
        <div class="bar-utama">
            <h1>Dashboard Utama</h1>
            <a href="dashboard.php?logout=1" class="logout">Logout</a>
        </div>

        <div class="link-utama">
            <a onclick="bukaMenu('home')">Home</a>
            <a onclick="bukaMenu('profil')">Profil</a>
            <a onclick="bukaMenu('layanan')">Layanan</a>
            <a onclick="bukaMenu('kontak')">Kontak</a>
        </div>

        <div class="banner">
            <h2>Selamat Datang di Website Kami</h2>
            <p>Ini adalah tampilan homepage setelah pengguna berhasil login.</p>
        </div>

        <div class="kartu-utama-wrap">
            <div class="kartu-utama" onclick="bukaMenu('home')">
                <h3>Home</h3>
                <p>Halaman utama berisi informasi singkat website.</p>
            </div>
            <div class="kartu-utama" onclick="bukaMenu('profil')">
                <h3>Profil</h3>
                <p>Informasi tentang perusahaan, lembaga, atau organisasi.</p>
            </div>
            <div class="kartu-utama" onclick="bukaMenu('layanan')">
                <h3>Layanan</h3>
                <p>Daftar layanan atau program yang tersedia.</p>
            </div>
            <div class="kartu-utama" onclick="bukaMenu('kontak')">
                <h3>Kontak</h3>
                <p>Informasi kontak, alamat, dan media sosial.</p>
            </div>
        </div>
    </div>

    <!-- ===== AREA MENU ===== -->
    <div id="menu-area">

        <header>
            <div onclick="keUtama()" style="cursor:pointer">
                <h1>LSP TIBD</h1>
                <small>Skema Sertifikasi Junior Web Developer</small>
            </div>
            <div class="kanan">
                <span>Halo, <?php echo htmlspecialchars($username); ?></span>
                <a href="dashboard.php?logout=1" class="logout">Logout</a>
            </div>
        </header>

        <nav>
            <button id="btn-home" onclick="tampilMenu('home')">Home</button>
            <button id="btn-profil" onclick="tampilMenu('profil')">Profil</button>
            <button id="btn-layanan" onclick="tampilMenu('layanan')">Layanan</button>
            <button id="btn-kontak" onclick="tampilMenu('kontak')">Kontak</button>
        </nav>

        <main>

            <!-- HOME -->
            <section id="home" class="halaman">
                <h2>Selamat Datang</h2>
                <p>Selamat datang di sistem informasi LSP Teknologi Informatika Bisnis Digital (LSP TIBD). Kami menyelenggarakan pelatihan dan sertifikasi profesi berbasis SKKNI, salah satunya adalah skema Junior Web Developer.</p>
                <div class="kartu-wrap">
                    <div class="kartu">
                        <h3>Junior Web Developer</h3>
                        <p>Skema sertifikasi untuk pengembang web pemula berbasis standar nasional.</p>
                    </div>
                    <div class="kartu">
                        <h3>Berbasis SKKNI</h3>
                        <p>Mengacu pada Standar Kompetensi Kerja Nasional Indonesia.</p>
                    </div>
                    <div class="kartu">
                        <h3>Sertifikasi Resmi</h3>
                        <p>Sertifikat diakui oleh BNSP dan industri.</p>
                    </div>
                </div>
            </section>

            <!-- PROFIL -->
            <section id="profil" class="halaman">
                <h2>Profil LSP TIBD</h2>
                <p>LSP Teknologi Informatika Bisnis Digital (LSP TIBD) adalah lembaga sertifikasi profesi yang berlisensi resmi dari BNSP untuk menyelenggarakan uji kompetensi di bidang teknologi informasi dan bisnis digital.</p>
                <table>
                    <tr><th>Bagian</th><th>Keterangan</th></tr>
                    <tr><td>Nama Lembaga</td><td>LSP Teknologi Informatika Bisnis Digital</td></tr>
                    <tr><td>Fokus</td><td>Sertifikasi profesi bidang IT dan Digital</td></tr>
                    <tr><td>Visi</td><td>Menjadi LSP unggulan di bidang teknologi digital</td></tr>
                    <tr><td>Misi</td><td>Menyediakan sertifikasi kompetensi berkualitas dan profesional</td></tr>
                </table>
            </section>

            <!-- LAYANAN -->
            <section id="layanan" class="halaman">
                <h2>Layanan Sertifikasi</h2>
                <div class="kartu-wrap">
                    <div class="kartu">
                        <h3>Pelatihan Junior Web Developer</h3>
                        <p>Pelatihan dasar HTML, CSS, JavaScript hingga pembuatan website sederhana.</p>
                    </div>
                    <div class="kartu">
                        <h3>Uji Kompetensi</h3>
                        <p>Proses asesmen berbasis praktik sesuai unit kompetensi SKKNI.</p>
                    </div>
                    <div class="kartu">
                        <h3>Pendampingan Sertifikasi</h3>
                        <p>Bimbingan persiapan uji kompetensi hingga dinyatakan kompeten.</p>
                    </div>
                    <div class="kartu">
                        <h3>Sertifikat BNSP</h3>
                        <p>Sertifikat resmi yang diakui secara nasional dan industri.</p>
                    </div>
                </div>

                <h3 class="judul-tabel">Unit Kompetensi Junior Web Developer</h3>
                <table>
                    <tr><th>No</th><th>Kode Unit</th><th>Judul Unit</th></tr>
                    <tr><td>1</td><td>J.620100.005.02</td><td>Mengimplementasikan User Interface</td></tr>
                    <tr><td>2</td><td>J.620100.010.01</td><td>Menerapkan Perintah Eksekusi Bahasa Pemrograman</td></tr>
                    <tr><td>3</td><td>J.620100.015.01</td><td>Menyusun Fungsi atau Sumber Daya Program</td></tr>
                    <tr><td>4</td><td>J.620100.016.01</td><td>Menulis Kode Sesuai Guidelines</td></tr>
                    <tr><td>5</td><td>J.620100.017.02</td><td>Mengimplementasikan Pemrograman Terstruktur</td></tr>
                    <tr><td>6</td><td>J.620100.019.02</td><td>Menggunakan Library / Komponen</td></tr>
                </table>
            </section>

            <!-- KONTAK -->
            <section id="kontak" class="halaman">
                <h2>Kontak LSP TIBD</h2>
                <table>
                    <tr><th>Informasi</th><th>Detail</th></tr>
                    <tr><td>Nama</td><td>LSP Teknologi Informatika Bisnis Digital</td></tr>
                    <tr><td>Alamat</td><td>Banjarmasin, Kalimantan Selatan</td></tr>
                    <tr><td>Email</td><td>info@lsptibd.com</td></tr>
                    <tr><td>WhatsApp</td><td>0812-3456-7890</td></tr>
                    <tr><td>Website</td><td>www.lsptibd.com</td></tr>
                </table>
            </section>

        </main>

    </div>

    <script>
        function tampilMenu(id) {
            // Sembunyikan semua section, tampilkan yang dipilih
            var halaman = document.querySelectorAll('.halaman');
            for (var i = 0; i < halaman.length; i++) {
                halaman[i].classList.remove('tampil');
            }
            document.getElementById(id).classList.add('tampil');

            // Atur tombol yang aktif
            var semuaTombol = document.querySelectorAll('nav button');
            for (var j = 0; j < semuaTombol.length; j++) {
                semuaTombol[j].classList.remove('aktif');
            }
            document.getElementById('btn-' + id).classList.add('aktif');
        }

        // Dari Dashboard Utama ke salah satu menu
        function bukaMenu(id) {
            document.getElementById('utama').style.display = 'none';
            document.getElementById('menu-area').style.display = 'block';
            tampilMenu(id);
        }

        // Kembali ke Dashboard Utama
        function keUtama() {
            document.getElementById('menu-area').style.display = 'none';
            document.getElementById('utama').style.display = 'block';
        }
    </script>
</body>
</html>