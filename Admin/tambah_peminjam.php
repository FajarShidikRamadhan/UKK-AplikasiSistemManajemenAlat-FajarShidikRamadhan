<?php
if (isset($_POST['simpan'])) {
    $idpinjam   = $_POST['idpinjam'];
    $iduser     = $_POST['iduser'];
    $idalat     = $_POST['idalat'];
    $qty_pinjam = $_POST['qty'];
    $tglpinjam  = $_POST['tglpinjam'];
    $tglkembali = $_POST['tglkembali'];
    $status     = $_POST['status'];
    $kondisiakhir = "-"; 

    $cek_stok = mysqli_query($conn, "SELECT qty, namaalat FROM alat WHERE idalat='$idalat'");
    $data_alat = mysqli_fetch_array($cek_stok);
    $stok_tersedia = $data_alat['qty'];

    if ($qty_pinjam > $stok_tersedia) {
        echo "<script>
                alert('GAGAL! Stok " . $data_alat['namaalat'] . " tidak mencukupi. Sisa stok saat ini hanya: " . $stok_tersedia . "'); 
                window.history.back();
            </script>";
    } else {
        $query = mysqli_query($conn, "INSERT INTO peminjaman (idpinjam, tglpinjam, tglkembali, idalat, qty, iduser, kondisiakhir, status) 
                                        VALUES ('$idpinjam', '$tglpinjam', '$tglkembali', '$idalat', '$qty_pinjam', '$iduser', '$kondisiakhir', '$status')");

        if ($query) {
            if ($status == 'dipinjam' || $status == 'disetujui') {
                mysqli_query($conn, "UPDATE alat SET qty = qty - $qty_pinjam WHERE idalat='$idalat'");
            }

            echo "<script>alert('Peminjaman manual berhasil dicatat!'); window.location='index.php?page=peminjaman';</script>";
        } else {
            echo "<script>alert('Gagal! Pastikan ID Pinjam belum pernah digunakan sebelumnya.');</script>";
        }
    }
}
?>

<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Input Peminjaman Manual</h2>
        <p class="text-sm text-slate-500 mt-1">Catat data peminjaman yang dilakukan secara offline.</p>
    </div>
    <a href="index.php?page=peminjaman" class="bg-slate-200 text-slate-700 hover:bg-slate-300 transition-all duration-200 px-5 py-2.5 rounded-lg font-semibold text-sm shadow-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-slate-100 max-w-4xl">

    <form action="" method="POST" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">ID Pinjam (Nota) <span class="text-red-500">*</span></label>
                <input type="text" name="idpinjam" value="TRX-<?= time() ?>" required maxlength="15" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none bg-slate-50 font-mono text-slate-600">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Peminjam <span class="text-red-500">*</span></label>
                <select name="iduser" required class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                    <option value="">-- Cari Nama Peminjam --</option>
                    <?php
                    // Hanya memunculkan user yang role-nya 'peminjam'
                    $user = mysqli_query($conn, "SELECT iduser, namalengkap FROM user WHERE role='peminjam'");
                    while ($u = mysqli_fetch_array($user)) {
                        echo "<option value='" . $u['iduser'] . "'>" . $u['namalengkap'] . " (" . $u['iduser'] . ")</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Alat <span class="text-red-500">*</span></label>
                <select name="idalat" required class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                    <option value="">-- Cari Alat --</option>
                    <?php
                    // Memunculkan data alat beserta sisa stoknya
                    $alat = mysqli_query($conn, "SELECT idalat, namaalat, qty FROM alat WHERE qty > 0");
                    while ($a = mysqli_fetch_array($alat)) {
                        echo "<option value='" . $a['idalat'] . "'>" . $a['namaalat'] . " (Sisa: " . $a['qty'] . " unit)</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Pinjam (Qty) <span class="text-red-500">*</span></label>
                <input type="number" name="qty" required min="1" placeholder="1" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Pinjam <span class="text-red-500">*</span></label>
                <input type="date" name="tglpinjam" value="<?= date('Y-m-d') ?>" required class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Rencana Tanggal Kembali <span class="text-red-500">*</span></label>
                <input type="date" name="tglkembali" value="<?= date('Y-m-d', strtotime('+1 days')) ?>" required class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Status Peminjaman <span class="text-red-500">*</span></label>
            <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                <select name="status" required class="w-full px-4 py-2.5 rounded-lg border border-indigo-300 focus:ring-2 focus:ring-indigo-500 outline-none bg-white font-semibold text-indigo-800">
                    <option value="dipinjam">Langsung Dipinjamkan (Stok akan dipotong otomatis)</option>
                    <option value="menunggu">Menunggu Persetujuan (Stok belum dipotong)</option>
                </select>
            </div>
        </div>

        <hr class="border-slate-200">

        <div class="flex justify-end">
            <button type="submit" name="simpan" class="bg-indigo-500 hover:bg-indigo-600 hover:-translate-y-0.5 text-white transition-all duration-200 px-6 py-3 rounded-lg font-bold shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Catat Peminjaman
            </button>
        </div>

    </form>
</div>