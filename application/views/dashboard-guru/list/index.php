<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="<?= base_url('/assets/css/output.css'); ?>" rel="stylesheet">
	<link rel="icon" href="<?= base_url('/assets/image/logo.png'); ?>" type="image/x-icon">

	<title>Dashboard Guru</title>
</head>

<body class="bg-gray-100">
	<div class="flex h-screen">
		<!-- Sidebar -->
		<div class="w-1/4 fixed h-[100Vh] bg-blue-600 p-5 text-white">
			<div class="row flex items-center gap-5">

				<img src="<?= base_url('/assets/image/logo.png'); ?>" alt="" width="50px">
				<h2 class="text-2xl font-semibold">Dashboard Guru</h2>
			</div>

			<!-- Sidebar Navigation -->
			<ul class="mt-8 space-y-2" id="sidebar">
				<li id="dataSiswaBtn" class="block w-full text-left py-2 px-3 hover:bg-blue-500 rounded">
					<button onclick="toggleSection('dataSiswaContent')">Data Siswa</button>
				</li>
				<li id="absensiHariIniBtn" class="block w-full text-left py-2 px-3 hover:bg-blue-500 rounded"">
        		<button onclick=" toggleSection('absensiHariIniContent')">Absensi Hari Ini</button>
				</li>
				<li id="verifikasiAbsenBtn" class="block w-full text-left py-2 px-3 hover:bg-blue-500 rounded">
					<button onclick="toggleSection('verifikasiAbsenContent')">Verifikasi Absen</button>
				</li>
				<li id="dataSeluruhSiswaBtn" class="active block w-full text-left py-2 px-3 hover:bg-blue-500 rounded">
					<button onclick="toggleSection('dataSeluruhSiswaContent')">Rekap Absensi Siswa</button>
				</li>

				<li>
					<a href="<?= site_url('Login_controller_guru/logout'); ?>" class="block py-2 px-3 bg-blue-600 hover:bg-red-500 transition duration-100 text-white rounded">Logout</a>
				</li>
			</ul>
		</div>

		<!-- Main Content -->
		<div class="pl-[350px] p-8">
			<!-- Data Siswa -->
			<div id="dataSiswaContent" class="block w-full">
				<div class="bg-blue-500 w-[68vw] mb-6 rounded-lg shadow-lg p-8">
					<h3 class="text-xl font-bold text-white">Selamat datang, <?= $this->session->userdata('guru_nama'); ?> </h3>
				</div>

				<!-- Nama Guru -->
				<h1 class="text-3xl font-semibold mb-6">Data Siswa</h1>

				<!-- Dropdown untuk Filter Kelas -->
				<div class="bg-white shadow-md rounded-lg p-6 mb-6 max-w-full mx-auto">
					<label for="kelas" class="block text-gray-700 font-semibold mb-2">Pilih Kelas:</label>
					<select id="kelas" class="w-full p-2 border border-gray-300 rounded">
						<option value="">Semua Kelas</option>
						<option value="XII RPL 1">XII RPL 1</option>
						<option value="XII RPL 2">XII RPL 2</option>
						<option value="XI RPL 1">XI RPL 1</option>
						<option value="XI RPL 2">XI RPL 2</option>
						<option value="X RPL 1">X RPL 1</option>
						<option value="X RPL 2">X RPL 2</option>
						<option value="XI DKV 1">XI DKV 1</option>
						<option value="XI DKV 2">XI DKV 2</option>
					</select>
					<button onclick="filterDataByKelas()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
						Tampilkan Data
					</button>
				</div>

				<!-- Tabel Data Siswa -->
				<div class="bg-white shadow-md rounded-lg p-6 max-w-full mx-auto">
					<table class="min-w-full table-auto">
						<thead>
							<tr>
								<th class="px-4 py-2 text-left">Nama</th>
								<th class="px-4 py-2 text-left">Kelas</th>
								<th class="px-4 py-2 text-left">PIN</th>
								<th class="px-4 py-2 text-left">Aksi</th>
							</tr>
						</thead>
						<tbody id="dataContainer">
							<?php foreach ($siswa as $row): ?>
								<tr>
									<td class="px-4 py-2"><?= $row->nama; ?></td>
									<td class="px-4 py-2"><?= $row->kelas; ?></td>
									<td class="px-4 py-2"><?= $row->pin; ?></td>
									<td class="px-4 py-2">
										<a href="javascript:void(0);" onclick="editData(<?= $row->id; ?>)" class="text-blue-600 hover:underline">Edit</a>
										<a href="javascript:void(0);" onclick="deleteData(<?= $row->id; ?>)" class="text-red-600 hover:underline ml-4">Hapus</a>
									</td>
								</tr>
							<?php endforeach; ?>
							<?php if (empty($siswa)): ?>
								<tr>
									<td colspan="4" class="text-center">Tidak ada data siswa.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>

				<!-- Form Tambah Siswa -->
				<div class="bg-white shadow-md rounded-lg p-6 mt-6 max-w-full mx-auto">
					<h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Siswa</h1>
					<form action="<?= site_url('list_controller/simpan'); ?>" method="post" class="space-y-4">
						<!-- Nama -->
						<div>
							<label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
							<input type="text" id="nama" name="nama" required
								class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
								placeholder="Masukkan nama siswa">
						</div>

						<!-- Kelas -->
						<div>
							<label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
							<input type="text" id="kelas" name="kelas" required
								class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
								placeholder="Masukkan kelas siswa">
						</div>

						<!-- Tombol Simpan -->
						<div>
							<button type="submit"
								class="w-full bg-blue-500 text-white py-2 px-4 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
								Simpan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Absensi Hari Ini -->
		<div id="absensiHariIniContent" class="hidden p-6 w-full lg:w-10/12 ml-4">
			<h1 class="text-3xl font-semibold mb-6 text-gray-800">Absensi Hari Ini</h1>
			<div class="bg-white shadow-md rounded-lg p-6 mb-6 max-w-full mx-auto">
				<label for="kelas" class="block text-gray-700 font-semibold mb-2">Pilih Kelas:</label>
				<select id="kelasAbsensi" class="w-full p-2 border border-gray-300 rounded">
					<option value="">Semua Kelas</option>
					<option value="XII RPL 1">XII RPL 1</option>
					<option value="XII RPL 2">XII RPL 2</option>
					<option value="XI RPL 1">XI RPL 1</option>
					<option value="XI RPL 2">XI RPL 2</option>
					<option value="X RPL 1">X RPL 1</option>
					<option value="X RPL 2">X RPL 2</option>
					<option value="XI DKV 1">XI DKV 1</option>
					<option value="XI DKV 2">XI DKV 2</option>
				</select>
				<button onclick="filterDataAbsensiHari()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
					Tampilkan Data
				</button>
			</div>

			<div class="bg-white shadow-lg rounded-lg p-6">
				<table class="min-w-full table-auto border-collapse border border-gray-300 rounded-lg">
					<thead>
						<tr class="bg-blue-500 text-white">
							<th class="px-6 py-3 text-left font-semibold">Tanggal</th>
							<th class="px-6 py-3 text-left font-semibold">Nama</th>
							<th class="px-6 py-3 text-left font-semibold">Kelas</th>
							<th class="px-6 py-3 text-left font-semibold">Status</th>
						</tr>
					</thead>
					<tbody id="dataContainerAbsen">
						<?php if (!empty($absensi_today)): ?>
							<?php foreach ($absensi_today as $absensi): ?>
								<tr class="hover:bg-gray-100">
									<td class="px-6 py-3 border border-gray-300"><?= $absensi->tanggal; ?></td>
									<td class="px-6 py-3 border border-gray-300"><?= $absensi->nama; ?></td>
									<td class="px-6 py-3 border border-gray-300"><?= $absensi->kelas; ?></td>
									<td class="px-6 py-3 border border-gray-300">
										<span class="px-3 py-1 rounded-full text-white font-semibold 
                                <?php
								switch ($absensi->status) {
									case 'masuk':
										echo 'bg-green-500';
										break;
									case 'izin':
										echo 'bg-yellow-500';
										break;
									case 'sakit':
										echo 'bg-yellow-500';
										break;
									case 'alpa':
										echo 'bg-red-500';
										break;
									case 'dispen':
										echo 'bg-blue-500';
										break;
									default:
										echo 'bg-gray-500';
										break;
								}
								?>">
											<?= ucfirst($absensi->status); ?>
										</span>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="4" class="px-6 py-3 text-center text-gray-500 border border-gray-300">
									Tidak ada absensi hari ini.
								</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Verifikasi Absen -->
		<div id="verifikasiAbsenContent" class="hidden w-3/4 p-8">
			<h1 class="text-3xl font-semibold mb-6">Verifikasi Absen</h1>

			<!-- Dropdown Kelas -->
			<div class="bg-white shadow-md rounded-lg p-6 mb-6 max-w-full mx-auto">
				<label for="kelas" class="block text-gray-700 font-semibold mb-2">Pilih Kelas:</label>
				<select id="verifikasiKelas" class="w-full p-2 border border-gray-300 rounded">
					<option value="">Semua Kelas</option>
					<option value="XII RPL 1">XII RPL 1</option>
					<option value="XII RPL 2">XII RPL 2</option>
					<option value="XI RPL 1">XI RPL 1</option>
					<option value="XI RPL 2">XI RPL 2</option>
					<option value="X RPL 1">X RPL 1</option>
					<option value="X RPL 2">X RPL 2</option>
					<option value="XI DKV 1">XI DKV 1</option>
					<option value="XI DKV 2">XI DKV 2</option>
				</select>
				<button onclick="verifikasiNama()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
					Tampilkan Data
				</button>
			</div>


			<div class="bg-white shadow-md rounded-lg p-6">
				<table class="min-w-full table-auto">
					<thead>
						<tr>
							<th class="px-4 py-2 text-left">Tanggal</th>
							<th class="px-4 py-2 text-left">Nama</th>
							<th class="px-4 py-2 text-left">Kelas</th>
							<th class="px-4 py-2 text-left">Status</th>
							<th class="px-4 py-2 text-left">Aksi</th>
						</tr>
					</thead>
					<tbody id="dataController">
						<?php if (!empty($pending_list)): ?>
							<?php foreach ($pending_list as $pending): ?>
								<tr>
									<td class="px-4 py-2"><?= date('d-m-Y', strtotime($pending->tanggal)); ?></td>
									<td class="px-4 py-2"><?= $pending->nama; ?></td>
									<td class="px-4 py-2"><?= $pending->kelas; ?></td>
									<td class="px-4 py-2"><?= $pending->status; ?></td>
									<td class="px-4 py-2">
										<button
											class="text-blue-600 hover:underline"
											onclick="handleApproval(<?= $pending->id; ?>, 'setuju')">
											Setuju
										</button>
										<button
											class="text-red-600 hover:underline ml-4"
											onclick="handleApproval(<?= $pending->id; ?>, 'tolak')">
											Tolak
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="5" class="px-4 py-2 text-center">Tidak ada data persetujuan.</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Menutup div #verifikasiAbsenContent -->

		<div id="dataSeluruhSiswaContent" class="w-3/4 p-8 hidden">
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
							<option value="X RPL 1">X RPL 1</option>
							<option value="X RPL 2">X RPL 2</option>
							<option value="XI DKV 1">XI DKV 1</option>
							<option value="XI DKV 2">XI DKV 2</option>
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
				<table class="w-[50vw] bg-white border border-gray-300 rounded-lg shadow-md mt-6">
					<thead class="bg-gray-100">
						<tr>
							<th class="py-3 px-6 text-left font-semibold text-gray-700">Nama</th>
							<th class="py-3 px-6 text-left font-semibold text-gray-700">Kelas</th>
							<th class="py-3 px-6 text-left font-semibold text-gray-700">Status</th>
							<th class="py-3 px-6 text-left font-semibold text-gray-700">Tanggal</th>
						</tr>
					</thead>
					<tbody>
						<?php if (!empty($rekap_absensi)) : ?>
							<?php foreach ($rekap_absensi as $absensi) : ?>
								<tr class="hover:bg-gray-50 transition-colors duration-200 border-t-2">
									<td class="py-3 px-6 text-gray-800"><?= htmlspecialchars($absensi->nama); ?></td>
									<td class="py-3 px-6 text-gray-800"><?= htmlspecialchars($absensi->kelas); ?></td>
									<td class="py-3 px-6  <?php
															switch ($absensi->status) {
																case 'masuk':
																	echo 'text-green-500';
																	break;
																case 'izin':
																	echo 'text-yellow-500';
																	break;
																case 'sakit':
																	echo 'text-yellow-500';
																	break;
																case 'alpa':
																	echo 'text-red-500';
																	break;
																case 'dispen':
																	echo 'text-blue-500';
																	break;
																default:
																	echo 'text-black';
																	break;
															}
															?>">
										<?= ucfirst($absensi->status); ?></td>
									<td class="py-3 px-6 text-gray-800"><?= date('d-m-Y', strtotime($absensi->tanggal)); ?></td>
								</tr>
							<?php endforeach; ?>
						<?php else : ?>
							<tr>
								<td colspan="4" class="text-center py-4 px-6 text-gray-500">Tidak ada data absensi untuk kriteria yang dipilih.</td>
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

		// Fungsi untuk mengupdate data siswa
		// Fungsi untuk menangani klik tombol Edit
		// Fungsi untuk menangani klik tombol Edit
		function editData(id) {
			// Mengambil data siswa berdasarkan ID melalui AJAX
			$.ajax({
				url: '<?= site_url('list_controller/get_siswa_by_id/'); ?>' + id, // Pastikan URL Controller benar
				method: 'GET',
				success: function(response) {
					try {
						// Parse respons JSON
						const siswa = JSON.parse(response);

						if (siswa) {
							// Menampilkan SweetAlert dengan form untuk mengedit data siswa
							Swal.fire({
								title: 'Edit Data Siswa',
								html: `
                            <input id="nama" class="swal2-input" placeholder="Nama" value="${siswa.nama}">
                            <input id="kelasInput" class="swal2-input" placeholder="Kelas" value="${siswa.kelas}">
                        `,
								showCancelButton: true,
								confirmButtonText: 'Edit',
								cancelButtonText: 'Batal',
								preConfirm: () => {
									// Mengambil nilai input dari form SweetAlert
									const nama = document.getElementById('nama').value.trim();
									const kelas = document.getElementById('kelasInput').value;
									console.log(nama, kelas)
									// Validasi jika ada field yang kosong
									if (!nama || !kelas) {
										console.log(kelas)
										Swal.showValidationMessage('Nama dan Kelas harus diisi');
										return false;
									}

									return {
										nama,
										kelas
									}; // Mengembalikan nilai nama dan kelas
								}
							}).then((result) => {
								if (result.isConfirmed) {
									const {
										nama,
										kelas
									} = result.value;

									// Memanggil fungsi untuk mengupdate data siswa
									updateData(id, nama, kelas);
								}
							});
						}
					} catch (error) {
						// Jika respons server tidak valid
						Swal.fire('Gagal!', 'Respons server tidak valid.', 'error');
					}
				},
				error: function(xhr, status, error) {
					Swal.fire('Gagal!', 'Terjadi kesalahan saat mengambil data siswa.', 'error');
				}
			});
		}

		// Fungsi untuk mengupdate data siswa
		function updateData(id, nama, kelas) {
			$.ajax({
				url: '<?= site_url('list_controller/update/'); ?>' + id, // Pastikan URL untuk update data benar
				method: 'POST',
				data: {
					nama: nama,
					kelas: kelas
				},
				success: function(response) {
					try {
						const res = JSON.parse(response);

						// Periksa apakah server memberikan respons sukses
						if (res.status === 'success') {
							Swal.fire('Berhasil!', 'Data siswa berhasil diperbarui.', 'success').then(() => {
								location.reload(); // Reload untuk memperbarui daftar siswa
							});
						} else {
							Swal.fire('Gagal!', res.message || 'Terjadi kesalahan saat menyimpan perubahan.', 'error');
						}
					} catch (error) {
						Swal.fire('Gagal!', 'Respons server tidak valid.', 'error');
					}
				},
				error: function(xhr, status, error) {
					Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan perubahan.', 'error');
				}
			});
		}

		// Fungsi untuk menghapus data siswa
		function deleteData(id) {
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Data ini akan dihapus secara permanen.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Hapus',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					// Jika pengguna mengonfirmasi, hapus data siswa
					$.ajax({
						url: '<?= site_url('list_controller/hapus/'); ?>' + id, // Pastikan ini sesuai dengan URL Controller yang benar
						method: 'GET',
						success: function(response) {
							Swal.fire('Berhasil!', 'Data berhasil dihapus!', 'success').then(() => {
								location.reload(); // Reload untuk memperbarui daftar siswa
							});
						},
						error: function(xhr, status, error) {
							Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
						}
					});
				}
			});
		}

		function filterDataByKelas() {

			const selectedKelas = document.getElementById('kelas').value;

			// Kirim request AJAX untuk mendapatkan data siswa berdasarkan kelas
			$.ajax({
				url: '<?= site_url("list_controller/get_data_by_kelas"); ?>', // Sesuaikan dengan URL controller Anda
				method: 'POST',
				data: {
					kelas: selectedKelas
				},
				beforeSend: function() {
					// Tampilkan pesan loading
					document.getElementById('dataContainer').innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
                    </tr>
                `;
				},
				success: function(response) {
					// Response adalah tabel siswa yang dikirim dari controller
					document.getElementById('dataContainer').innerHTML = response;
				},
				error: function(xhr, status, error) {
					Swal.fire('Gagal!', 'Terjadi kesalahan saat memuat data.', 'error');
				}
			});
		}

		function filterDataAbsensiHari() {
			const selectedKelas = document.getElementById('kelasAbsensi').value;

			$.ajax({
				url: '<?= site_url("list_controller/get_data_by_kelas_absensi_today"); ?>',
				method: 'POST',
				data: {
					kelas: selectedKelas
				},
				beforeSend: function() {
					// Tampilkan pesan loading
					document.getElementById('dataContainerAbsen').innerHTML = `
                <tr>
                    <td colspan="4" class="text-center">Loading...</td>
                </tr>
            `;
				},
				success: function(response) {
					// Parse JSON response
					const data = JSON.parse(response);

					// Kosongkan tabel sebelum menambahkan data baru
					const tbody = document.getElementById('dataContainerAbsen');
					tbody.innerHTML = '';

					// Jika data tersedia, tambahkan ke tabel
					if (data.length > 0) {
						data.forEach(row => {
							const tr = document.createElement('tr');
							tr.classList.add('hover:bg-gray-100');

							tr.innerHTML = `
                        <td class="px-6 py-3 border border-gray-300">${row.tanggal}</td>
                        <td class="px-6 py-3 border border-gray-300">${row.nama}</td>
                        <td class="px-6 py-3 border border-gray-300">${row.kelas}</td>
                        <td class="px-6 py-3 border border-gray-300">
                            <span class="px-3 py-1 rounded-full text-white font-semibold ${getStatusClass(row.status)}">
                                ${capitalizeFirstLetter(row.status)}
                            </span>
                        </td>
                    `;
							tbody.appendChild(tr);
						});
					} else {
						tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 border border-gray-300">
                            Tidak ada absensi hari ini.
                        </td>
                    </tr>
                `;
					}
				},
				error: function(xhr, status, error) {
					Swal.fire('Gagal!', 'Terjadi kesalahan saat memuat data.', 'error');
				}
			});
		}

		// Fungsi untuk memberikan kelas warna berdasarkan status
		function getStatusClass(status) {
			switch (status) {
				case 'masuk':
					return 'bg-green-500';
				case 'izin':
				case 'sakit':
					return 'bg-yellow-500';
				case 'alpa':
					return 'bg-red-500';
				case 'dispen':
					return 'bg-blue-500';
				default:
					return 'bg-gray-500';
			}
		}

		function capitalizeFirstLetter(string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		}

		function handleApproval(id, action) {
			const url = `<?= site_url('dashboard_guru/'); ?>` + action + '/' + id;
			const actionText = action === 'setuju' ? 'menyetujui' : 'menolak';

			Swal.fire({
				title: `Apakah Anda yakin ingin ${actionText} absensi ini?`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, Lanjutkan',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {
					fetch(url)
						.then(response => {
							if (response.ok) {
								return response.text();
							} else {
								throw new Error('Gagal memproses permintaan.');
							}
						})
						.then(() => {
							Swal.fire({
								title: 'Berhasil!',
								text: `Absensi berhasil ${actionText}.`,
								icon: 'success',
								confirmButtonText: 'OK'
							}).then(() => {
								location.reload(); // Perbarui halaman
							});
						})
						.catch(error => {
							Swal.fire({
								title: 'Error!',
								text: error.message,
								icon: 'error',
								confirmButtonText: 'OK'
							});
						});
				}
			});
		}

		function verifikasiNama() {
    const selectedKelas = document.getElementById('verifikasiKelas').value;

    $.ajax({
        url: '<?= site_url("Ijin_controller/filter_by_kelas"); ?>',
        method: 'POST',
        data: { kelas: selectedKelas },
        beforeSend: function() {
            // Tampilkan pesan loading
            document.getElementById('dataController').innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">Memuat data...</td>
                </tr>`;
        },
        success: function(response) {
            const container = document.getElementById('dataController');

            // Periksa apakah respons kosong
            if (response.trim() === '') {
                container.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data tersedia untuk kelas yang dipilih.</td>
                    </tr>`;
            } else {
                // Tampilkan data yang diterima dari server
                container.innerHTML = response;
            }
        },
        error: function(xhr, status, error) {
            document.getElementById('dataController').innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">Terjadi kesalahan saat memuat data. Silakan coba lagi.</td>
                </tr>`;
            console.error('Error:', {
                status: status,
                error: error,
                response: xhr.responseText
            });
        }
    });
}

	</script>


</body>

</html>
