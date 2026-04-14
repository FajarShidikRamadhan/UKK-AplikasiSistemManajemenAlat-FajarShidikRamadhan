<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Peminjaman Alat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#7e22ce'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4 relative">

    <a href="landing.php" title="Kembali ke Beranda"
        class="absolute top-6 left-6 md:top-8 md:left-8 bg-white p-3 rounded-full shadow-md text-gray-500 hover:text-primary hover:shadow-lg hover:-translate-y-1 transition-all z-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
    </a>

    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl w-full max-w-2xl my-8 border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
            <p class="text-gray-500 mt-2">Daftar untuk mulai mengakses sistem peminjaman.</p>
        </div>

        <form action="Proses_Registrasi.php" method="POST" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">ID User <span class="text-red-500">*</span></label>
                    <input type="text" name="iduser" required maxlength="15"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
                        placeholder="Cth: 10293847">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                    <input type="text" name="username" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
                        placeholder="Cth: fajar123">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="namalengkap" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
                        placeholder="Cth: Fajar Shidik">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Identitas <span class="text-red-500">*</span></label>
                    <input type="text" name="identitas" required maxlength="155"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
                        placeholder="Cth: Siswa / Mahasiswa / Guru">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No HP / WA <span class="text-red-500">*</span></label>
                    <input type="text" name="nohp" required maxlength="15" inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
                        placeholder="0812...">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required maxlength="15"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors">
                </div>

            </div>
            <div class="mt-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Daftar Sebagai (Role) <span class="text-red-500">*</span></label>
                <select name="role" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors bg-white cursor-pointer">
                    <option value="" hidden></option>    
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="peminjam">Peminjam</option>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-indigo-700 text-white font-bold py-4 px-4 rounded-xl shadow-lg mt-8 transition-all hover:-translate-y-1 hover:shadow-indigo-500/30">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-gray-600 mt-8 text-sm">
            Sudah punya akun? <a href="../Login/login.php" class="text-primary font-bold hover:underline transition-colors">Login di sini</a>
        </p>
    </div>

</body>

</html>