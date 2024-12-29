<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persetujuan_model extends CI_Model {

       public function get_all_pending() {
        $query = $this->db->get('pending');
        return $query->result();
    }


    // Ambil data pending berdasarkan ID
   	 public function get_pending_by_id($id)
{
    $query = $this->db->get_where('pending', ['id' => $id]);
    $result = $query->row();

    if ($result) {
        log_message('debug', 'Data pending yang diambil: ' . print_r($result, true));
    } else {
        log_message('error', 'Data pending dengan ID ' . $id . ' tidak ditemukan.');
    }

    return $result;
}

    // Masukkan data ke tabel absensi
	public function insert_to_absensi($data)
{
    // Memasukkan data absensi ke tabel absensi
    $this->db->insert('absensi', $data);  // Pastikan nama tabel absensi sesuai
    return $this->db->affected_rows() > 0;  // Memastikan query berhasil
}

    // Ambil data pending berdasarkan kelas
    public function get_pending_by_kelas($kelas) {
        try {
            if ($kelas) {
                $this->db->where('kelas', $kelas);
            }
            $query = $this->db->get('pending');
            
            if (!$query) {
                throw new Exception("Query gagal: " . $this->db->last_query());
            }
    
            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Error pada get_pending_by_kelas: ' . $e->getMessage());
            return [];
        }
    }

    // Hapus data pending
    public function delete_pending($id) {
        return $this->db->delete('pending', ['id' => $id]);
    }

    // Ambil absensi hari ini
    public function get_absensi_today() {
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        $query = $this->db->get('absensi');
        return $query->result();
    }

    // Ambil semua data siswa
    public function get_all_siswa() {
        $query = $this->db->get('siswa');
        return $query->result();
    }

    // Ambil semua absensi
    public function get_all_absensi() {
        $this->db->select('*');
        $this->db->from('absensi');
        $query = $this->db->get();
        return $query->result();
    }

    // Rekap absensi berdasarkan bulan dan kelas
    public function get_rekap_absensi($bulan = null, $kelas = null) {
        $this->db->select('nama, kelas, status, tanggal');
        $this->db->from('absensi');
        
        if ($bulan) {
            $this->db->where('MONTH(tanggal)', $bulan);
        }
        
        if ($kelas) {
            $this->db->where('kelas', $kelas);
        }
        
        $this->db->order_by('tanggal', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}
