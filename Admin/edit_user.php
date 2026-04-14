<?php
$id_edit = $_GET['id'];

$query_lama = mysqli_query($conn, "SELECT * FROM user WHERE iduser = '$id_edit'");
$data_lama = mysqli_fetch_array($query_lama);

if (isset($_POST['update'])) {
    $username    = $_POST['username'];
    $role        = $_POST['role'];
    $namalengkap = $_POST['namalengkap'];
    $nohp        = $_POST['nohp'];
    $password_baru = $_POST['password']; 

    if ($password_baru != "") {
        mysqli_query($conn, "UPDATE user SET password='$password_baru' WHERE iduser='$id_edit'");
    }

    $nama_file = $_FILES['identitas']['name'];
    $tmp_file  = $_FILES['identitas']['tmp_name'];

    if ($nama_file != "") {
        if ($data_lama['identitas'] != "") {
            unlink("PNG/" . $data_lama['identitas']);
        }
        $identitas_baru = "KTP_" . $id_edit . "_" . date('His') . ".png";
        move_uploaded_file($tmp_file, "PNG/" . $identitas_baru);

        mysqli_query($conn, "UPDATE user SET identitas='$identitas_baru' WHERE iduser='$id_edit'");
    }

    $update_teks = mysqli_query($conn, "UPDATE user SET username='$username', role='$role', namalengkap='$namalengkap', nohp='$nohp' WHERE iduser='$id_edit'");

    if ($update_teks) {
        echo "<script>alert('Data User berhasil diperbarui!'); window.location='index.php?page=data_user';</script>";
    }
}
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Edit Data User</h2>
    </div>
    <a href="index.php?page=data_user" style="background-color: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;">
        Batal / Kembali
    </a>
</div>

<div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 800px;">

    <form action="" method="POST" enctype="multipart/form-data">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">ID User (Tidak bisa diubah)</label>
                <input type="text" value="<?= $data_lama['iduser']; ?>" readonly style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: #e2e8f0; color: #64748b; cursor: not-allowed; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Nama Lengkap *</label>
                <input type="text" name="namalengkap" required value="<?= $data_lama['namalengkap']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Username *</label>
                <input type="text" name="username" required value="<?= $data_lama['username']; ?>" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Password Baru (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti password" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Role *</label>
                <select name="role" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                    <option value="admin" <?= $data_lama['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="petugas" <?= $data_lama['role'] == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
                    <option value="peminjam" <?= $data_lama['role'] == 'peminjam' ? 'selected' : ''; ?>>Peminjam</option>
                </select>
            </div>
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">No. HP / WA *</label>
                <input type="text" name="nohp" required value="<?= $data_lama['nohp']; ?>" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 25px; padding: 15px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Ganti Foto Identitas</label>

            <?php if ($data_lama['identitas'] != "") { ?>
                <div style="margin-bottom: 10px; font-size: 13px; color: #16a34a;">✅ Foto saat ini sudah ada.</div>
            <?php } ?>

            <input type="file" name="identitas" accept="image/*" style="width: 100%;">
            <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b;">*Kosongkan bagian ini jika Anda tidak ingin mengganti foto yang lama.</p>
        </div>

        <button type="submit" name="update" style="background: #14b8a6; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s;">
            Simpan Perubahan
        </button>
    </form>
</div>