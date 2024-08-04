<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\jabatanModel;

class Jabatan extends BaseController
{
    public function index()
    {
        $jabatanModel = new jabatanModel();
        $data = [
            'title' => 'Data Jabatan',
            'jabatan' => $jabatanModel->findAll()
        ];

        return view('admin/jabatan/jabatan', $data);
    }
        // untuk Membuat Data 
    public function create()
    {
        $data = [
            'title' => "Tambah Jabatan",
            'validation' => \Config\Services::validation()
        ];
        return view('admin/jabatan/create', $data);
    }
        // untuk Menyimpan Data
    public function store()
    {
        $rules = [
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama Jabatan Wajib Diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $data = [
                'title' => "Tambah Jabatan",
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/jabatan/create', $data);
        } else {
            $jabatanModel = new jabatanModel();
            $jabatanModel->insert([
                'jabatan' => $this->request->getPost('jabatan')
            ]);

            session()->setFlashData('berhasil', 'Data Jabatan Berhasil Tersimpan');
            return redirect()->to(base_url('admin/jabatan'));
        }
    }
            //  Untuk Mengedit data
        public function edit($id)
        {
            $jabatanModel = new jabatanModel();
            $data = [
                'title' => "Edit Jabatan",
                'jabatan' => $jabatanModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            return view('admin/jabatan/edit', $data);
        }

            // Untuk Mengedit Data
        public function update($id)
    {
        $jabatanModel = new jabatanModel();
        $rules = [
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama Jabatan Wajib Diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $data = [
                'title' => "Edit Jabatan",
                'jabatan' => $jabatanModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/jabatan/edit', $data);
        } else {
            $jabatanModel = new jabatanModel();
            $jabatanModel->update($id,[
                'jabatan' => $this->request->getPost('jabatan')
            ]);

            session()->setFlashData('berhasil', 'Data Jabatan Berhasil diupdate');
            return redirect()->to(base_url('admin/jabatan'));
        }
    }
        // untuk hapus data
        function delete($id)
        {
            $jabatanModel = new jabatanModel();
            $jabatan = $jabatanModel->find($id);
            if($jabatan){
                $jabatanModel->delete($id);
                session()->setFlashData('berhasil', 'Data Jabatan Berhasil dihapus');
                return redirect()->to(base_url('admin/jabatan'));

            }
        }
}
