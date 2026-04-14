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
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Alat Masuk</h2>
        <p style="color: #64748b; margin-top: 5px; font-size: 14px;">Riwayat penambahan stok alat ke dalam inventaris.</p>
    </div>

    <a href="index.php?page=tambah_alat_masuk" class="btn-animasi" style="background-color: #6366f1; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px; box-shadow: 0 4px 6px rgba(99,102,241,0.2);">
        + Tambah Alat Masuk
    </a>
</div>

<div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
        <thead>
            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Tanggal Masuk</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Nama Alat</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px;">Kategori</th>
                <th style="padding: 15px; color: #64748b; font-size: 14px; text-align: center;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM alatmasuk JOIN alat ON alatmasuk.idalat = alat.idalat");

            // Cek apakah ada data
            if (mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 15px; font-size: 14px; color: #334155;">
                            <?= date('d F Y', strtotime($data['tglmasuk'])); ?>
                        </td>

                        <td style="padding: 15px; font-size: 14px; color: #334155;">
                            <?= $data['namaalat']; ?>
                        </td>

                        <td style="padding: 15px; font-size: 14px; color: #334155;">
                            <?= $data['idkategori']; ?> </td>

                        <td style="padding: 15px; text-align: center;">
                            <span style="background: #dcfce3; color: #16a34a; padding: 4px 12px; border-radius: 20px; font-weight: bold; font-size: 13px;">
                                +<?= $data['qty']; ?>
                            </span>
                        </td>
                    </tr>
                <?php
                } // akhir while
            } else {
                ?>
                <tr>
                    <td colspan="4" style="padding: 30px; text-align: center; color: #94a3b8;">Belum ada data alat masuk.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>