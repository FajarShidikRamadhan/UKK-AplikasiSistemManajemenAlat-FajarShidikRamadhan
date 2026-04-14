<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Peminjaman Alat</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1', // Indigo modern
                        secondary: '#7e22ce', // Ungu (seperti dashboard peminjam)
                        dark: '#1e293b', // Slate
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <div class="flex min-h-screen">

        <div class="hidden md:flex w-1/2 bg-gradient-to-br from-primary to-secondary text-white p-12 flex-col justify-between">

            <div class="flex items-center gap-2 font-bold text-xl tracking-wide">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                PinjamAlat.
            </div>

            <div class="max-w-md">
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-6">
                    Kelola Inventaris & Peminjaman Lebih Mudah.
                </h1>
                <p class="text-indigo-100 text-lg mb-8 leading-relaxed">
                    Sistem informasi peminjaman alat terintegrasi. Cek ketersediaan katalog, ajukan peminjaman, dan pantau status barang Anda secara real-time.
                </p>

                <div class="space-y-4 text-sm font-medium text-indigo-50">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg></div>
                        <span>Katalog Alat Lengkap & Real-time</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg></div>
                        <span>Persetujuan Otomatis dari Admin</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg></div>
                        <span>Pelacakan Riwayat Transparan</span>
                    </div>
                </div>
            </div>

            <div class="text-sm text-indigo-200">
                &copy; 2026 Sistem Peminjaman Alat. Dibuat untuk produktivitas.
            </div>
        </div>

        <div class="w-full md:w-1/2 flex items-center justify-center p-8 sm:p-12">
            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl md:shadow-none md:bg-transparent md:p-0">

                <div class="flex md:hidden items-center gap-2 font-bold text-2xl tracking-wide text-primary mb-8">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    PinjamAlat.
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang! 👋</h2>
                    <p class="text-gray-500">Pilih opsi di bawah untuk masuk ke sistem peminjaman.</p>
                </div>

                <div class="space-y-5">
                    <a href="login/login.php"
                        class="flex items-center justify-center w-full bg-primary hover:bg-indigo-700 text-white font-bold py-4 px-4 rounded-xl transition-all shadow-lg hover:shadow-indigo-500/30 transform hover:-translate-y-0.5 text-lg">
                        Masuk
                    </a>

                </div>

                <p class="text-center text-gray-400 mt-12 text-sm">
                    Aplikasi ini menggunakan sistem multi-role <br>(Admin, Petugas, Peminjam)
                </p>

            </div>

            <div class="my-8 flex items-center justify-center">
                <span class="w-full border-b border-gray-200"></span>
                <span class="px-4 text-sm text-gray-400">Atau</span>
                <span class="w-full border-b border-gray-200"></span>
            </div>

            <div class="text-center">
                <p class="text-gray-600 mb-4">Belum memiliki akun peminjam?</p>
                <a href="registrasi/Registrasi.php"
                    class="block w-full border-2 border-gray-200 text-gray-700 font-bold py-3 px-4 rounded-lg hover:border-primary hover:text-primary transition-colors bg-gray-50">
                    Buat Akun Baru
                </a>
            </div>

        </div>
    </div>

    </div>
</body>

</html>