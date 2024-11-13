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
        $today = date('Y-m-d'); // Tanggal hari ini
        $this->db->where('tanggal', $today);
        $this->db->where('status', 'disetujui'); // Pastikan status sesuai dengan logika persetujuan
        $query = $this->db->get('absensi'); // Ganti 'absensi' dengan nama tabel absensi Anda
        return $query->result();
    }
	
}
