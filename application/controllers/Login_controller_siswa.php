<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller_siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model'); // Menggunakan Login_model
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
    }

    public function index() {
        if ($this->session->userdata('siswa_id')) {
            redirect('dashboard_siswa');
        }
        $this->load->view('login/login-siswa/index');
    }

    public function proses_login() {
        $nama = $this->input->post('nama');
        $pin = $this->input->post('pin');


        // Memanggil cek_login dari Login_model
        $siswa = $this->Login_model->cek_login_siswa($nama, $pin);

		if ($siswa) {
			$this->session->set_userdata('siswa_id', $siswa->id);
			$this->session->set_userdata('siswa_nama', $siswa->nama);
			$this->session->set_userdata('siswa_kelas', $siswa->kelas);
			$this->session->set_userdata('siswa_foto', $siswa->foto ? $siswa->foto : 'assets/image/default.png'); // Foto default jika kosong
			redirect('dashboard_siswa');
		} else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            $this->session->set_flashdata('error', 'Nama atau PIN salah');
            redirect('Login_controller_siswa');
        }
    }

    public function logout() {
        // Hapus session dan kembali ke halaman login
        $this->session->unset_userdata('siswa_id');
        $this->session->unset_userdata('siswa_nama');
        redirect('Login_controller_siswa');
    }

    public function kembali() {
        redirect('Home_controller');
    }
}
