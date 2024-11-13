<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller_guru extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model'); // Menggunakan Login_model
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
    }

    public function index() {
        if ($this->session->userdata('guru_id')) {
            redirect('dashboard_guru/list');
        }
        $this->load->view('login/login-guru/index');
    }

    public function proses_login() {
        $nama = $this->input->post('nama');
        $pin = $this->input->post('pin');

        // Memanggil cek_login dari Login_model
        $guru = $this->Login_model->cek_login_guru($nama, $pin);

        if ($guru) {
            // Jika login berhasil, set session dan arahkan ke dashboard siswa
            $this->session->set_userdata('guru_id', $guru->id);
            $this->session->set_userdata('guru_nama', $guru->nama);
            redirect('dashboard_guru/list');
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            $this->session->set_flashdata('error', 'Nama atau PIN salah');
            redirect('Login_controller_guru');
        }
    }

    public function logout() {
        // Hapus session dan kembali ke halaman login
        $this->session->unset_userdata('guru_id');
        $this->session->unset_userdata('guru_nama');
        redirect('Login_controller_guru');
    }

    public function kembali() {
        redirect('Home_controller');
    }
}
