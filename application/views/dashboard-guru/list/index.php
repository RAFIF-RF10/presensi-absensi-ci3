<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('/assets/css/output.css'); ?>" rel="stylesheet">
    <title>Dashboard Guru</title>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 bg-blue-600 p-5 text-white">
		<div class="row flex items-center gap-5">

			<img src="<?= base_url('/assets/image/logo.png'); ?>" alt="" width="50px">
				<h2 class="text-2xl font-semibold">Dashboard Guru</h2>
		</div>
            
                <!-- Sidebar Navigation -->
<ul class="mt-8 space-y-2" id="sidebar">
    <li id="dataSiswaBtn">
        <button onclick="toggleSection('dataSiswaContent')">Data Siswa</button>
    </li>
    <li id="absensiHariIniBtn">
        <button onclick="toggleSection('absensiHariIniContent')">Absensi Hari Ini</button>
    </li>
    <li id="verifikasiAbsenBtn">
        <button onclick="toggleSection('verifikasiAbsenContent')">Verifikasi Absen</button>
    </li>
    <li id="dataSeluruhSiswaBtn" class="active">
        <button onclick="toggleSection('dataSeluruhSiswaContent')">Data Seluruh Siswa</button>
    </li>

                <li>
                    <a href="<?= site_url('Login_controller_guru/logout'); ?>" class="block py-2 px-3 bg-blue-600 hover:bg-red-500 transition duration-100 text-white rounded">Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-auto">
            <!-- Data Siswa -->
            <div id="dataSiswaContent" class="block">
                <h1 class="text-3xl font-semibold mb-6">Data Siswa</h1>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <!-- <th class="px-4 py-2 text-left">ID</th> -->
                                <th class="px-4 py-2 text-left">Nama</th>
                                <th class="px-4 py-2 text-left">Kelas</th>
                                <th class="px-4 py-2 text-left">PIN</th>
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($siswa)): ?>
                                <?php foreach ($siswa as $row): ?>
                                    <tr>
                                        <!-- <td class="px-4 py-2"><?= $row->id; ?></td> -->
                                        <td class="px-4 py-2"><?= $row->nama; ?></td>
                                        <td class="px-4 py-2"><?= $row->kelas; ?></td>
                                        <td class="px-4 py-2"><?= $row->pin; ?></td>
                                        <td class="px-4 py-2">
                                            <a href="<?= site_url('list_controller/edit/'.$row->id); ?>" class="text-blue-600 hover:underline">Edit</a>
                                            <a href="<?= site_url('list_controller/hapus/'.$row->id); ?>" class="text-red-600 hover:underline ml-4">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center">Tidak ada data siswa.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Absensi Hari Ini -->
            <div id="absensiHariIniContent" class="hidden">
                <h1 class="text-3xl font-semibold mb-6">Absensi Hari Ini</h1>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <!-- <th class="px-4 py-2 text-left">ID</th> -->
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Nama</th>
                                <th class="px-4 py-2 text-left">Kelas</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($absensi_today)): ?>
                                <?php foreach ($absensi_today as $absensi): ?>
                                    <tr>
                                        <!-- <td class="px-4 py-2"><?= $absensi->id; ?></td> -->
                                        <td class="px-4 py-2"><?= $absensi->tanggal; ?></td>
                                        <td class="px-4 py-2"><?= $absensi->nama; ?></td>
                                        <td class="px-4 py-2"><?= $absensi->kelas; ?></td>
                                        <td class="px-4 py-2"><?= $absensi->status; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center">Tidak ada absensi hari ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Verifikasi Absen -->
            <div id="verifikasiAbsenContent" class="hidden">
                <h1 class="text-3xl font-semibold mb-6">Verifikasi Absen</h1>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">Nama</th>
                                <th class="px-4 py-2 text-left">Kelas</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pending_list)): ?>
                                <?php foreach ($pending_list as $pending): ?>
                                    <tr>
                                        <td class="px-4 py-2"><?= $pending->id; ?></td>
                                        <td class="px-4 py-2"><?= $pending->tanggal; ?></td>
                                        <td class="px-4 py-2"><?= $pending->nama; ?></td>
                                        <td class="px-4 py-2"><?= $pending->kelas; ?></td>
                                        <td class="px-4 py-2"><?= $pending->status; ?></td>
                                        <td class="px-4 py-2">
                                            <a href="<?= site_url('dashboard_guru/setuju/'.$pending->id); ?>" class="text-blue-600 hover:underline">Setuju</a>
                                            <a href="<?= site_url('dashboard_guru/tolak/'.$pending->id); ?>" class="text-red-600 hover:underline ml-4">Tolak</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center">Tidak ada data persetujuan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

			<div id="dataSeluruhSiswaContent" class="w-3/4 p-6 hidden">
        <h1 class="text-3xl font-semibold mb-6">Rekap Absensi Siswa</h1>

        <!-- Formulir untuk Filter -->
		<form method="GET" action="<?= site_url('list_controller/rekap_absensi'); ?>" id="filterForm">

            <div class="space-y-4">
                <!-- Pilihan Bulan -->
                <div>
                    <label for="bulan" class="block mb-2 font-medium text-gray-700">Pilih Bulan:</label>
                    <select name="bulan" id="bulan" class="block w-full p-2 border rounded-md">
                        <option value="">Semua Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <!-- Pilihan Kelas -->
                <div>
                    <label for="kelas" class="block mb-2 font-medium text-gray-700">Pilih Kelas:</label>
                    <select name="kelas" id="kelas" class="block w-full p-2 border rounded-md">
                        <option value="">Semua Kelas</option>
                        <option value="XII RPL 1">XII RPL 1</option>
                        <option value="XII RPL 2">XII RPL 2</option>
                        <option value="XI RPL 1">XI RPL 1</option>
                        <option value="XI RPL 2">XI RPL 2</option>
                        <!-- Tambahkan kelas lainnya -->
                    </select>
                </div>

                <!-- Tombol Filter -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md" id="filterButton">Filter</button>
            </div>
        </form>

        <!-- Hasil Filter -->
		<div id="dataSeluruhSiswaContent" class="w-3/4 p-6">
    <h1 class="text-3xl font-semibold mb-6">Rekap Absensi Siswa</h1>

  <!-- Tabel untuk Menampilkan Rekap Absensi -->
