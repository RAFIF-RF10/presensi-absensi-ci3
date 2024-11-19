<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persetujuan_model extends CI_Model {

    public function get_all_pending() {
        $query = $this->db->get('pending'); // Ambil semua data dari tabel `pending`
        return $query->result(); // Mengembalikan hasil sebagai objek
    }

    // Fungsi untuk mengambil data pending berdasarkan ID
    public function get_pending_by_id($id) {
        $query = $this->db->get_where('pending', ['id' => $id]); // Ambil data berdasarkan ID
        return $query->row(); // Mengembalikan hasil sebagai objek
    }

    public function insert_to_absensi($data) {	
        // Insert data ke tabel absensi
        return $this->db->insert('absensi', $data);
    }

    public function delete_pending($id) {
        // Hapus data dari tabel pending setelah diproses
        return $this->db->delete('pending', ['id' => $id]);
    }
	public function get_absensi_today() {
		$this->db->where('DATE(tanggal)', date('Y-m-d')); // Ambil absensi yang disetujui hari ini
		$query = $this->db->get('absensi'); // Ambil data dari tabel absensi
		return $query->result(); // Mengembalikan hasil sebagai objek
	}
	public function get_all_siswa() {
		// Ambil seluruh data siswa dari tabel siswa
		$query = $this->db->get('siswa');
		return $query->result(); // Kembalikan hasil sebagai objek
	}
	public function get_all_absensi() {
		$this->db->select('*');
		$this->db->from('absensi'); // Nama tabel absensi dalam database
		$query = $this->db->get();
		return $query->result(); // Mengembalikan semua data dalam bentuk array objek
	}
	
		public function get_rekap_absensi($bulan = null, $kelas = null) {
			$this->db->select('nama, kelas, status, tanggal');
			$this->db->from('absensi');
			
			// Filter berdasarkan bulan jika parameter bulan diberikan
			if ($bulan) {
				$this->db->where('MONTH(tanggal)', $bulan);
			}
			
			// Filter berdasarkan kelas jika parameter kelas diberikan
			if ($kelas) {
				$this->db->where('kelas', $kelas);
			}
			
			// Urutkan berdasarkan tanggal
			$this->db->order_by('tanggal', 'ASC');
			$query = $this->db->get();
			return $query->result();
		}
		
	
}
