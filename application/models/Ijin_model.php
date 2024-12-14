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
	
		$this->db->where('nama', $data['nama']);
		$this->db->where('kelas', $data['kelas']);
		$this->db->where('status', $data['status']);
		
		// Format `tanggal` dengan tipe `DATETIME`
		$formatted_datetime = date('Y-m-d H:i:s', strtotime($data['tanggal']));
		$this->db->where('tanggal', $formatted_datetime);
	
		$query = $this->db->get('pending');
	
		if ($query->num_rows() > 0) {
			log_message('info', 'Absensi sudah ada pada hari ini untuk siswa: ' . $data['nama']);
			return false;
		} else {
			if ($this->db->insert('pending', $data)) {
				return true;
			} else {
				log_message('error', 'Error inserting data into pending: ' . $this->db->last_query());
				return false;
			}
		}
	}
	
    // Fungsi untuk mengecek absensi hari ini
    public function check_absen_today($nama, $kelas) {
        $this->db->where('nama', $nama);
        $this->db->where('kelas', $kelas);
        $this->db->where('DATE(tanggal)', date('Y-m-d')); // Periksa berdasarkan tanggal hari ini
        $query = $this->db->get('pending');
        return $query->num_rows() > 0; // True jika ada data absensi hari ini
    }
}
