<?php
if (isset($_POST['simpan'])) {
    $idkategori   = $_POST['idkategori'];
    $namakategori = $_POST['namakategori'];

    $query = mysqli_query($conn, "INSERT INTO kategori (idkategori, namakategori) VALUES ('$idkategori', '$namakategori')");

    if ($query) {
        echo "<script>alert('Kategori berhasil ditambahkan!'); window.location='index.php?page=kategori';</script>";
    } else {
        echo "<script>alert('Gagal! Pastikan ID Kategori belum digunakan.');</script>";
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
</style>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Tambah Kategori</h2>
    </div>
    <a href="index.php?page=kategori" class="btn-animasi" style="background-color: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;">
        Kembali
    </a>
</div>

<div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px;">

    <form action="" method="POST">

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">ID Kategori *</label>
            <input type="text" name="idkategori" required maxlength="15" placeholder="Contoh: ELK (untuk Elektronik)" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Nama Kategori *</label>
            <input type="text" name="namakategori" required maxlength="255" placeholder="Contoh: Elektronik" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
        </div>

        <button type="submit" name="simpan" class="btn-animasi" style="background: #14b8a6; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
            Simpan Kategori
        </button>
    </form>
</div>