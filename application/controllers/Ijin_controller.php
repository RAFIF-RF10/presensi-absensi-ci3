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
            echo "Data session tidak lengkap.";
            exit;
        }

        $status = $this->input->post('status');
        
        // Pastikan status tidak kosong
        if (empty($status)) {
            $this->session->set_flashdata('message', 'Status absensi tidak dipilih.');
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
            $this->session->set_flashdata('message', 'Status berhasil disimpan');
        } else {
            $this->session->set_flashdata('message', 'Anda sudah absen hari ini');
        }

        // Arahkan kembali ke dashboard siswa
        redirect('dashboard_siswa');
    }
}
