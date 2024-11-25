<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_siswa extends CI_Controller {

    public function index() {
        if (!$this->session->userdata('siswa_id')) {
            redirect('Login_controller_siswa');
        }

        $this->load->view('dashboard-siswa/index');
    }
	public function upload_foto()
{
    // Lokasi folder untuk menyimpan foto
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size'] = 2048; // Maksimum 2MB
    $config['file_name'] = 'foto_' . $this->session->userdata('siswa_id') . '_' . time(); // Nama unik file

    $this->load->library('upload', $config);

    // Proses upload file
    if ($this->upload->do_upload('siswa_foto')) {
        $uploadData = $this->upload->data();
        $filePath = 'uploads/' . $uploadData['file_name'];

        // Simpan path file ke session
        $this->session->set_userdata('siswa_foto', $filePath);

        // Perbarui data di database
        $this->db->where('id', $this->session->userdata('siswa_id'));
        $this->db->update('siswa', ['foto' => $filePath]);

        $this->session->set_flashdata('message', 'Foto profil berhasil diperbarui.');
    } else {
        // Jika gagal, tampilkan error
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('message', 'Gagal mengunggah foto: ' . $error);
    }

    // Redirect kembali ke dashboard
    redirect(site_url('dashboard_siswa'));
}


}

