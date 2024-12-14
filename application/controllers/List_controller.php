<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property List_model $List_model
 */

class List_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('List_model');
	}

	public function index()
	{
		$data['siswa'] = $this->List_model->get_all_siswa();
		$data['absensi_today'] = $this->List_model->get_absensi_hari_ini();

		// Tambahkan variabel untuk halaman rekap
		$data['rekap_absensi'] = [];

		$this->load->view('dashboard-guru/list/index', $data);
	}

	public function tambah()
	{
		$this->load->view('dashboard-guru/list/tambah');
	}

	public function simpan()
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'kelas' => $this->input->post('kelas')
		];
		$this->List_model->insert_siswa($data);
		// Redirect ke halaman setelah berhasil tambah data
		redirect('list_controller');
	}

	public function edit($id)
	{
		$siswa = $this->List_model->get_siswa($id);

		if ($siswa) {
			echo json_encode($siswa); // Mengembalikan data siswa dalam bentuk JSON
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Siswa tidak ditemukan']);
		}
	}

	public function update($id)
	{
		// Ambil data yang dikirim melalui POST
		$nama = $this->input->post('nama');
		$kelas = $this->input->post('kelas');

		// Pastikan data yang diterima tidak kosong
		if (!$nama || !$kelas) {
			echo json_encode(['status' => 'error', 'message' => 'Nama dan Kelas harus diisi']);
			return;
		}

		// Update data siswa di database
		$data = [
			'nama' => $nama,
			'kelas' => $kelas
		];

		// Lakukan update data siswa berdasarkan ID
		$this->List_model->update_siswa($id, $data);

		// Kembali ke halaman yang sesuai setelah update
		echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
	}


	public function hapus($id)
	{
		// Hapus data siswa
		$deleteStatus = $this->List_model->delete_siswa($id);

		// Cek apakah delete berhasil
		if ($deleteStatus) {
			// Jika berhasil
			echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
		} else {
			// Jika gagal
			echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus data.']);
		}
	}


	public function absen_today()
	{
		$bulan = $this->input->get('bulan'); // Ambil filter bulan dari GET
		$kelas = $this->input->get('kelas'); // Ambil filter kelas dari GET

		// Ambil data absensi dari model (berdasarkan filter)
		// $data['rekap_absensi'] = $this->List_model->get_absensi($bulan, $kelas);
		// $data['siswa'] = $this->List_model->get_all_siswa(); // Data siswa untuk digunakan jika dibutuhkan
		$data['absensi_today'] = $this->List_model->get_absensi_hari_ini(); // Data absensi hari ini
		// Tampilkan view dengan data yang sudah difilter
		$this->load->view('dashboard-guru/list/index', $data); // Pastikan path view benar
	}
	public function rekap_absensi()
	{
		$bulan = $this->input->get('bulan'); // Ambil filter bulan dari GET
		$kelas = $this->input->get('kelas'); // Ambil filter kelas dari GET

		// Ambil data absensi dari model (berdasarkan filter)
		$data['rekap_absensi'] = $this->List_model->get_absensi($bulan, $kelas);
		$data['siswa'] = $this->List_model->get_all_siswa(); // Data siswa untuk digunakan jika dibutuhkan
		$data['absensi_today'] = $this->List_model->get_absensi_hari_ini(); // Data absensi hari ini
		// Tampilkan view dengan data yang sudah difilter
		$this->load->view('dashboard-guru/list/index', $data); // Pastikan path view benar
	}
	public function get_siswa_by_id($id)
	{
		$siswa = $this->List_model->get_siswa($id);  // Ambil data siswa berdasarkan ID
		echo json_encode($siswa);  // Pastikan untuk mengembalikan data dalam format JSON
	}
	public function get_data_by_kelas()
{
    // Ambil data dari POST request
    $kelas = $this->input->post('kelas');

    // Panggil model untuk mendapatkan data siswa
    $this->load->model('List_model');
    $dataSiswa = $this->List_model->get_data_by_kelas($kelas);

    // Buat respon berupa tabel
    if (!empty($dataSiswa)) {
        foreach ($dataSiswa as $row) {
            echo '<tr>';
            echo '<td class="px-4 py-2">' . $row->nama . '</td>';
            echo '<td class="px-4 py-2">' . $row->kelas . '</td>';
            echo '<td class="px-4 py-2">' . $row->pin . '</td>';
            echo '<td class="px-4 py-2">
                    <a href="javascript:void(0);" onclick="editData(' . $row->id . ')" class="text-blue-600 hover:underline">Edit</a>
                    <a href="javascript:void(0);" onclick="deleteData(' . $row->id . ')" class="text-red-600 hover:underline ml-4">Hapus</a>
                  </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="4" class="text-center">Tidak ada data siswa.</td></tr>';
    }
}

public function get_data_by_kelas_absensi_today()
{
    $kelas = $this->input->post('kelas'); // Ambil input dari POST
    $this->load->model('List_model');

    // Ambil data absensi dari model
    $dataSiswa = $this->List_model->get_absensi_hari_ini($kelas);

    // Kirim respon dalam format JSON
    echo json_encode($dataSiswa);
}



}

