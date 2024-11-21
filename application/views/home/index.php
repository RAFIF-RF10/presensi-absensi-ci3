<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link href="<?= base_url('/assets/css/output.css'); ?>" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col justify-center items-center h-screen">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Sebagai apakah anda?</h1>
        <div class="space-y-4">
            <a href="<?= site_url('Home_controller/login_siswa'); ?>" 
               class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                Siswa
            </a>
            <br>
            <a href="<?= site_url('Home_controller/login_guru'); ?>" 
               class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                Guru
            </a>
        </div>
    </div>
</body>
</html>
