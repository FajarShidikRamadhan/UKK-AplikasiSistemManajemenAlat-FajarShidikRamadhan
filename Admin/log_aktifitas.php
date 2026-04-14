<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Log Aktivitas Sistem</h2>
        <p class="text-sm text-slate-500 mt-1">Rekaman jejak semua aktivitas yang terjadi di dalam aplikasi.</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Riwayat Terbaru
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-100/50 border-b border-slate-200">
                    <th class="p-4 text-sm font-semibold text-slate-600 w-48">Waktu & Tanggal</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Pelaku (User)</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Jenis Aksi</th>
                    <th class="p-4 text-sm font-semibold text-slate-600">Detail Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php
                $query = mysqli_query($conn, "SELECT * FROM log_aktifitas ORDER BY waktu DESC LIMIT 100"); // Dibatasi 100 agar tidak berat

                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_array($query)) {

                        $warna_badge = "bg-slate-100 text-slate-700";
                        if (strpos(strtolower($data['aksi']), 'tambah') !== false) $warna_badge = "bg-emerald-100 text-emerald-700";
                        if (strpos(strtolower($data['aksi']), 'edit') !== false) $warna_badge = "bg-blue-100 text-blue-700";
                        if (strpos(strtolower($data['aksi']), 'hapus') !== false) $warna_badge = "bg-red-100 text-red-700";
                        if (strpos(strtolower($data['aksi']), 'login') !== false) $warna_badge = "bg-indigo-100 text-indigo-700";
                ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4 text-sm text-slate-600 font-mono">
                                <?= date('d M Y', strtotime($data['waktu'])); ?><br>
                                <span class="text-xs text-slate-400"><?= date('H:i:s', strtotime($data['waktu'])); ?> WIB</span>
                            </td>
                            <td class="p-4 text-sm font-bold text-slate-700 flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 font-bold text-xs uppercase">
                                    <?= substr($data['username'], 0, 2); ?>
                                </div>
                                <?= $data['username']; ?>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full <?= $warna_badge; ?>">
                                    <?= $data['aksi']; ?>
                                </span>
                            </td>
                            <td class="p-4 text-sm text-slate-600">
                                <?= $data['keterangan']; ?>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="4" class="p-8 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Belum ada aktivitas yang terekam.
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>