<?php

if (isset($_POST['simpan'])) {
    $iduser      = $_POST['iduser'];
    $username    = $_POST['username'];
    $password    = $_POST['password']; 
    $role        = $_POST['role'];
    $namalengkap = $_POST['namalengkap'];
    $nohp        = $_POST['nohp'];


    $nama_file = $_FILES['identitas']['name']; 
    $tmp_file  = $_FILES['identitas']['tmp_name']; 
    $identitas_baru = ""; 

    if ($nama_file != "") {
        $identitas_baru = "KTP_" . $iduser . "_" . date('His') . ".jpg/.png/.jpeg";

        $path = "PNG/" . $identitas_baru;

        move_uploaded_file($tmp_file, $path);
    }

    $query = mysqli_query($conn, "INSERT INTO user (iduser, username, password, role, namalengkap, identitas, nohp) 
                                    VALUES ('$iduser', '$username', '$password', '$role', '$namalengkap', '$identitas_baru', '$nohp')");

    if ($query) {
        echo "<script>alert('User berhasil ditambahkan!'); window.location='index.php?page=data_user';</script>";
    } else {
        echo "<script>alert('Gagal! Pastikan ID User atau Username belum terdaftar.');</script>";
    }
}
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="font-size: 24px; font-weight: bold; color: #1e293b; margin: 0;">Tambah User Baru</h2>
    </div>
    <a href="index.php?page=data_user" style="background-color: #e2e8f0; color: #475569; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;">
        Kembali
    </a>
</div>

<div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 800px;">

    <form action="" method="POST" enctype="multipart/form-data">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">ID User (NIS/NIP) *</label>
                <input type="text" name="iduser" required maxlength="15" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Nama Lengkap *</label>
                <input type="text" name="namalengkap" required maxlength="255" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Username *</label>
                <input type="text" name="username" required maxlength="255" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Password *</label>
                <input type="password" name="password" required maxlength="15" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Pilih Role *</label>
                <select name="role" required style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
                    <option value="" hidden></option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="peminjam">Peminjam</option>
                </select>
            </div>
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">No. HP / WA *</label>
                <input type="text" name="nohp" required maxlength="15" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 25px; padding: 15px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #334155;">Upload Foto Identitas (KTP/KTM)</label>
            <input type="file" name="identitas" accept="image/*" style="width: 100%;">
            <p style="margin: 5px 0 0 0; font-size: 12px; color: #64748b;">*Kosongkan jika tidak ada foto.</p>
        </div>

        <button type="submit" name="simpan" style="background: #6366f1; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.2s;">
            Simpan User
        </button>
    </form>
</div>