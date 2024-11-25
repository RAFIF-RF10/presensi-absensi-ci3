<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('/assets/css/output.css'); ?>" rel="stylesheet">
    <title>Dashboard Siswa</title>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-600 text-white py-4 px-8 shadow-md flex items-center space-x-4">
        <img src="<?= base_url('/assets/image/logo.png'); ?>" alt="Logo" width="40px" class="inline-block">
        <h1 class="text-2xl font-bold">Absensi Siswa</h1>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow flex flex-wrap lg:flex-nowrap px-8 py-6 space-y-6 lg:space-y-0 lg:space-x-8">
        <!-- Bagian Kiri -->
        <div class="w-full lg:w-2/3">
            <h1 class="text-4xl text-blue-600 leading-relaxed">Selamat datang, <span class="font-semibold"><?= $this->session->userdata('siswa_nama'); ?></span></h1>
            <h2 class="text-xl font-semibold text-gray-800">Absensi Hari Ini</h2>
            <p class="text-gray-600 mt-2">Silakan pilih status absensi Anda:</p>

            <!-- Form Absensi -->
            <form action="<?= site_url('Ijin_controller/set_status'); ?>" method="POST" class="mt-4 space-y-4">
                <button type="submit" name="status" value="masuk" 
                    class="w-full sm:w-auto px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    Masuk
                </button>
                <button type="submit" name="status" value="izin" 
                    class="w-full sm:w-auto px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                    Izin
                </button>
                <button type="submit" name="status" value="sakit" 
                    class="w-full sm:w-auto px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                    Sakit
                </button>
                <button type="submit" name="status" value="dispen" 
                    class="w-full sm:w-auto px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Dispen
                </button>
            </form>

            <!-- Tombol Logout -->
            <a href="<?= site_url('Login_controller_siswa/logout'); ?>" 
               class="block mt-6 text-blue-600 font-medium hover:underline">
                Logout
            </a>
        </div>

        <!-- Bagian Kanan -->
        <div class="w-full lg:w-1/3 flex justify-center items-center">
            <div class="relative text-center">
                <!-- Cek apakah ada foto profil -->
                <?php $foto = $this->session->userdata('siswa_foto') ?: '/assets/image/profil.png'; ?>
                <img src="<?= base_url($foto); ?>" 
                     alt="Foto Siswa" 
                     class="w-64 h-64 rounded-full object-cover shadow-lg border-4 border-blue-500 mx-auto">
                <p class="mt-4 font-semibold text-gray-800"><?= $this->session->userdata('siswa_nama'); ?></p>

                <!-- Tombol Edit Foto -->
                <button onclick="toggleModal()" 
                        class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    Edit Foto Profil
                </button>
            </div>
        </div>
    </main>

    <!-- Modal untuk Edit Foto -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 shadow-lg w-80">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Edit Foto Profil</h2>
            <form action="<?= site_url('Dashboard_siswa/upload_foto'); ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="siswa_foto" accept="image/*" class="block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" onclick="toggleModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 text-gray-700 text-sm py-4 px-8 text-center shadow-inner">
        &copy; <?= date('Y'); ?> SMKN 8 Jember. All rights reserved.
    </footer>

    <!-- Alert untuk Flashdata -->
    <?php if ($this->session->flashdata('message')) : ?>
        <div id="success-alert" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
			
            <div class="bg-gray-800 text-blue-500 rounded-lg p-6 shadow-lg w-96 text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-12 h-12 bg-green-100 text-green-500 flex items-center justify-center rounded-full">
					<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
<linearGradient id="I9GV0SozQFknxHSR6DCx5a_70yRC8npwT3d_gr1" x1="9.858" x2="38.142" y1="9.858" y2="38.142" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#21ad64"></stop><stop offset="1" stop-color="#088242"></stop></linearGradient><path fill="url(#I9GV0SozQFknxHSR6DCx5a_70yRC8npwT3d_gr1)" d="M44,24c0,11.045-8.955,20-20,20S4,35.045,4,24S12.955,4,24,4S44,12.955,44,24z"></path><path d="M32.172,16.172L22,26.344l-5.172-5.172c-0.781-0.781-2.047-0.781-2.828,0l-1.414,1.414	c-0.781,0.781-0.781,2.047,0,2.828l8,8c0.781,0.781,2.047,0.781,2.828,0l13-13c0.781-0.781,0.781-2.047,0-2.828L35,16.172	C34.219,15.391,32.953,15.391,32.172,16.172z" opacity=".05"></path><path d="M20.939,33.061l-8-8c-0.586-0.586-0.586-1.536,0-2.121l1.414-1.414c0.586-0.586,1.536-0.586,2.121,0	L22,27.051l10.525-10.525c0.586-0.586,1.536-0.586,2.121,0l1.414,1.414c0.586,0.586,0.586,1.536,0,2.121l-13,13	C22.475,33.646,21.525,33.646,20.939,33.061z" opacity=".07"></path><path fill="#fff" d="M21.293,32.707l-8-8c-0.391-0.391-0.391-1.024,0-1.414l1.414-1.414c0.391-0.391,1.024-0.391,1.414,0	L22,27.758l10.879-10.879c0.391-0.391,1.024-0.391,1.414,0l1.414,1.414c0.391,0.391,0.391,1.024,0,1.414l-13,13	C22.317,33.098,21.683,33.098,21.293,32.707z"></path>
</svg>

                    </div>
                </div>
                <p class="text-lg font-semibold mb-2"><?= $this->session->flashdata('message'); ?></p>
                <button onclick="closeAlert()" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    OK!
                </button>
            </div>
        </div>
    <?php endif; ?>

    <!-- JavaScript untuk Modal dan Alert -->
    <script>
        function toggleModal() {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden');
        }

        function closeAlert() {
            const alert = document.getElementById('success-alert');
            alert.remove(); // Menghapus alert dari DOM
        }
    </script>
</body>
</html>
