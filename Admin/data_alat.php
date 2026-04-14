<?php
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];

    $cek_gambar = mysqli_query($koneksi, "SELECT gambaralat FROM alat WHERE idalat='$id_hapus'");
    $data_gambar = mysqli_fetch_array($cek_gambar);

    if ($data_gambar['gambaralat'] != "") {
        unlink("PNG/" . $data_gambar['gambaralat']);
    }

    $hapus = mysqli_query($koneksi, "DELETE FROM alat WHERE idalat='$id_hapus'");

    if ($hapus) {
        echo "<script>alert('Data Alat dan gambar berhasil dihapus!'); window.location='index.php?page=data_alat';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data alat.');</script>";
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
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Kelola Data Alat</h2>
        <p style="color: #64748b; margin-top: 5px; font-size: 14px;">Daftar inventaris alat beserta spesifikasi dan stok.</p>
    </div>

    <a href="index.php?page=tambah_alat" class="btn-animasi" style="background-color: #6366f1; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;">
        + Tambah Alat
    </a>
</div>

<div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; min-width: 900px;">
        <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
                <th style="padding: 15px; color: #64748b; font-size: 14px;">ID Alat</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Gambar</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Nama Alat</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Kategori</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Spesifikasi</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px; text-align: center;">Stok (Qty)</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT alat.*, kategori.namakategori FROM alat LEFT JOIN kategori ON alat.idkategori = kategori.idkategori ORDER BY alat.idalat DESC");

            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; font-size: 14px; color: #334155; font-weight: bold;"><?= $data['idalat']; ?></td>

                        <td style="padding: 15px;">
                            <?php if ($data['gambaralat'] != "") { ?>
                                <a href="PNG/<?= $data['gambaralat']; ?>" target="_blank">
                                    <img src="PNG/<?= $data['gambaralat']; ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1;">
                                </a>
                            <?php } else { ?>
                                <span style="font-size: 12px; color: #94a3b8;">Kosong</span>
                            <?php } ?>
                        </td>

                        <td style="padding: 15px; font-size: 14px; color: #334155; font-weight: bold;"><?= $data['namaalat']; ?></td>

                        <td style="padding: 15px; font-size: 13px; color: #64748b;">
                            <span style="background: #e2e8f0; padding: 4px 10px; border-radius: 6px;"><?= $data['namakategori']; ?></span>
                        </td>

                        <td style="padding: 15px; font-size: 13px; color: #64748b; max-width: 200px;"><?= $data['spesifikasi']; ?></td>

                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #dcfce3; color: #16a34a; padding: 6px 12px; border-radius: 20px; font-weight: bold; font-size: 14px;">
                                <?= $data['qty']; ?>
                            </span>
                        </td>

                        <td style="padding: 15px; text-align: center;">
                            <a href="index.php?page=edit_alat&id=<?= $data['idalat']; ?>" class="btn-animasi" style="background: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 12px;">Edit</a>

                            <a href="index.php?page=data_alat&hapus=<?= $data['idalat']; ?>" class="btn-hapus" onclick="return confirm('Hapus alat ini beserta gambarnya?');" style="background: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 12px; margin-top: 5px; display: inline-block;">Hapus</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="7" style="padding: 30px; text-align: center; color: #94a3b8;">Belum ada data alat.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>