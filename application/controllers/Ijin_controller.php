<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Persetujuan_model $Persetujuan_model
 * @property Ijin_model $Ijin_model
 */
class Ijin_controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Persetujuan_model'); 
		$this->load->model('Ijin_model');  // Pastikan model yang benar digunakan
	}

	// Fungsi untuk menampilkan halaman verifikasi absen
	public function verifikasi_absen()
	{
		// Ambil data pending absen
		$data['pending_list'] = $this->Persetujuan_model->get_all_pending();
		// Load view dan kirimkan data
		$this->load->view('guru/verifikasi_absen', $data);
	}

	// Fungsi untuk menyetujui absensi
	public function setuju($id)
	{
		$pending = $this->Persetujuan_model->get_pending_by_id($id);

		if ($pending) {
			// Masukkan data absensi ke tabel absensi
			$data = [
				'tanggal' => $pending->tanggal,
				'nama' => $pending->nama,
				'kelas' => $pending->kelas,
				'status' => $pending->status,
			];
			$inserted = $this->Persetujuan_model->insert_to_absensi($data);

			if ($inserted) {
				// Hapus data pending setelah disetujui
				$this->Persetujuan_model->delete_pending($id);
				$this->session->set_flashdata('message', 'Absensi berhasil disetujui.');
			} else {
				$this->session->set_flashdata('message', 'Terjadi kesalahan saat menyetujui absensi.');
			}
		} else {
			$this->session->set_flashdata('message', 'Data tidak ditemukan.');
		}

		redirect('dashboard_guru/verifikasi_absen');
	}

	// Fungsi untuk menolak absensi
	public function tolak($id)
	{
		// Hapus data pending yang ditolak
		$deleted = $this->Persetujuan_model->delete_pending($id);

		if ($deleted) {
			$this->session->set_flashdata('message', 'Absensi berhasil ditolak.');
		} else {
			$this->session->set_flashdata('message', 'Terjadi kesalahan saat menolak absensi.');
		}

		redirect('dashboard_guru/verifikasi_absen');
	}

	// Fungsi untuk mengupdate status absensi siswa
	public function set_status()
	{
		$status = $this->input->post('status');
		$nama = $this->session->userdata('siswa_nama');
		$kelas = $this->session->userdata('siswa_kelas');
		$tanggal = date('Y-m-d H:i:s'); // Format lengkap dengan waktu

		// Periksa apakah absensi sudah ada hari ini
		if ($this->Ijin_model->check_absen_today($nama, $kelas)) {
			$this->session->set_flashdata('message', 'Absensi untuk hari ini sudah dilakukan.');
		} else {
			$data = [
				'tanggal' => $tanggal, // Simpan sebagai `DATETIME`
				'nama' => $nama,
				'kelas' => $kelas,
				'status' => $status,
			];
			$inserted = $this->Ijin_model->insert_pending($data);
			if ($inserted) {
				$this->session->set_flashdata('message', 'Absensi berhasil dicatat.');
			} else {
				$this->session->set_flashdata('message', 'Terjadi kesalahan saat mencatat absensi.');
			}
		}

		redirect('dashboard_siswa');
	}
	
	public function filter_by_kelas() {
    $kelas = $this->input->post('kelas');
    $pending_list = empty($kelas)
        ? $this->Persetujuan_model->get_all_pending()
        : $this->Persetujuan_model->get_pending_by_kelas($kelas);

    if (!empty($pending_list)) {
        foreach ($pending_list as $pending) {
            echo '
                <tr>
                    <td>' . date('d-m-Y', strtotime($pending->tanggal)) . '</td>
                    <td>' . htmlspecialchars($pending->nama) . '</td>
                    <td>' . htmlspecialchars($pending->kelas) . '</td>
                    <td>' . htmlspecialchars($pending->status) . '</td>
                    <td>
                        <button class="text-blue-600 hover:underline" onclick="handleApproval(' . $pending->id . ', \'setuju\')">Setuju</button>
                        <button class="text-red-600 hover:underline ml-4" onclick="handleApproval(' . $pending->id . ', \'tolak\')">Tolak</button>
                    </td>
                </tr>';
        }
    } else {
        // Kirim respons kosong untuk ditangani di sisi klien
        echo '';
    }
}

}
