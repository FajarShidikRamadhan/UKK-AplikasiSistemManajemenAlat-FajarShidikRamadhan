<?php
include '../koneksi.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Alat</title>
    <!-- <link rel="stylesheet" href="styleDash.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="header">
        <h3>Selamat Datang, Admin <?= $_SESSION['username']; ?>! 👋</h3>
    </div>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="index.php?page=dashboard_admin">📊 Dashboard</a>
        <a href="index.php?page=alat_masuk">📥 Alat Masuk</a>
        <a href="index.php?page=data_user">👥 Kelola User</a>
        <a href="index.php?page=kategori">📁 Kelola Kategori</a>
        <a href="index.php?page=data_alat">🛠️ Kelola Alat</a>
        <a href="index.php?page=peminjaman">📤 Peminjaman</a>
        <a href="index.php?page=pengembalian">🔙 Pengembalian</a>
        <a href="index.php?page=log_aktifitas">📝 Log Aktifitas</a>
        <a href="../logout.php" class="logout-btn" onclick="return confirm('Yakin ingin keluar?');">🚪 Log Out</a>
    </div>


    <div class="content-body">
        <?php
        // Memanggil file dari folder 'halaman' sesuai menu yang di klik
        $file = "halaman/" . $page . ".php";
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<h3>Halaman tidak ditemukan!</h3>";
        }
        ?>
    </div>
    </div>

</body>

</html>