<table class="table-auto w-full border border-gray-300 mt-6">
    <thead>
        <tr class="bg-gray-100">
            <th class="py-2 px-4 text-left">Nama</th>
            <th class="py-2 px-4 text-left">Kelas</th>
            <th class="py-2 px-4 text-left">Status</th>
            <th class="py-2 px-4 text-left">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rekap_absensi)) : ?>
            <?php foreach ($rekap_absensi as $absensi) : ?>
                <tr>
                    <td><?= htmlspecialchars($absensi->nama); ?></td>
                    <td><?= htmlspecialchars($absensi->kelas); ?></td>
                    <td><?= htmlspecialchars($absensi->status); ?></td>
                    <td><?= date('d-m-Y', strtotime($absensi->tanggal)); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4" class="text-center py-2 px-4">Tidak ada data absensi untuk kriteria yang dipilih.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


</div>

    </div>
</div>
    
<script>
   // Fungsi untuk menyimpan ID section aktif ke localStorage
function setActiveSection(sectionId) {
    localStorage.setItem('activeSection', sectionId); // Simpan ID aktif di localStorage
}

// Fungsi untuk toggle section berdasarkan ID yang dipilih
function toggleSection(visibleId) {
    const sections = ['dataSiswaContent', 'absensiHariIniContent', 'verifikasiAbsenContent', 'dataSeluruhSiswaContent'];
    
    // Sembunyikan semua section dan tampilkan hanya section yang diinginkan
    sections.forEach(id => {
        document.getElementById(id).classList.toggle('hidden', id !== visibleId);
    });

    // Simpan status aktif ke localStorage
    setActiveSection(visibleId);
}

// Saat halaman dimuat, cek localStorage dan set section aktif
document.addEventListener('DOMContentLoaded', () => {
    const activeSection = localStorage.getItem('activeSection') || 'dataSeluruhSiswaContent'; // Default ke Data Seluruh Siswa
    toggleSection(activeSection);
});

</script>


</body>
</html>
