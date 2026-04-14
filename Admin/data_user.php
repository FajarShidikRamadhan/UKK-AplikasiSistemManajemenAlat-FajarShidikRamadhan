<?php

if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];

    $cek_foto = mysqli_query($conn, "SELECT identitas FROM user WHERE iduser='$id_hapus'");
    $data_foto = mysqli_fetch_array($cek_foto);

    if ($data_foto['identitas'] != "") {
        unlink("PNG/" . $data_foto['identitas']);
    }

    $hapus = mysqli_query($conn, "DELETE FROM user WHERE iduser='$id_hapus'");

    if ($hapus) {
        echo "<script>alert('User dan foto berhasil dihapus!'); window.location='index.php?page=data_user';</script>";
    } else {
        echo "<script>alert('Gagal menghapus user!');</script>";
    }
}
?>
<style>
    .btn-animasi {
        transition: all 0.2s ease-in-out;
        display: inline-block;
    }

    .btn-animasi:hover {
        transform: translateY(-2px);
        filter: brightness(1.15);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .btn-hapus {
        transition: all 0.2s ease-in-out;
        display: inline-block;
    }

    .btn-hapus:hover {
        transform: translateY(-2px);
        background-color: #dc2626 !important;
        /* Merah lebih pekat */
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.4);
        /* Bayangan kemerahan */
    }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Kelola Data User</h2>
        <p style="color: #64748b; margin-top: 5px; font-size: 14px;">Daftar semua pengguna, petugas, dan admin sistem.</p>
    </div>

    <a href="index.php?page=tambah_user" class="btn-animasi" style="background-color: #6366f1; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px; box-shadow: 0 4px 6px rgba(99,102,241,0.2);">
        + Tambah User
    </a>
</div>

<div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
        <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
                <th style="padding: 15px; color: #64748b; font-size: 14px;">ID User</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Nama Lengkap</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Username</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Role</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Foto Identitas</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM user ORDER BY role ASC, namalengkap ASC");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; font-size: 14px; color: #334155; font-weight: bold;"><?= $data['iduser']; ?></td>
                        <td style="padding: 15px; font-size: 14px; color: #334155;"><?= $data['namalengkap']; ?><br><span style="font-size: 12px; color: #94a3b8;"><?= $data['nohp']; ?></span></td>
                        <td style="padding: 15px; font-size: 14px; color: #334155;"><?= $data['username']; ?></td>
                        <td style="padding: 15px;">
                            <?php $warna = $data['role'] == 'admin' ? '#fee2e2; color: #ef4444;' : ($data['role'] == 'petugas' ? '#fef3c7; color: #f59e0b;' : '#e0e7ff; color: #4f46e5;'); ?>
                            <span style="background: <?= $warna ?>; padding: 4px 12px; border-radius: 20px; font-weight: bold; font-size: 12px; text-transform: uppercase;">
                                <?= $data['role']; ?>
                            </span>
                        </td>
                        <td style="padding: 15px;">
                            <?php if ($data['identitas'] != "") { ?>
                                <a href="PNG/<?= $data['identitas']; ?>" target="_blank">
                                    <img src="PNG/<?= $data['identitas']; ?>" style="width: 50px; height: 35px; object-fit: cover; border-radius: 4px; border: 1px solid #cbd5e1;">
                                </a>
                            <?php } else { ?>
                                <span style="font-size: 12px; color: #94a3b8;">Tidak ada foto</span>
                            <?php } ?>
                        </td>
                        <td style="padding: 15px;">
                        <td style="padding: 15px;">
                            <a href="index.php?page=edit_user&id=<?= $data['iduser']; ?>" class="btn-animasi" style="background: #3b82f6; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px;">Edit</a>

                            <a href="index.php?page=data_user&hapus=<?= $data['iduser']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus user ini secara permanen?');" style="background: #ef4444; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; margin-left: 5px;">Hapus</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="6" style="padding: 30px; text-align: center; color: #94a3b8;">Belum ada data user.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>