<?php
session_start();
$page = $_GET['page'] ?? 'dashboard';

$alat = [
    ['id' => 1, 'name' => 'Palu', 'kondisi' => 'jelek'],
    ['id' => 2, 'name' => 'Gerindra', 'kondisi' => 'bagus'],
    ['id' => 3, 'name' => 'Gergaji', 'kondisi' => 'sangat bagus']
];

$user = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com']
];

$kategori = [
    ['id' => 1, 'name' => 'Hand Tools'],
    ['id' => 2, 'name' => 'Power Tools']
];

$alat_masuk = [
    ['id' => 1, 'alat' => 'Palu', 'date' => '2026-04-01'],
    ['id' => 2, 'alat' => 'Gerindra', 'date' => '2026-04-02']
];

$peminjaman = [
    ['id' => 1, 'alat' => 'Gergaji', 'user' => 'John Doe', 'date' => '2026-04-03'],
    ['id' => 2, 'alat' => 'Palu', 'user' => 'Jane Smith', 'date' => '2026-04-04']
];

$pengembalian = [
    ['id' => 1, 'alat' => 'Gergaji', 'user' => 'John Doe', 'date' => '2026-04-05']
];

$log_aktifitas = [
    ['id' => 1, 'activity' => 'User John Doe logged in', 'date' => '2026-04-06'],
    ['id' => 2, 'activity' => 'User Jane Smith borrowed Palu', 'date' => '2026-04-06']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 250px;
            background-color: #f4f4f4;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
        }
        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 10px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #333;
        }
        .content {
            margin-left: 270px;
            margin-top: -300px;
            padding: 20px;
            width: 100%;
        }
        section {
            margin-bottom: 50px;
        }
        .container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
        }
    </style>
    <script>
    function showContent(id) {
    let sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
    }
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
        <li><a href="?page=dashboard">Dashboard</a></li>
        <li><a href="?page=alat">Alat</a></li>
        <li><a href="?page=user">User</a></li>
        <li><a href="?page=kategori">Kategori</a></li>
        <li><a href="?page=alat_masuk">Alat Masuk</a></li>
        <li><a href="?page=peminjaman">Peminjaman</a></li>
        <li><a href="?page=pengembalian">Pengembalian</a></li>
        <li><a href="?page=log">Log Aktifitas</a></li>
        </ul>
        <a href="login.php">log out</a>
    <div class="content">

<?php if ($page == 'dashboard'): ?>
    <h1>Dashboard</h1>
    <p>Selamat datang di halaman utama</p>

<?php elseif ($page == 'alat'): ?>
    <h2>Data Alat</h2>
    <?php foreach ($alat as $a): ?>
        <p><?= $a['name'] ?> - <?= $a['kondisi'] ?></p>
    <?php endforeach; ?>

<?php elseif ($page == 'user'): ?>
    <h2>Data User</h2>
    <?php foreach ($user as $u): ?>
        <p><?= $u['name'] ?> - <?= $u['email'] ?></p>
    <?php endforeach; ?>

<?php elseif ($page == 'kategori'): ?>
    <h2>Kategori</h2>
    <?php foreach ($kategori as $k): ?>
        <p><?= $k['name'] ?></p>
    <?php endforeach; ?>

<?php elseif ($page == 'alat_masuk'): ?>
    <h2>Alat Masuk</h2>
    <?php foreach ($alat_masuk as $a): ?>
        <p><?= $a['alat'] ?> - <?= $a['date'] ?></p>
    <?php endforeach; ?>

<?php elseif ($page == 'peminjaman'): ?>
    <h2>Peminjaman</h2>
    <?php foreach ($peminjaman as $p): ?>
        <p><?= $p['user'] ?> - <?= $p['alat'] ?></p>
    <?php endforeach; ?>

<?php elseif ($page == 'pengembalian'): ?>
    <h2>Pengembalian</h2>
    <?php foreach ($pengembalian as $p): ?>
        <p><?= $p['user'] ?> - <?= $p['alat'] ?></p>
    <?php endforeach; ?>

<?php elseif ($page == 'log'): ?>
    <h2>Log Aktifitas</h2>
    <?php foreach ($log_aktifitas as $l): ?>
        <p><?= $l['activity'] ?> - <?= $l['date'] ?></p>
    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>