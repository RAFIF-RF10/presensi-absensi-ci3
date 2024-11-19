<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('List_model');
    }

    public function index() {
        $data['siswa'] = $this->List_model->get_all_siswa();
        $data['absensi_today'] = $this->List_model->get_absensi_hari_ini();
        
        // Tambahkan variabel untuk halaman rekap
        $data['rekap_absensi'] = [];
        
        $this->load->view('dashboard-guru/list/index', $data);
    }

    public function tambah() {
        $this->load->view('dashboard-guru/list/tambah');
    }

    public function simpan() {
        $data = [
            'nama' => $this->input->post('nama'),
            'kelas' => $this->input->post('kelas')
        ];
        $this->List_model->insert_siswa($data);
        redirect('list_controller');
    }

    public function edit($id) {
        $data['siswa'] = $this->List_model->get_siswa($id);
        $this->load->view('dashboard-guru/list/edit', $data);
    }

    public function update($id) {
        $data = [
            'nama' => $this->input->post('nama'),
            'kelas' => $this->input->post('kelas')
        ];
        $this->List_model->update_siswa($id, $data);
        redirect('list_controller');
    }

    public function hapus($id) {
        $this->List_model->delete_siswa($id);
        redirect('list_controller');
    }

    // Fungsi baru: Rekap absensi
    public function rekap_absensi() {
        $bulan = $this->input->get('bulan'); // Ambil filter bulan
        $kelas = $this->input->get('kelas'); // Ambil filter kelas

        $data['rekap_absensi'] = $this->List_model->get_absensi($bulan, $kelas); // Ambil data absensi
        $data['siswa'] = $this->List_model->get_all_siswa(); // Data siswa untuk digunakan jika dibutuhkan
        $data['absensi_today'] = $this->List_model->get_absensi_hari_ini(); // Data absensi hari ini
        
        $this->load->view('dashboard-guru/data-siswa/index', $data);
    }
}
