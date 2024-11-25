// Fungsi untuk memuat konten dinamis ke mainContent
function loadContent(url) {
	const mainContent = document.getElementById('mainContent');

	// Tampilkan pesan loading
	mainContent.innerHTML = '<div class="text-center text-gray-500">Memuat konten...</div>';

	// Lakukan fetch ke URL
	fetch(url)
		.then(response => {
			if (!response.ok) {
				throw new Error("Gagal memuat konten.");
			}
			return response.text();
		})
		.then(html => {
			// Masukkan konten yang dimuat ke mainContent
			mainContent.innerHTML = html;
		})
		.catch(error => {
			mainContent.innerHTML = `<div class="text-center text-red-500">${error.message}</div>`;
		});
}

// Event listener untuk sidebar
document.getElementById('dataSiswaBtn').addEventListener('click', () => {
	loadContent('<?= site_url('dashboard-guru/data-siswa/index'); ?>');
});

document.getElementById('tambahSiswaBtn').addEventListener('click', () => {
	loadContent('<?= site_url('dashboard-guru/list/tambah'); ?>');
});

document.getElementById('verifikasiAbsenBtn').addEventListener('click', () => {
	loadContent('<?= site_url('dashboard-guru/persetujuan/index'); ?>');
});

document.getElementById('absensiSiswaBtn').addEventListener('click', () => {
	loadContent('<?= site_url('dashboard-siswa/index'); ?>');
});

document.getElementById('absensiHariIniBtn').addEventListener('click', () => {
	loadContent('<?= site_url('dashboard-guru/data-siswa/index'); ?>'); // Sesuaikan jika lokasi berbeda
});
