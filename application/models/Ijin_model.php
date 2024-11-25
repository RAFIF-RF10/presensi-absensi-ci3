<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ijin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function insert_pending($data) {
		log_message('debug', 'Data yang akan dimasukkan ke pending: ' . print_r($data, true));
	
		$this->db->where('nama', $data['nama']);
		$this->db->where('kelas', $data['kelas']);
		$this->db->where('status', $data['status']);
		
		$formatted_date = date('Y-m-d', strtotime($data['tanggal'])); 
		$this->db->where('DATE(tanggal)', $formatted_date);
		
		$query = $this->db->get('pending');
	
		if ($query->num_rows() > 0) {
			log_message('info', 'Absensi sudah ada pada hari ini untuk siswa: ' . $data['nama']);
			return false;
		} else {
			
			$data_to_insert = [
				'tanggal' => $data['tanggal'],
				'nama' => $data['nama'],
				'kelas' => $data['kelas'],
				'status' => $data['status']
			];
	
			if ($this->db->insert('pending', $data_to_insert)) {
				return true;
			} else {
				// Debug: Tampilkan query dan pesan error
				log_message('error', 'Error inserting data into pending: ' . $this->db->last_query());
				log_message('error', 'Database error: ' . $this->db->error()['message']);
				return false;
			}
		}
	}
	
	public function check_absen_today($nama, $kelas) {
		$this->db->where('nama', $nama);
		$this->db->where('kelas', $kelas);
		$this->db->where('DATE(tanggal)', date('Y-m-d')); // Periksa berdasarkan tanggal hari ini
		$query = $this->db->get('pending'); // Ganti 'pending' sesuai nama tabel absensi Anda
	
		return $query->num_rows() > 0; // True jika ada data, False jika tidak
	}
}
