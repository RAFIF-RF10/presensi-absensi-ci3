<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ijin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	public function insert_pending($data) {
		log_message('debug', 'Data yang akan dimasukkan ke pending: ' . print_r($data, true));
	
		// Periksa jika absensi untuk siswa pada hari yang sama sudah ada
		$this->db->where('nama', $data['nama']);
		$this->db->where('kelas', $data['kelas']);
		$this->db->where('status', $data['status']);
		
		// Perbaiki format tanggal yang dikirim ke query
		$formatted_date = date('Y-m-d', strtotime($data['tanggal'])); // Menghilangkan spasi ekstra
		$this->db->where('DATE(tanggal)', $formatted_date);
		
		$query = $this->db->get('pending');
	
		if ($query->num_rows() > 0) {
			log_message('info', 'Absensi sudah ada pada hari ini untuk siswa: ' . $data['nama']);
			return false;
		} else {
			// Hanya simpan data yang diperlukan tanpa bukti
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
	
	
}
