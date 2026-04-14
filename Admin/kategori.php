<?php
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];

    $hapus = mysqli_query($conn, "DELETE FROM kategori WHERE idkategori='$id_hapus'");

    if ($hapus) {
        echo "<script>alert('Kategori berhasil dihapus!'); window.location='index.php?page=kategori';</script>";
    } else {
        echo "<script>alert('Gagal! Kategori tidak bisa dihapus karena sedang digunakan oleh data alat.'); window.location='index.php?page=kategori';</script>";
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
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-hapus {
        transition: all 0.2s ease-in-out;
        display: inline-block;
    }

    .btn-hapus:hover {
        transform: translateY(-2px);
        background-color: #dc2626 !important;
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.4);
    }
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Kelola Kategori Alat</h2>
        <p style="color: #64748b; margin-top: 5px; font-size: 14px;">Daftar pengelompokan jenis alat yang tersedia.</p>
    </div>

    <a href="index.php?page=tambah_kategori" class="btn-animasi" style="background-color: #6366f1; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;">
        + Tambah Kategori
    </a>
</div>

<div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; min-width: 500px;">
        <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
                <th style="padding: 15px; color: #64748b; font-size: 14px; width: 25%;">ID Kategori</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Nama Kategori</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px; width: 25%; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM kategori ORDER BY idkategori ASC");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; font-size: 14px; color: #334155; font-weight: bold;">
                            <?= $data['idkategori']; ?>
                        </td>
                        <td style="padding: 15px; font-size: 14px; color: #334155;">
                            <?= $data['namakategori']; ?>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="index.php?page=edit_kategori&id=<?= $data['idkategori']; ?>" class="btn-animasi" style="background: #3b82f6; color: white; padding: 6px 16px; border-radius: 6px; text-decoration: none; font-size: 12px;">Edit</a>

                            <a href="index.php?page=kategori&hapus=<?= $data['idkategori']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?');" style="background: #ef4444; color: white; padding: 6px 16px; border-radius: 6px; text-decoration: none; font-size: 12px; margin-left: 5px;">Hapus</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="3" style="padding: 30px; text-align: center; color: #94a3b8;">Belum ada data kategori.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>