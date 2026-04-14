<?php
session_start();

include 'koneksi.php';

if (isset($_SESSION['username'])) {
    $pelaku = $_SESSION['username']; 
    $waktu = date('Y-m-d H:i:s');
    $keterangan = "Keluar (logout) dari sistem";

    // Simpan ke database
    mysqli_query($conn, "INSERT INTO log_aktifitas (waktu, username, aksi, keterangan) 
                            VALUES ('$waktu', '$pelaku', 'Logout', '$keterangan')");
}

session_unset();
session_destroy();

header("Location: login/login.php");
exit();
