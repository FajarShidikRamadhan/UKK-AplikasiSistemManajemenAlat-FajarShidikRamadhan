<?php 
session_start();
include 'Koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap input
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username_safe = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM user WHERE username = '$username_safe'";
    
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($login);

        // Bikin Saku/Session
        $_SESSION['username'] = $username;
        $_SESSION['namalengkap'] = $data['namalengkap'];
        $_SESSION['role'] = $data['role'];

        $waktu = date('Y-m-d H:i:s');
        $keterangan = "Berhasil login ke dalam sistem sebagai " . $data['role'];

        mysqli_query($conn, "INSERT INTO log_aktifitas (waktu, username, aksi, keterangan) 
                            VALUES ('$waktu', '$username', 'Login', '$keterangan')");

    }

    if ($user) {

        if ($password === $user['password']) {

            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header('Location: ../dashboard_admin.php');
            } else if ($user['role'] == 'peminjam') {
                header('Location: ../dashboard_user.php');
            } else if ($user['role'] == 'petugas') {
                header('Location: ../dashboard_petugas.php');
            }
            exit();

        } else {
            echo "<script>
            alert('Password Salah!');
            document.location.href = 'login.php';
            </script>";
        }

    } else {
        echo "<script>
        alert('Username tidak ditemukan!');
        document.location.href = 'login.php';
        </script>";
    }
}
?>