<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {

    public function index() {
        $this->load->view('Home/index');
    }

    public function login_siswa() {
        redirect('Login_controller_siswa');
    }

    public function login_guru() {
        redirect('Login_controller_guru');
    }

}