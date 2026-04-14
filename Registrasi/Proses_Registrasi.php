<?php
include '../Koneksi.php'; 

$iduser      = $_POST['iduser'];
$username    = $_POST['username'];
$password    = $_POST['password'];
$role        = $_POST['role']; 
$namalengkap = $_POST['namalengkap'];
$identitas   = $_POST['identitas'];
$nohp        = $_POST['nohp'];

$cek_user = mysqli_query($conn, "SELECT * FROM user WHERE iduser = '$iduser' OR username = '$username'");

if (mysqli_num_rows($cek_user) > 0) {
    echo "<script>alert('Pendaftaran Gagal! ID User atau Username tersebut sudah terdaftar.'); window.history.back();</script>";
    exit;
}

$query = mysqli_query($conn, "INSERT INTO user (iduser, username, password, role, namalengkap, identitas, nohp) 
                                VALUES ('$iduser', '$username', '$password', '$role', '$namalengkap', '$identitas', '$nohp')");

if ($query) {
    echo "<script>alert('Pendaftaran Berhasil! Silakan Login menggunakan akun yang baru saja dibuat.'); window.location='../login/login.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan sistem, data gagal disimpan!'); window.history.back();</script>";
}
