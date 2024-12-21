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
	
		if ($this->check_absen_today($data['nama'], $data['kelas'])) {
			log_message('info', 'Siswa sudah absen hari ini: ' . $data['nama']);
			return false;
		}
	
		return $this->db->insert('pending', $data);
	}
	
	
	 // Fungsi untuk mengecek absensi hari ini
	 public function check_absen_today($nama, $kelas) {
		// Periksa di tabel `pending`
		$this->db->where('nama', $nama);
		$this->db->where('kelas', $kelas);
		$this->db->where('DATE(tanggal)', date('Y-m-d')); // Ekstrak tanggal dari kolom `DATETIME`
		$query_pending = $this->db->get('pending');
	
		// Periksa di tabel `absensi`
		$this->db->where('nama', $nama);
		$this->db->where('kelas', $kelas);
		$this->db->where('DATE(tanggal)', date('Y-m-d'));
		$query_absensi = $this->db->get('absensi');
	
		// Return true jika ditemukan data di salah satu tabel
		return $query_pending->num_rows() > 0 || $query_absensi->num_rows() > 0;
	}
	
}
