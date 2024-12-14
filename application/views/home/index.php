<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?= base_url('/assets/image/logo.png'); ?>" type="image/x-icon">
    <title>Halaman Utama</title>
    <link href="<?= base_url('/assets/css/output.css'); ?>" rel="stylesheet">
</head>
<body class="bg-gradient-to-tr from-cyan-100 to-gray-300 relative">
    <section class="flex items-center justify-center overflow-hidden w-screen h-screen relative">
        <!-- Background Decorative Images -->
        <img src="<?= base_url('/assets/image/book.png'); ?>" 
             alt="Decorative Right" 
             class="absolute  -right-1 bottom-10  opacity-70 transform -rotate-12" width="200px" >
        <img src="<?= base_url('/assets/image/absen.png'); ?>" 
             alt="Decorative left" 
             class="absolute left-10 top-8 opacity-50 transform rotate-12" width="200px">

        <!-- Content Container -->
        <div class="absolute bg-gradient-to-tr from-slate-200 to-slate-100 bg-opacity-90 rounded-lg p-10 shadow-xl z-10 text-center space-y-6">
            <div class="justify-center flex">
                <img src="<?= base_url('/assets/image/logo.png'); ?>" alt="" width="200px">
            </div>
            <h1 class="text-4xl font-extrabold text-gray-800">Selamat Datang</h1>
            <h1 class="text-4xl font-extrabold text-gray-800 leading-tight">Absensi SMKN 8 JEMBER</h1>
            <p class="text-lg text-gray-600">Pilih sebagai <span class="font-semibold text-blue-600">Siswa</span> atau <span class="font-semibold text-green-600">Guru</span> untuk melanjutkan.</p>

            <div class="space-x-4">
                <a href="<?= site_url('Home_controller/login_siswa'); ?>"
                   class="px-6 py-3 text-white bg-[#0D6EFD] hover:bg-blue-600 rounded-lg shadow-md transition transform hover:scale-105">
                    Siswa
                </a>
                <a href="<?= site_url('Home_controller/login_guru'); ?>"
                   class="px-6 py-3 text-white bg-green-500 hover:bg-green-600 rounded-lg shadow-md transition transform hover:scale-105">
                    Guru
                </a>
            </div>
        </div>
    </section>
</body>
</html>
