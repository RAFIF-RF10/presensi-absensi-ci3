<?php
class List_model extends CI_Model {

    public function get_all_siswa() {
        $query = $this->db->get('siswa');
        return $query->result(); // Mengembalikan array objek hasil query
    }

    public function get_siswa($id) {
        return $this->db->get_where('siswa', ['id' => $id])->row();
    }

    public function insert_siswa($data) {
        $data['pin'] = rand(10000, 99999); // Menghasilkan PIN 5 digit secara acak
        return $this->db->insert('siswa', $data);
    }

    public function update_siswa($id, $data) {
        return $this->db->update('siswa', $data, ['id' => $id]);
    }

    public function delete_siswa($id) {
        return $this->db->delete('siswa', ['id' => $id]);
    }

    public function get_absensi_hari_ini() {
        $today = date('Y-m-d'); 
        $this->db->where('DATE(tanggal)', $today);
        $this->db->where('status', 'disetujui'); 
        $query = $this->db->get('absensi'); 
        return $query->result();
    }

    // Fungsi baru: Filter absensi berdasarkan bulan dan kelas
    public function get_absensi($bulan = null, $kelas = null) {
        $this->db->select('*');
        $this->db->from('absensi'); 
        
        // Filter berdasarkan bulan
        if ($bulan) {
            $this->db->where('MONTH(tanggal)', $bulan);
        }

        // Filter berdasarkan kelas
        if ($kelas) {
            $this->db->where('kelas', $kelas);
        }

        
        $this->db->order_by('tanggal', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}
