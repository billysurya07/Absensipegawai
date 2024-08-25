<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KetidakhadiranModel;

class Ketidakhadiran extends BaseController
{
    function __construct()
    {
        helper(['url','form']);
    }
    public function index()
    {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $id_pegawai = session()->get('id_pegawai');
        $data = [
            'title' => "Ketidakhadiran",
            'ketidakhadiran' => $ketidakhadiranModel->where('id_pegawai',$id_pegawai)->findAll()
        ];
        return view('pegawai/ketidakhadiran', $data);
    }
    public function create()
    {
        $data = [
            'title' => "Ajukan Ketidakhadiran",
            'validation' => \Config\Services::validation()
        ];
        return view('pegawai/create_ketidakhadiran', $data);
    }
    public function store()
    {
           $rules = [
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Keterangan Wajib Diisi"
                ],
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Tanggal Wajib Diisi"
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Deskripsi Wajib Diisi"
                ],
            ],

            'file' => [
                'rules' => 'uploaded[file]|max_size[file,10240]|mime_in[file,image/png,image/jpeg,application/pdf]',
                'errors' => [
                    'uploaded' => "File wajib di upload",
                    'max_size' => "ukuran file melebihi 10 MB",
                    'mime_in' => "jenis file hanya Boleh png, pdf atau jpeg"
                ],
            ],
            
        ];

        if (!$this->validate($rules)){
            $data = [
                'title' => "Ajukan Ketidakhadiran",
                'validation' => \Config\Services::validation()
            ];
            return view('pegawai/create_ketidakhadiran', $data);
        } else {
            $ketidakhadiranModel = new KetidakhadiranModel();
            $nama_file = '';
            $file = $this->request->getFile('file');
            if ($file && !$file->hasMoved()) {
                if ($file->getError() == 4) {
                    $nama_file = '';
                } else {
                    $nama_file = $file->getRandomName();
                    $file->move('file_ketidakhadiran', $nama_file);
                }
            } else {
                // Handle error jika file tidak ada atau sudah di-upload
            }

            
            $ketidakhadiranModel->insert([
                'id_pegawai' => $this->request->getPost('id_pegawai'),
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status' => 'Pending',
                'file' => $nama_file,
                
            ]);   
            session()->setFlashData('berhasil', ' KetidakHadiran Berhasil Diajukan');
            return redirect()->to(base_url('pegawai/ketidakhadiran'));
        }
    }
           //  Untuk Mengedit data
           public function edit($id)
           {
            $ketidakhadiranModel = new KetidakhadiranModel();
            $data = [
               'title' => "Edit Ketidakhadiran",
               'ketidakhadiran' => $ketidakhadiranModel->find($id),
               'validation' => \Config\Services::validation()
           ];
               return view('pegawai/edit_ketidakhadiran', $data);
           }
   
               // Untuk Mengedit Data
           public function update($id)
       {
        $ketidakhadiranModel = new KetidakhadiranModel();
        $rules = [
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Keterangan Wajib Diisi"
                ],
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Tanggal Wajib Diisi"
                ],
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Deskripsi Wajib Diisi"
                ],
            ],
        ];
   
   
           if (!$this->validate($rules)){
            $ketidakhadiranModel = new KetidakhadiranModel();
            $data = [
               'title' => "Edit Ketidakhadiran",
               'ketidakhadiran' => $ketidakhadiranModel->find($id),
               'validation' => \Config\Services::validation()
           ];
               return view('pegawai/edit_ketidakhadiran', $data);
           } else {
            $ketidakhadiranModel = new KetidakhadiranModel();
            $nama_file = '';
            $file = $this->request->getFile('file');
            if ($file && !$file->hasMoved()) {
                if ($file->getError() == 4) {
                    $nama_file = $this->request->getPost('file_lama');
                } else {
                    $nama_file = $file->getRandomName();
                    $file->move('file_ketidakhadiran', $nama_file);
                }
            } else {
                // Handle error jika file tidak ada atau sudah di-upload
            }
   
               $ketidakhadiranModel->update($id,[
                'keterangan' => $this->request->getPost('keterangan'),
                'tanggal' => $this->request->getPost('tanggal'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'status' => 'Pending',
                'file' => $nama_file,
                
                   
               ]);
               session()->setFlashData('berhasil', 'Data Ketidakhadiran Berhasil diupdate');
               return redirect()->to(base_url('pegawai/ketidakhadiran'));
           }
       }
           // untuk hapus data
           function delete($id)
           {
            $ketidakhadiranModel = new KetidakhadiranModel();
            $ketidakhadiran = $ketidakhadiranModel->find($id);
               if($ketidakhadiran){
                   $ketidakhadiranModel->where('id_pegawai', $id)->delete();
                   $ketidakhadiranModel->delete($id);
                   session()->setFlashData('berhasil', 'Data Ketidakhairan Berhasil dihapus');
                   return redirect()->to(base_url('pegawai/ketidakhadiran'));
   
               }
           }
}
