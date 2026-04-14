<?php
$query_user = mysqli_query($conn, "SELECT * FROM user");
$total_user = mysqli_num_rows($query_user);

$query_alat = mysqli_query($conn, "SELECT * FROM alat");
$total_alat = $query_alat ? mysqli_num_rows($query_alat) : 0;

$total_pinjam = 0;
$total_kembali = 0;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Peminjaman</title>
    <style>
        .btn-aksi:hover {
            transform: translateY(-4px) scale(1.02);
            filter: brightness(1.1);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2) !important;
        }
    </style>

</head>
<div class="header">
    <h3>Selamat Datang, Admin <?= $_SESSION['username']; ?>! 👋</h3>
</div>

<div style="margin-bottom: 25px;">
    <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Dashboard Admin</h2>
    <p style="color: #64748b; margin-top: 5px;">Ringkasan sistem peminjaman alat hari ini.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">

    <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border-left: 5px solid #6366f1; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <p style="color: #64748b; font-size: 14px; font-weight: 600; margin: 0 0 10px 0;">Total User</p>
            <h3 style="color: #6366f1; font-size: 32px; font-weight: bold; margin: 0;"><?= $total_user; ?></h3>
        </div>
        <div style="background: #e0e7ff; padding: 15px; border-radius: 50%; color: #6366f1;">
            <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border-left: 5px solid #14b8a6; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <p style="color: #64748b; font-size: 14px; font-weight: 600; margin: 0 0 10px 0;">Total Alat</p>
            <h3 style="color: #14b8a6; font-size: 32px; font-weight: bold; margin: 0;"><?= $total_alat; ?></h3>
        </div>
        <div style="background: #ccfbf1; padding: 15px; border-radius: 50%; color: #14b8a6;">
            <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border-left: 5px solid #f97316; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <p style="color: #64748b; font-size: 14px; font-weight: 600; margin: 0 0 10px 0;">Pinjam (Menunggu)</p>
            <h3 style="color: #f97316; font-size: 32px; font-weight: bold; margin: 0;"><?= $total_pinjam; ?></h3>
        </div>
        <div style="background: #ffedd5; padding: 15px; border-radius: 50%; color: #f97316;">
            <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); border-left: 5px solid #f43f5e; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <p style="color: #64748b; font-size: 14px; font-weight: 600; margin: 0 0 10px 0;">Kembali (Menunggu)</p>
            <h3 style="color: #f43f5e; font-size: 32px; font-weight: bold; margin: 0;"><?= $total_kembali; ?></h3>
        </div>
        <div style="background: #ffe4e6; padding: 15px; border-radius: 50%; color: #f43f5e;">
            <svg style="width: 28px; height: 28px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
            </svg>
        </div>
    </div>

</div>

<div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
    <h3 style="font-size: 18px; font-weight: bold; color: #1e293b; margin: 0 0 20px 0;">Aksi Cepat</h3>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">

        <a href="index.php?page=alat_masuk" class="btn-aksi" style="background: #14b8a6; color: white; text-align: center; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; display: block; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(20, 184, 166, 0.2);">
            🛠️ Alat Masuk
        </a>

        <a href="index.php?page=data_alat" class="btn-aksi" style="background: #5314b8; color: white; text-align: center; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; display: block; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(83, 20, 184, 0.2);">
            🛠️ Kelola Alat
        </a>

        <a href="index.php?page=data_user" class="btn-aksi" style="background: #6366f1; color: white; text-align: center; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; display: block; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);">
            👥 Kelola User
        </a>

        <a href="index.php?page=kategori" class="btn-aksi" style="background: #6366f1; color: white; text-align: center; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; display: block; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);">
            📁 Kelola Kategori
        </a>

        <a href="index.php?page=peminjaman" class="btn-aksi" style="background: #f97316; color: white; text-align: center; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; display: block; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(249, 115, 22, 0.2);">
            📤 Kelola Peminjaman
        </a>

        <a href="index.php?page=log_aktifitas" class="btn-aksi" style="background: #8b5cf6; color: white; text-align: center; padding: 15px; border-radius: 8px; text-decoration: none; font-weight: bold; display: block; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(139, 92, 246, 0.2);">
            📝 Lihat Log Aktivitas
        </a>

    </div>
</div>