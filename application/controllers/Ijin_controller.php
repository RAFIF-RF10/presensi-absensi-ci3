<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Persetujuan_model $Persetujuan_model
 * @property Ijin_model $Ijin_model
 * @property upload $upload
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
    // Ambil data pending berdasarkan ID
    $pending = $this->Persetujuan_model->get_pending_by_id($id);

    if ($pending) {
        // Masukkan data yang disetujui ke tabel absensi
        $data = [
            'tanggal' => $pending->tanggal,
            'nama' => $pending->nama,
            'kelas' => $pending->kelas,
            'status' => $pending->status,
            'bukti' => $pending->bukti,  // Pastikan bukti disertakan
        ];
		
        // Masukkan data ke tabel absensi
        $inserted = $this->Persetujuan_model->insert_to_absensi($data);
		echo($pending->bukti);

        if ($inserted) {
            // Hapus data pending setelah disetujui
            $this->Persetujuan_model->delete_pending($id);
            // Kirimkan pesan sukses
            $this->session->set_flashdata('message', 'Absensi berhasil disetujui.');
        } else {
            // Kirimkan pesan error jika gagal
            $this->session->set_flashdata('message', 'Terjadi kesalahan saat menyetujui absensi.');
        }
    } else {
        // Kirimkan pesan error jika data tidak ditemukan
        $this->session->set_flashdata('message', 'Data tidak ditemukan.');
    }

    // Redirect kembali ke halaman verifikasi absensi
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
	public function set_status() {
		$status = $this->input->post('status');
		$nama = $this->session->userdata('siswa_nama');
		$kelas = $this->session->userdata('siswa_kelas');
		$datetime = date('Y-m-d H:i:s'); // Format tanggal dan waktu (DATETIME)
	
		$bukti = null; // Inisialisasi variabel bukti
		$allowed_types = 'jpg|jpeg|png|pdf'; // Format file yang diperbolehkan
	
		if (in_array($status, ['izin', 'sakit', 'dispen'])) {
			// Proses upload file jika ada
			$config['upload_path'] = './uploads/bukti/';
			$config['allowed_types'] = $allowed_types;
			$config['max_size'] = 2048; // Maksimum 2MB
			$config['file_name'] = strtolower($nama . '_' . time());
	
			$this->load->library('upload', $config);
	
			if ($this->upload->do_upload('bukti')) {
				$bukti = $this->upload->data('file_name'); // Simpan nama file
			} else {
				// Ambil pesan error dan tambahkan informasi format file yang diperbolehkan
				$error = $this->upload->display_errors('', '');
				$this->session->set_flashdata('message', 'Gagal mengunggah bukti: ' . $error . 
					' Format yang diperbolehkan: ' . str_replace('|', ', ', $allowed_types) . '.');
				redirect('dashboard_siswa');
				return;
			}
		}
	
		if ($this->Ijin_model->check_absen_today($nama, $kelas)) {
			$this->session->set_flashdata('message', 'Absensi untuk hari ini sudah dilakukan.');
		} else {
			// Masukkan data ke tabel `pending`
			$data = [
				'tanggal' => $datetime, // Gunakan format DATETIME
				'nama' => $nama,
				'kelas' => $kelas,
				'status' => $status, // Hadir/Sakit/Izin/Dispen
				'bukti' => $bukti, // Nama file bukti
			];
	
			if ($this->Ijin_model->insert_pending($data)) {
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
						<td class="px-4 py-2">';
				
				if (!empty($pending->bukti)) {
					echo '<a href="' . base_url('uploads/bukti/' . $pending->bukti) . '" target="_blank" class="text-blue-600 hover:underline">
							Lihat Bukti
						  </a>';
				} else {
					echo 'Tidak Ada Bukti';
				}
	
				echo '</td>
						<td>' . htmlspecialchars($pending->status) . '</td>
						<td>
							<button class="text-blue-600 hover:underline" onclick="handleApproval(' . $pending->id . ', \'setuju\')">Setuju</button>
							<button class="text-red-600 hover:underline ml-4" onclick="handleApproval(' . $pending->id . ', \'tolak\')">Tolak</button>
						</td>
					</tr>';
			}
		} else {
			echo '<tr><td colspan="6" class="text-center">Tidak ada data pending</td></tr>';
		}
	}
	
	
	
}

