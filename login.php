<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hardcoded_users = [
        'admin' => ['password' => 'admin123', 'role' => 'admin'],
        'petugas' => ['password' => 'petugas123', 'role' => 'petugas'],
        'user' => ['password' => 'pelanggan123', 'role' => 'pelanggan']
    ];

    $user = isset($hardcoded_users[$username]) && $hardcoded_users[$username]['password'] === $password
        ? ['username' => $username, 'role' => $hardcoded_users[$username]['role']] 
        : null;

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; 

        if ($_SESSION['role'] == 'admin') {
            header("Location: dashboard%20admin.php");
        } elseif ($_SESSION['role'] == 'pelanggan') {
            header("Location: beranda.php");
        } else {
            header("Location: logout.php"); 
        }
        exit();
    } else {
        echo "<script>
        alert('Username atau password salah!');
        document.location.href = 'login.php';
        </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    </head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="beranda.php">Kembali ke Beranda</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>