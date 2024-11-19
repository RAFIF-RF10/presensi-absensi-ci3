<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_guru extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Persetujuan_model');
    }

	public function list() {
		if (!$this->session->userdata('guru_id')) {
			redirect('Login_controller_guru');
		}
	
		// Mengambil data siswa dan absensi hari ini
		$data['siswa'] = $this->Persetujuan_model->get_all_siswa(); // Tambahkan baris ini
		$data['pending_list'] = $this->Persetujuan_model->get_all_pending();
		$data['absensi_today'] = $this->Persetujuan_model->get_absensi_today();
	
		// Pastikan semua data terkirim ke view
		$this->load->view('dashboard-guru/list/index', $data);
	}
	

    public function persetujuan() {
        if (!$this->session->userdata('guru_id')) {
            redirect('Login_controller_guru');
        }
        $data['pending_list'] = $this->Persetujuan_model->get_all_pending();
        $this->load->view('dashboard-guru/persetujuan/index', $data);
    }

    public function setuju($id) {
        if (!$this->session->userdata('guru_id')) {
            redirect('Login_controller_guru');
        }

        $pending_absensi = $this->Persetujuan_model->get_pending_by_id($id);
        if ($pending_absensi) {
            $absensi_data = [
                'nama' => $pending_absensi->nama,
                'kelas' => $pending_absensi->kelas,
                'status' => $pending_absensi->status,
                'tanggal' => $pending_absensi->tanggal,
            ];
            if ($this->Persetujuan_model->insert_to_absensi($absensi_data)) {
                $this->Persetujuan_model->delete_pending($id);
                $this->session->set_flashdata('message', 'Absensi disetujui dan dipindahkan ke absensi.');
            } else {
                $this->session->set_flashdata('message', 'Gagal memindahkan data ke absensi.');
            }
        } else {
            $this->session->set_flashdata('message', 'Data absensi tidak ditemukan.');
        }

        redirect('dashboard-guru/persetujuan');
    }

    public function tolak($id) {
        if (!$this->session->userdata('guru_id')) {
            redirect('Login_controller_guru');
        }

        $pending_absensi = $this->Persetujuan_model->get_pending_by_id($id);
        if ($pending_absensi) {
            $absensi_data = [
                'nama' => $pending_absensi->nama,
                'kelas' => $pending_absensi->kelas,
                'status' => 'alpa',
                'tanggal' => $pending_absensi->tanggal,
            ];
            if ($this->Persetujuan_model->insert_to_absensi($absensi_data)) {
                $this->Persetujuan_model->delete_pending($id);
                $this->session->set_flashdata('message', 'Absensi ditolak dan status diubah menjadi alpa.');
            } else {
                $this->session->set_flashdata('message', 'Gagal memindahkan data ke absensi.');
            }
        } else {
            $this->session->set_flashdata('message', 'Data absensi tidak ditemukan.');
        }

        redirect('dashboard-guru/persetujuan');
    }

	public function seluruh_data_siswa() {
		if (!$this->session->userdata('guru_id')) {
			redirect('Login_controller_guru');
		}
	
		// Ambil semua data absensi
		$data['absensi_siswa'] = $this->Persetujuan_model->get_all_absensi();
		$this->load->view('dashboard-guru/data-siswa/index', $data);
	}
	
}
