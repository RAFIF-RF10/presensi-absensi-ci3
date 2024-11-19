<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ijin_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ijin_model');
    }

    public function set_status() {
        // Ambil data dari session
        $siswa_nama = $this->session->userdata('siswa_nama');
        $siswa_kelas = $this->session->userdata('siswa_kelas');

        if (!$siswa_nama || !$siswa_kelas) {
            $this->session->set_flashdata('message', 'Data session tidak lengkap.');
            redirect('dashboard_siswa');
            return;
        }

        $status = $this->input->post('status');

        // Pastikan status tidak kosong
        if (empty($status)) {
            $this->session->set_flashdata('message', 'Status absensi tidak dipilih.');
            redirect('dashboard_siswa');
            return;
        }

        // Cek apakah siswa sudah absen hari ini
        $already_absent = $this->Ijin_model->check_absen_today($siswa_nama, $siswa_kelas);

        if ($already_absent) {
            $this->session->set_flashdata('message', 'Anda sudah absen hari ini.');
            redirect('dashboard_siswa');
            return;
        }

        // Siapkan data untuk dimasukkan ke tabel pending
        $data = [
            'tanggal' => date('Y-m-d H:i:s'),
            'nama' => $siswa_nama,
            'kelas' => $siswa_kelas,
            'status' => $status
        ];

        // Memasukkan data ke dalam tabel pending
        $inserted = $this->Ijin_model->insert_pending($data);

        if ($inserted) {
            $this->session->set_flashdata('message', 'Berhasil melakukan absensi.');
        } else {
            $this->session->set_flashdata('message', 'Terjadi kesalahan. Silakan coba lagi.');
        }

        // Arahkan kembali ke dashboard siswa
        redirect('dashboard_siswa');
    }
}
