<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KetidakhadiranModel;

class Ketidakhadiran extends BaseController
{
    public function index()
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $data = [
            'title' => "Ketidakhadiran",
            'ketidakhadiran' => $ketidakhadiranModel->findAll()
        ];
        return view('admin/ketidakhadiran', $data);
    }

    public function approved($id)
    {
        $ketidakhadiranModel = new KetidakhadiranModel();

        // Update status menjadi 'Approved' berdasarkan ID
        $ketidakhadiranModel->update($id, [
            'status' => 'Approved'
        ]);

        session()->setFlashdata('berhasil', 'Status pengajuan ketidakhadiran berhasil di-approve.');
        return redirect()->to(base_url('admin/ketidakhadiran'));
    }
}
