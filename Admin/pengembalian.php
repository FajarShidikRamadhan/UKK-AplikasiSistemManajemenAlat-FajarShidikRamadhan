<?php
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id_pinjam = $_GET['id'];
    $aksi = $_GET['aksi'];

    if ($aksi == 'konfirmasi') {
        $cek_pinjam = mysqli_query($conn, "SELECT idalat, qty FROM peminjaman WHERE idpinjam='$id_pinjam'");
        $data_pinjam = mysqli_fetch_array($cek_pinjam);
        $idalat = $data_pinjam['idalat'];
        $qty_kembali = $data_pinjam['qty'];

        $update_status = mysqli_query($conn, "UPDATE peminjaman SET status='selesai' WHERE idpinjam='$id_pinjam'");

        if ($update_status) {
            mysqli_query($conn, "UPDATE alat SET qty = qty + $qty_kembali WHERE idalat='$idalat'");

            echo "<script>alert('Pengembalian berhasil dikonfirmasi! Stok alat telah dikembalikan.'); window.location='index.php?page=pengembalian';</script>";
        }
    }
}
?>

<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Pengembalian Alat</h2>
    <p class="text-sm text-slate-500 mt-1">Konfirmasi alat yang telah dikembalikan untuk mengembalikan stok ke inventaris.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100">
        <h3 class="text-lg font-bold text-slate-800">Daftar Pengembalian</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="p-4 text-sm font-semibold text-slate-600">ID Pengembalian</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Peminjam</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Alat</th>
                    <th class="p-4 text-sm font-semibold text-slate-600 text-center">Qty</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Tanggal Pengembalian</th>
                    <th class="p-4 text-sm font-semibold text-slate-600 text-center">Status</th>
                    <th class="p-4 text-sm font-semibold text-slate-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php
                $query = mysqli_query($conn, "
                    SELECT p.*, u.namalengkap, a.namaalat 
                    FROM peminjaman p 
                    JOIN user u ON p.iduser = u.iduser 
                    JOIN alat a ON p.idalat = a.idalat 
                    WHERE p.status IN ('dikembalikan', 'selesai')
                    ORDER BY 
                        CASE WHEN p.status = 'dikembalikan' THEN 1 ELSE 2 END, -- Prioritaskan yang belum dikonfirmasi di atas
                        p.tglkembali DESC
                ");

                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4 text-sm text-slate-500 font-mono"><?= substr($data['idpinjam'], 0, 8); ?>...</td>
                            <td class="p-4 text-sm font-medium text-slate-700"><?= $data['namalengkap']; ?></td>
                            <td class="p-4 text-sm text-slate-700 font-semibold"><?= $data['namaalat']; ?></td>
                            <td class="p-4 text-sm text-slate-700 text-center font-bold"><?= $data['qty']; ?></td>

                            <td class="p-4 text-sm text-slate-600">
                                <?php
                                echo ($data['tglkembali'] && $data['tglkembali'] != '0000-00-00') ? date('Y-m-d', strtotime($data['tglkembali'])) : '-';
                                ?>
                            </td>

                            <td class="p-4 text-center">
                                <?php if ($data['status'] == 'selesai') { ?>
                                    <span class="px-3 py-1 text-xs font-bold rounded-full capitalize bg-emerald-100 text-emerald-700">
                                        Selesai
                                    </span>
                                <?php } else { ?>
                                    <span class="px-3 py-1 text-xs font-bold rounded-full capitalize bg-blue-100 text-blue-700">
                                        Dikembalikan
                                    </span>
                                <?php } ?>
                            </td>

                            <td class="p-4 text-center">
                                <?php if ($data['status'] == 'dikembalikan') { ?>
                                    <a href="index.php?page=pengembalian&aksi=konfirmasi&id=<?= $data['idpinjam']; ?>"
                                        onclick="return confirm('Konfirmasi pengembalian ini? Stok alat akan bertambah secara otomatis.');"
                                        class="bg-indigo-500 hover:bg-indigo-600 hover:-translate-y-0.5 transition-all duration-200 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-sm inline-block">
                                        Konfirmasi
                                    </a>
                                <?php } else { ?>
                                    <span class="text-xs text-slate-400 font-medium italic">
                                        ✓ Sudah dikonfirmasi
                                    </span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-500">Belum ada riwayat pengembalian alat.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>