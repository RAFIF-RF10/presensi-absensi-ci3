<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ijin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk memasukkan data absensi pending
  public function insert_pending($data) {
        log_message('debug', 'Data yang akan dimasukkan ke pending: ' . print_r($data, true));
        return $this->db->insert('pending', $data);
    }

    public function check_absen_today($nama, $kelas) {
        $this->db->where('nama', $nama);
        $this->db->where('kelas', $kelas);
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        $query_pending = $this->db->get('pending');

        $this->db->where('nama', $nama);
        $this->db->where('kelas', $kelas);
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        $query_absensi = $this->db->get('absensi');

        return $query_pending->num_rows() > 0 || $query_absensi->num_rows() > 0;
    }
}

