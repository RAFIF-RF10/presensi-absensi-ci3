<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
					<button onclick="toggleSection('dataSeluruhSiswaContent')">Data Seluruh Siswa</button>
				</li>

				<li>
					<a href="<?= site_url('Login_controller_guru/logout'); ?>" class="block py-2 px-3 bg-blue-600 hover:bg-red-500 transition duration-100 text-white rounded">Logout</a>
				</li>
			</ul>
		</div>

		<!-- Main Content -->
		<div class="flex-1 p-8 ">
			<!-- Data Siswa -->
			<div id="dataSiswaContent" class="block">
				<!-- Nama Guru -->
				<div class="bg-blue-500 w-full mb-6 rounded-lg shadow-lg p-8">
					<h3 class="text-xl font-bold text-white">Selamat datang, <?= $this->session->userdata('guru_nama'); ?> </h3>
				</div>

				<h1 class="text-3xl font-semibold mb-6">Data Siswa</h1>

				<!-- Dropdown untuk Filter Kelas -->
				<div class="bg-white shadow-md rounded-lg p-6 mb-6">
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
				<div class="bg-white shadow-md rounded-lg p-6">
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
										<a href="<?= site_url('dashboard_guru/setuju/' . $pending->id); ?>" class="text-blue-600 hover:underline">Setuju</a>
										<a href="<?= site_url('dashboard_guru/tolak/' . $pending->id); ?>" class="text-red-600 hover:underline ml-4">Tolak</a>
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
									<td class="py-3 px-6 <?= $absensi->status == 'Hadir' ? 'text-green-600' : ($absensi->status == 'Tidak Hadir' ? 'text-red-600' : 'text-yellow-600'); ?>"><?= htmlspecialchars($absensi->status); ?></td>
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
	</script>


</body>

</html>
