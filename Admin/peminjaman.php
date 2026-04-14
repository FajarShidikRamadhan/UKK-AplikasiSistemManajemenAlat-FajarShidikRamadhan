<?php
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id_pinjam = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi == 'approve') {
        mysqli_query($koneksi, "UPDATE peminjaman SET status='disetujui' WHERE idpinjam='$id_pinjam'");
        echo "<script>alert('Peminjaman Disetujui!'); window.location='index.php?page=peminjaman';</script>";
    } elseif ($aksi == 'reject') {
        mysqli_query($koneksi, "UPDATE peminjaman SET status='ditolak' WHERE idpinjam='$id_pinjam'");
        echo "<script>alert('Peminjaman Ditolak!'); window.location='index.php?page=peminjaman';</script>";
    }
}

$filter_status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Loan Management (Peminjaman)</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola persetujuan dan input manual peminjaman alat.</p>
    </div>

    <a href="index.php?page=tambah_peminjam" class="bg-indigo-500 hover:bg-indigo-600 hover:-translate-y-0.5 text-white transition-all duration-200 px-5 py-2.5 rounded-lg font-bold shadow-sm flex items-center gap-2 text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Peminjaman
    </a>
</div>

<div class="bg-white p-5 rounded-xl shadow-sm border border-slate-100 mb-6">
    <h3 class="text-sm font-bold text-slate-700 mb-3">Filter Loans</h3>
    <form action="index.php" method="GET" class="flex items-center gap-3">
        <input type="hidden" name="page" value="peminjaman">

        <select name="status" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 outline-none text-sm bg-white min-w-[200px]">
            <option value="">Semua Status</option>
            <option value="menunggu" <?= $filter_status == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
            <option value="disetujui" <?= $filter_status == 'disetujui' ? 'selected' : '' ?>>Disetujui</option>
            <option value="dipinjam" <?= $filter_status == 'dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
            <option value="dikembalikan" <?= $filter_status == 'dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
            <option value="ditolak" <?= $filter_status == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
        </select>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100">
        <h3 class="text-lg font-bold text-slate-800">Loan Requests from Peminjam</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="p-4 text-sm font-semibold text-slate-600">ID</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Peminjam</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Equipment (Alat)</th>
                    <th class="p-4 text-sm font-semibold text-slate-600 text-center">Qty</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Loan Date</th>
                    <th class="p-4 text-sm font-semibold text-slate-600 text-center">Status</th>
                    <th class="p-4 text-sm font-semibold text-slate-600 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php
                $kondisi = $filter_status != '' ? "WHERE p.status = '$filter_status'" : "";

                $query = mysqli_query($conn, "
                    SELECT p.*, u.namalengkap, a.namaalat, a.spesifikasi 
                    FROM peminjaman p 
                    JOIN user u ON p.iduser = u.iduser 
                    JOIN alat a ON p.idalat = a.idalat 
                    $kondisi
                    ORDER BY p.tglpinjam DESC
                ");

                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        $bg_status = 'bg-slate-100 text-slate-600';
                        if ($data['status'] == 'menunggu') $bg_status = 'bg-yellow-100 text-yellow-700';
                        if ($data['status'] == 'disetujui' || $data['status'] == 'dipinjam') $bg_status = 'bg-blue-100 text-blue-700';
                        if ($data['status'] == 'dikembalikan') $bg_status = 'bg-emerald-100 text-emerald-700';
                        if ($data['status'] == 'ditolak') $bg_status = 'bg-red-100 text-red-700';
                ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4 text-sm text-slate-500 font-mono"><?= substr($data['idpinjam'], 0, 8); ?>...</td>
                            <td class="p-4 text-sm font-medium text-slate-700"><?= $data['namalengkap']; ?></td>
                            <td class="p-4">
                                <div class="text-sm font-bold text-slate-700"><?= $data['namaalat']; ?></div>
                                <div class="text-xs text-slate-500 mt-0.5 line-clamp-1"><?= $data['spesifikasi']; ?></div>
                            </td>
                            <td class="p-4 text-sm text-slate-700 text-center font-bold"><?= $data['qty']; ?></td>
                            <td class="p-4 text-sm text-slate-600"><?= date('Y-m-d', strtotime($data['tglpinjam'])); ?></td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 text-xs font-bold rounded-full capitalize <?= $bg_status; ?>">
                                    <?= $data['status']; ?>
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <?php if ($data['status'] == 'menunggu') { ?>
                                    <div class="flex justify-center gap-2">
                                        <a href="index.php?page=peminjaman&aksi=approve&id=<?= $data['idpinjam']; ?>" class="bg-emerald-500 hover:bg-emerald-600 hover:-translate-y-0.5 transition-all text-white px-3 py-1.5 rounded text-xs font-bold shadow-sm">Approve</a>
                                        <a href="index.php?page=peminjaman&aksi=reject&id=<?= $data['idpinjam']; ?>" onclick="return confirm('Tolak peminjaman ini?');" class="bg-red-500 hover:bg-red-600 hover:-translate-y-0.5 transition-all text-white px-3 py-1.5 rounded text-xs font-bold shadow-sm">Reject</a>
                                    </div>
                                <?php } else { ?>
                                    <span class="text-xs text-slate-400 italic">No actions</span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-500">Tidak ada data peminjaman ditemukan.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>