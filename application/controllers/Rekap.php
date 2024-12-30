<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**	
 * @property db $db
 */
class Rekap extends CI_Controller
{
    public function index()
    {
        // Ambil data dari database
        $data['absensi'] = $this->db->get('absensi')->result();

        // Kirim data ke view
        $this->load->view('rekap_absensi_view', $data);
    }

    public function unduh_excel()
    {
        // Ambil data dari database
        $rekap_absensi = $this->db->get('absensi')->result();

        // Set header file Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=rekap_absensi.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Buka output
        $output = fopen("php://output", "w");

        // Header kolom
        $header = ['Nama', 'Kelas', 'Bukti', 'Status', 'Tanggal'];
        fputcsv($output, $header);

        // Data isi
        foreach ($rekap_absensi as $row) {
            fputcsv($output, [
                $row->nama,
                $row->kelas,
                !empty($row->bukti) ? base_url('uploads/bukti/' . $row->bukti) : 'Tidak Ada Bukti',
                ucfirst($row->status),
                date('d-m-Y', strtotime($row->tanggal))
            ]);
        }

        fclose($output);
        exit;
    }
}
