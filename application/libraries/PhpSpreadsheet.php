<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load PhpSpreadsheet
require_once APPPATH . './third_party/PhpSpreadsheet-master/src/PhpSpreadsheet/Spreadsheet.php';
require_once APPPATH . './third_party/PhpSpreadsheet-master/src/PhpSpreadsheet/Writer/Xlsx.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PhpSpreadsheet
{
    public function create_excel($data, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Masukkan header
        $sheet->fromArray([$data['header']], NULL, 'A1');

        // Masukkan data
        $sheet->fromArray($data['body'], NULL, 'A2');

        // Tulis file ke output
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
