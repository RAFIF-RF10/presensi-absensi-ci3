<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_guru extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Persetujuan_model');

        // Middleware untuk memastikan user adalah guru
        if (!$this->session->userdata('guru_id')) {
            redirect('Login_controller_guru');
        }
    }

    public function list() {
        $data['siswa'] = $this->Persetujuan_model->get_all_siswa();
        $data['pending_list'] = $this->Persetujuan_model->get_all_pending();
        $data['absensi_today'] = $this->Persetujuan_model->get_absensi_today();
        $this->load->view('dashboard-guru/list/index', $data);
    }

    public function persetujuan() {
        $data['pending_list'] = $this->Persetujuan_model->get_all_pending();
        $this->load->view('dashboard-guru/persetujuan/index', $data);
    }

    public function setuju($id) {
        $pending_absensi = $this->Persetujuan_model->get_pending_by_id($id);
        if (!$pending_absensi) {
            $this->session->set_flashdata('message', 'Data absensi tidak ditemukan.');
            redirect('dashboard_guru/persetujuan');
        }

        $absensi_data = [
            'nama' => $pending_absensi->nama,
            'kelas' => $pending_absensi->kelas,
            'status' => $pending_absensi->status,
            'tanggal' => $pending_absensi->tanggal,
            'bukti' => $pending_absensi->bukti,
        ];

        if ($this->Persetujuan_model->insert_to_absensi($absensi_data)) {
            $this->Persetujuan_model->delete_pending($id);
            $this->session->set_flashdata('message', 'Absensi berhasil disetujui.');
        } else {
            $this->session->set_flashdata('message', 'Gagal memindahkan data ke absensi.');
        }

        redirect('dashboard_guru/persetujuan');
    }

    public function tolak($id) {
        $pending_absensi = $this->Persetujuan_model->get_pending_by_id($id);
        if (!$pending_absensi) {
            $this->session->set_flashdata('message', 'Data absensi tidak ditemukan.');
            redirect('dashboard_guru/persetujuan');
        }

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

        redirect('dashboard_guru/persetujuan');
    }

    public function seluruh_data_siswa() {
        $data['absensi_siswa'] = $this->Persetujuan_model->get_all_absensi();
        $this->load->view('dashboard-guru/data-siswa/index', $data);
    }
}
