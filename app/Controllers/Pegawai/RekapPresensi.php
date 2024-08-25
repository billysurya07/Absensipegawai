<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PresensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapPresensi extends BaseController
{
    public function index()
{
    $presensiModel = new PresensiModel();
    $filter_tanggal = $this->request->getVar('filter_tanggal');

    if($filter_tanggal){

        if (isset($_GET['excel'])) {
            $rekap_presensi = $presensiModel->rekap_presensi_pegawai_filter($filter_tanggal);
            $spreadsheet = new Spreadsheet();

            $activeWorksheet = $spreadsheet->getActiveSheet();
            $spreadsheet->getActiveSheet()->mergeCells('A1:C1');
            $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
            $spreadsheet->getActiveSheet()->mergeCells('C3:E3');

            $activeWorksheet->setCellValue('A1','REKAP PRESENSI PEGAWAI');
            $activeWorksheet->setCellValue('A3','TANGGAL');
            $activeWorksheet->setCellValue('C3',$filter_tanggal);
            $activeWorksheet->setCellValue('A4','NO');
            $activeWorksheet->setCellValue('B4','NAMA PEGAWAI');
            $activeWorksheet->setCellValue('C4','TANGGAL MASUK');
            $activeWorksheet->setCellValue('D4','JAM MASUK');
            $activeWorksheet->setCellValue('E4','TANGGAL KELUAR');
            $activeWorksheet->setCellValue('F4','JAM KELUAR');
            $activeWorksheet->setCellValue('G4','TOTAL JAM KERJA');
            $activeWorksheet->setCellValue('H4','TOTAL TERLAMBAT');

          $rows = 5;
            $no = 1;
            foreach($rekap_presensi as $rekap){
                // Menghitung total jam kerja
                $timestamp_jam_masuk = strtotime($rekap['tanggal_masuk'].$rekap['jam_masuk']);
                $timestamp_jam_keluar = strtotime($rekap['tanggal_masuk'].$rekap['jam_keluar']);
                $selisih = $timestamp_jam_keluar - $timestamp_jam_masuk;
                $jam = floor($selisih / 3600);
                $selisih -= $jam * 3600;
                $menit = floor($selisih / 60);

                // Menghitung total jam keterlambatan
                $jam_masuk_real = strtotime($rekap['jam_masuk']);
                $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;

                // Cek apakah pegawai terlambat atau tidak
                if ($selisih_terlambat > 0) {
                    $jam_terlambat = floor($selisih_terlambat / 3600);
                    $selisih_terlambat -= $jam_terlambat * 3600;
                    $menit_terlambat = floor($selisih_terlambat / 60);
                } else {
                    // Jika tidak terlambat, set keterlambatan ke 0
                    $jam_terlambat = 0;
                    $menit_terlambat = 0;
                }

                // Menyimpan nilai ke worksheet
                $activeWorksheet->setCellValue('A'.$rows, $no++);
                $activeWorksheet->setCellValue('B'.$rows, $rekap['nama']);
                $activeWorksheet->setCellValue('C'.$rows, $rekap['tanggal_masuk']);
                $activeWorksheet->setCellValue('D'.$rows, $rekap['jam_masuk']);
                $activeWorksheet->setCellValue('E'.$rows, $rekap['tanggal_keluar']);
                $activeWorksheet->setCellValue('F'.$rows, $rekap['jam_keluar']);
                $activeWorksheet->setCellValue('G'.$rows, $jam. ' Jam ' . $menit. ' Menit ');
                $activeWorksheet->setCellValue('H'.$rows, $jam_terlambat. ' Jam ' . $menit_terlambat. ' Menit ');

                $rows++;
            }

            /* Here there will be some code where you create $spreadsheet */

                // redirect output to client browser
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="rekap_presensi_pegawai.xlsx"');
                header('Cache-Control: max-age=0');

                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
            
            
        } else {
            $rekap_presensi = $presensiModel->rekap_presensi_pegawai_filter($filter_tanggal);
        }

        
    } else {
        $rekap_presensi = $presensiModel->rekap_presensi_pegawai();
    }
    $data = [
        'title' => 'Rekap Presensi',
        'rekap_presensi' => $rekap_presensi
    ];
    return view('pegawai/rekap_presensi', $data);
}
}
