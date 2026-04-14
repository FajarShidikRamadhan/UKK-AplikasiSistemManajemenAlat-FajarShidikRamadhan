<?php
session_start();
include '../Koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); 

    if ($user && $password === $user['password']) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; 

        if ($_SESSION['role'] == 'admin') {
            header("Location: ../admin/index.php");
            exit();
        } else if ($_SESSION['role'] == 'petugas' || $_SESSION['role'] == 'petugas') {
            header("Location: ../petugas/petugas.php");
            exit();
        } else if ($_SESSION['role'] == 'peminjam') {
            header("Location: ../peminjam/peminjam.php");
            exit();
        } else {
            session_destroy();
            echo "<script>
            alert('Level pengguna tidak valid!');
            document.location.href = 'login.php';
            </script>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1', // Indigo modern
                        secondary: '#7e22ce', // Ungu
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased flex items-center justify-center min-h-screen p-4">
    <a href="../index.php" title="Kembali ke Beranda"
        class="absolute top-6 left-6 md:top-8 md:left-8 bg-white p-3 rounded-full shadow-md text-gray-500 hover:text-primary hover:shadow-lg hover:-translate-y-1 transition-all z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
    </a>

    <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-2xl shadow-xl border border-gray-100 transition-all">

        <div class="text-center mb-8">
            <div class="flex justify-center items-center gap-2 font-bold text-2xl text-primary mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                PinjamAlat.
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali!</h2>
            <p class="text-gray-500 text-sm mt-1">Silakan masukkan detail akun Anda.</p>
        </div>

        <form action="login.php" method="post" class="space-y-5">

            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all bg-gray-50 focus:bg-white placeholder-gray-400"
                    placeholder="Masukkan username Anda">
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all bg-gray-50 focus:bg-white placeholder-gray-400"
                    placeholder="••••••••">
            </div>

            <div>
                <label for="level" class="block text-sm font-semibold text-gray-700 mb-1">Login Sebagai</label>
                <select name="level" id="level"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all bg-gray-50 focus:bg-white cursor-pointer">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="peminjam">Peminjam</option>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-3.5 px-4 rounded-lg transition-all shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-0.5 mt-2">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="../index.php" class="text-sm text-primary font-semibold hover:underline flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Halaman Awal
            </a>
        </div>

    </div>
</body>

</html>