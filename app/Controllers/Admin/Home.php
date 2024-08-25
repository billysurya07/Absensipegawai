<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use App\Models\PresensiModel;
use App\Models\ketidakhadiranModel;

use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function index()
{
    date_default_timezone_set('Asia/Jakarta');
    $pegawai_model = new PegawaiModel();
    $presensi_model = new PresensiModel();
    $ketidakhadiran_model = new KetidakhadiranModel();
    // Pastikan format tanggal sesuai dengan yang ada di database (misalnya: 'Y-m-d' untuk format tahun-bulan-tanggal)
    $tanggal_sekarang = date('Y-m-d');
    $data = [
        'title' => 'Home',
        'total_pegawai' => $pegawai_model->countAllResults(), // countAllResults() tanpa parameter
        'total_hadir' => $presensi_model->where('tanggal_masuk', $tanggal_sekarang)->countAllResults(), // countAllResults() setelah where()
        'ketidakhadiran' => $ketidakhadiran_model->where('tanggal', $tanggal_sekarang)->countAllResults(),
    ];

    return view('admin/home', $data);
}

}
