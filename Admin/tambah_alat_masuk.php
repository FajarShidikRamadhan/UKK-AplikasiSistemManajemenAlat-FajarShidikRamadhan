<?php
if (isset($_POST['simpan'])) {
    // 1. Tangkap semua isian form
    $idmasuk  = $_POST['idmasuk'];
    $tglmasuk = $_POST['tglmasuk'];
    $idalat   = $_POST['idalat'];
    $qty      = $_POST['qty'];

    $query = mysqli_query($conn, "INSERT INTO alatmasuk (idmasuk, tglmasuk, idalat, qty) 
                                  VALUES ('$idmasuk', '$tglmasuk', '$idalat', '$qty')");

    if ($query) {
        echo "<script>
                alert('Berhasil! Data stok alat masuk telah dicatat.'); 
                window.location='index.php?page=alat_masuk';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mencatat data! Pastikan ID Masuk belum pernah digunakan.'); 
              </script>";
    }
}
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Catat Alat Masuk</h2>
        <p style="color: #64748b; margin-top: 5px; font-size: 14px;">Catat penambahan stok untuk alat yang sudah terdaftar.</p>
    </div>
    <a href="index.php?page=alat_masuk" style="background-color: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;">
        Kembali
    </a>
</div>

<div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px;">

    <form action="" method="POST">

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">ID Masuk (No. Nota/Faktur) *</label>
            <input type="text" name="idmasuk" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;" placeholder="Contoh: IN-001">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Tanggal Masuk *</label>
            <input type="date" name="tglmasuk" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;" value="<?= date('Y-m-d'); ?>">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Pilih Alat yang Masuk *</label>
            <select name="idalat" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                <option value="">-- Pilih Alat --</option>
                <?php
                $query_alat = mysqli_query($conn, "SELECT idalat, namaalat FROM alat");
                while ($data_alat = mysqli_fetch_array($query_alat)) {
                    echo "<option value='" . $data_alat['idalat'] . "'>" . $data_alat['idalat'] . " - " . $data_alat['namaalat'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Jumlah Tambahan Stok (Qty) *</label>
            <input type="number" name="qty" min="1" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
        </div>

        <button type="submit" name="simpan" style="background: #2563eb; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s;">
            Simpan Stok Masuk
        </button>
    </form>
</div>