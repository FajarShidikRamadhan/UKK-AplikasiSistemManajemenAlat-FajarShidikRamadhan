<?php
if (isset($_POST['simpan'])) {
    $idalat      = $_POST['idalat'];
    $idkategori  = $_POST['idkategori'];
    $namaalat    = $_POST['namaalat'];
    $spesifikasi = $_POST['spesifikasi'];
    $qty         = $_POST['qty'];

    $nama_file = $_FILES['gambaralat']['name'];
    $tmp_file  = $_FILES['gambaralat']['tmp_name'];
    $gambar_baru = "";

    if ($nama_file != "") {
        $gambar_baru = "ALAT_" . $idalat . "_" . date('His') . ".png";
        move_uploaded_file($tmp_file, "PNG/" . $gambar_baru);
    }

    $query = mysqli_query($conn, "INSERT INTO alat (idalat, idkategori, namaalat, spesifikasi, gambaralat, qty) 
                                    VALUES ('$idalat', '$idkategori', '$namaalat', '$spesifikasi', '$gambar_baru', '$qty')");

    if ($query) {
        echo "<script>alert('Alat berhasil ditambahkan!'); window.location='index.php?page=data_alat';</script>";
    } else {
        echo "<script>alert('Gagal! ID Alat mungkin sudah ada di database.');</script>";
    }
}
?>

<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Tambah Alat Baru</h2>
        <p class="text-sm text-slate-500 mt-1">Masukkan data lengkap alat ke dalam inventaris.</p>
    </div>
    <a href="index.php?page=data_alat" class="bg-slate-200 text-slate-700 hover:bg-slate-300 transition-all duration-200 px-5 py-2.5 rounded-lg font-semibold text-sm shadow-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali
    </a>
</div>

<div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-slate-100 max-w-4xl">

    <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">ID Alat (Kode) <span class="text-red-500">*</span></label>
                <input type="text" name="idalat" required maxlength="15" placeholder="Contoh: ALT-001" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="idkategori" required class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition-all bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM kategori");
                    while ($k = mysqli_fetch_array($kategori)) {
                        echo "<option value='" . $k['idkategori'] . "'>" . $k['namakategori'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Alat <span class="text-red-500">*</span></label>
                <input type="text" name="namaalat" required maxlength="255" placeholder="Contoh: Proyektor Epson EB-X05" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition-all">
            </div>
    
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Spesifikasi</label>
                <textarea name="spesifikasi" rows="3" placeholder="Tuliskan detail spesifikasi alat di sini..." class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition-all"></textarea>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Stok Awal (Qty) <span class="text-red-500">*</span></label>
                    <input type="number" name="qty" required min="0" placeholder="0" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition-all">
                </div>
    
                <div class="bg-slate-50 p-4 rounded-lg border border-dashed border-slate-300">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Gambar Alat</label>
                    <input type="file" name="gambaralat" accept="PNG/" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition-all cursor-pointer">
                    <p class="text-xs text-slate-400 mt-2">*Format yang didukung: PNG.</p>
                </div>
            </div>

        <hr class="border-slate-200">

        <div class="flex justify-end">
            <button type="submit" name="simpan" class="bg-teal-500 hover:bg-teal-600 hover:-translate-y-0.5 text-white transition-all duration-200 px-6 py-3 rounded-lg font-bold shadow-md hover:shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
                Simpan Alat
            </button>
        </div>

    </form>
</div>