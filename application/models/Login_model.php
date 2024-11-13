<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function cek_login_siswa($nama, $pin) {
        $this->db->where('nama', $nama);
        $this->db->where('pin', $pin);
        $query = $this->db->get('siswa');

        if ($query->num_rows() == 1) {
            return $query->row(); // Jika data cocok, kembalikan data siswa
        }
        return false; // Jika tidak cocok, kembalikan false
    }

    public function cek_login_guru($nama, $pin) {
        $this->db->where('nama', $nama);
        $this->db->where('pin', $pin);
        $query = $this->db->get('guru');

        if ($query->num_rows() == 1) {
            return $query->row(); // Jika data cocok, kembalikan data siswa
        }
        return false; // Jika tidak cocok, kembalikan false
    }
}
