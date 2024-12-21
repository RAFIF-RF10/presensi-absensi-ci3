<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('/assets/image/logo.png'); ?>" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <form action="<?= site_url('Ijin_controller/set_status'); ?>" method="POST" enctype="multipart/form-data" id="absensiForm" class="mt-4 space-y-4">
                <input type="hidden" id="statusField" name="status" value="">

                <!-- Bagian Upload File -->
                <div id="file-upload-section" class="hidden space-y-2">
                    <label for="bukti" class="block text-gray-800 font-medium">Unggah Bukti (Gambar/PDF)</label>
                    <input type="file" id="bukti" name="bukti" accept="image/*,application/pdf"
                           onchange="validateFile()" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                    <p id="fileError" class="text-red-500 text-sm hidden">Harap pilih file untuk diunggah.</p>
                </div>

                <!-- Tombol Kirim -->
                <div id="submit-button-section" class="hidden mt-4">
                    <button type="submit" 
                            class="w-full sm:w-auto px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Kirim
                    </button>
                </div>

                <!-- Tombol Status -->
              <!-- Tombol Masuk -->
<button type="button" onclick="handleAbsensi('masuk')" 
        class="w-full sm:w-auto px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
    Masuk
</button>

<!-- Tombol Izin -->
<button type="button" onclick="handleAbsensi('izin')" 
        class="w-full sm:w-auto px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
    Izin
</button>

<!-- Tombol Sakit -->
<button type="button" onclick="handleAbsensi('sakit')" 
        class="w-full sm:w-auto px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
    Sakit
</button>

<!-- Tombol Dispen -->
<button type="button" onclick="handleAbsensi('dispen')" 
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
                <?php $foto = $this->session->userdata('siswa_foto') ?: '/assets/image/profil.png'; ?>
                <img src="<?= base_url($foto); ?>" 
                    alt="Foto Siswa" 
                    class="w-64 h-64 rounded-full object-cover shadow-lg border-4 border-blue-500 mx-auto">
                <p class="mt-4 font-semibold text-gray-800"><?= $this->session->userdata('siswa_nama'); ?></p>

                <button onclick="toggleModal()" 
                        class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    Edit Foto Profil
                </button>
            </div>
        </div>
    </main>

    <!-- Modal Edit Foto -->
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

    <!-- JavaScript -->
    <script>
        function toggleModal() {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden');
        }

		function handleAbsensi(status) {
    if (status === 'masuk') {
        // Jika status adalah "Masuk", langsung kirim tanpa memerlukan file bukti
        const formData = new FormData();
        formData.append('status', status);

        fetch('<?= site_url('Ijin_controller/set_status'); ?>', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Terjadi kesalahan pada server.');
            }
            return response.text();
        })
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Absensi "Masuk" berhasil dicatat.',
            }).then(() => location.reload()); // Refresh halaman setelah berhasil
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: error.message,
            });
        });
    } else {
        // Jika status bukan "Masuk", tampilkan form untuk upload file bukti
        const fileUploadSection = document.getElementById('file-upload-section');
        const submitButtonSection = document.getElementById('submit-button-section');
        const statusField = document.getElementById('statusField');

        statusField.value = status;
        fileUploadSection.classList.remove('hidden');
        submitButtonSection.classList.add('hidden'); // Sembunyikan tombol Kirim dulu
    }
}

    function validateFile() {
        const fileInput = document.getElementById('bukti');
        const fileError = document.getElementById('fileError');
        const submitButtonSection = document.getElementById('submit-button-section');

        if (fileInput.files.length) {
            fileError.classList.add('hidden'); // Sembunyikan error jika ada file
            submitButtonSection.classList.remove('hidden'); // Tampilkan tombol Kirim
        } else {
            fileError.classList.remove('hidden'); // Tampilkan error jika file kosong
            submitButtonSection.classList.add('hidden'); // Sembunyikan tombol Kirim
        }
    }
	        <?php if ($this->session->flashdata('message')): ?>
        Swal.fire({
            icon: '<?= $this->session->flashdata('alert_type'); ?>',
            title: '<?= $this->session->flashdata('alert_type') === 'success' ? 'Berhasil' : 'Info'; ?>',
            text: '<?= $this->session->flashdata('message'); ?>',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        <?php endif; ?>
    </script>
</body>
</html>
