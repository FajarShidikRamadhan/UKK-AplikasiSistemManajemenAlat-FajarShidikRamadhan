<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>
            alert('Akses ditolak! Anda harus login terlebih dahulu.'); 
            window.location='../login.php';
          </script>";
    exit;
}

// 2. CEK ROLE
if ($_SESSION['role'] != 'admin') {
    echo "<script>
            alert('Akses ilegal! Anda bukan Admin.'); 
            window.history.back();
          </script>";
    exit;
}

include '../Koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Sistem Peminjaman</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        admin: '#1e293b', // Warna Sidebar (Slate 800)
                        hover: '#334155'  // Warna Hover Sidebar (Slate 700)
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside id="sidebar" class="absolute z-20 w-64 h-full bg-admin text-white transition-transform duration-300 transform -translate-x-full md:relative md:translate-x-0 flex flex-col shadow-xl">
            
            <div class="flex items-center justify-between p-6 border-b border-slate-700">
                <h2 class="text-xl font-bold tracking-wider">Admin Panel</h2>
                <button id="closeSidebar" class="md:hidden text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <a href="index.php?page=dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'dashboard' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>📊</span> Dashboard
                </a>
                <a href="index.php?page=alat_masuk" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'alat_masuk' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>📥</span> Alat Masuk
                </a>
                <a href="index.php?page=data_user" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'data_user' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>👥</span> Kelola User
                </a>
                <a href="index.php?page=kategori" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'kategori' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>📁</span> Kelola Kategori
                </a>
                <a href="index.php?page=data_alat" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'data_alat' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>🛠️</span> Kelola Alat
                </a>
                <a href="index.php?page=peminjaman" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'peminjaman' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>📤</span> Peminjaman
                </a>
                <a href="index.php?page=pengembalian" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'pengembalian' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>🔙</span> Pengembalian
                </a>
                <a href="index.php?page=log_aktifitas" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors hover:bg-hover <?= $page == 'log_aktifitas' ? 'bg-hover border-l-4 border-indigo-500' : '' ?>">
                    <span>📝</span> Log Aktifitas
                </a>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <a href="../logout.php" onclick="return confirm('Yakin ingin keluar?');" class="flex items-center justify-center gap-2 w-full px-4 py-3 text-red-400 bg-red-400/10 hover:bg-red-500 hover:text-white rounded-lg transition-colors font-semibold">
                    <span>🚪</span> Log Out
                </a>
            </div>
        </aside>

        <div id="overlay" class="fixed inset-0 bg-black/50 z-10 hidden md:hidden"></div>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="md:hidden bg-white shadow-sm flex items-center justify-between p-4 z-0">
                <h1 class="text-lg font-bold text-slate-800 tracking-wide">Admin Panel</h1>
                <button id="openSidebar" class="p-2 bg-slate-100 rounded-md hover:bg-slate-200">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-8">
                <?php
                $file = $page . ".php";

                if (file_exists($file)) {
                    include $file; 
                } else {
                    echo "
                    <div class=\"bg-red-50 border-l-4 border-red-500 text-red-700 p-6 rounded-r-lg shadow-sm\">
                        <h3 class=\"text-xl font-bold mb-2\">Ups! Halaman tidak ditemukan.</h3>
                        <p class=\"text-red-600\">Sistem tidak bisa menemukan file <strong class=\"font-mono bg-red-100 px-1\">$file</strong> di dalam folder admin.</p>
                    </div>";
                }
                ?>
            </main>
        </div>

    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        openBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        const
    closeSidebar = () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            };
        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);
    </script>
</body>
</html>