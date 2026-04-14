<?php
$servername = "localhost";
$db = "ukk_2026_fajar_shidik_ramadhan";
$username = "root";
$password = "";

$conn = mysqli_connect ($servername, $username, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
