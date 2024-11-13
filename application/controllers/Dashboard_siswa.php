<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_siswa extends CI_Controller {

    public function index() {
        if (!$this->session->userdata('siswa_id')) {
            redirect('Login_controller_siswa');
        }

        $this->load->view('dashboard-siswa/index');
    }
}
