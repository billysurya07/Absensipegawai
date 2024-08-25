<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LokasiPresensiModel;

class LokasiPresensi extends BaseController
{
    function __construct()
    {
        helper(['url','form']);
    }
    public function index()
    {
        $lokasiPresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Data Lokasi Presensi',
            'lokasi_presensi' => $lokasiPresensiModel->findAll()
        ];

        return view('admin/lokasi_presensi/lokasi_presensi', $data);
    }
        
    public function detail($id)
    {
        $lokasiPresensiModel = new LokasiPresensiModel();
        $data = [
            'title' => 'Detail Lokasi Presensi',
            'lokasi_presensi' => $lokasiPresensiModel->find($id)
        ];
        return view('admin/lokasi_presensi/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => "Tambah Lokasi Presensi",
            'validation' => \Config\Services::validation()
        ];
        return view('admin/lokasi_presensi/create', $data);
    }
        // untuk Menyimpan Data
    public function store()
    {
        $rules = [
            'nama_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama lokasi Wajib Diisi"
                ],
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "alamat lokasi Wajib Diisi"
                ],
            ],
            'tipe_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "tipe lokasi Wajib Diisi"
                ],
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "latitude Wajib Diisi"
                ],
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "longitude Wajib Diisi"
                ],
            ],
            'radius' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "radius Wajib Diisi"
                ],
            ],
            'zona_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "zona waktu Wajib Diisi"
                ],
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "jam masuk Wajib Diisi"
                ],
            ],
            'jam_pulang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "jam pulang Wajib Diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $data = [
                'title' => "Tambah Lokasi Presensi",
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/lokasi_presensi/create', $data);
        } else {
            $lokasiPresensiModel = new LokasiPresensiModel();
            $lokasiPresensiModel->insert([
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'radius' => $this->request->getPost('radius'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_pulang' => $this->request->getPost('jam_pulang'),
                
            ]);

            session()->setFlashData('berhasil', 'Data lokasi Presensi Berhasil Tersimpan');
            return redirect()->to(base_url('admin/lokasi_presensi'));
        }
    }
            //  Untuk Mengedit data
        public function edit($id)
        {
            $lokasiPresensiModel = new LokasiPresensiModel();
            $data = [
                'title' => "Edit Lokasi Presensi",
                'lokasi_presensi' => $lokasiPresensiModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            return view('admin/lokasi_presensi/edit', $data);
        }

            // Untuk Mengedit Data
        public function update($id)
    {
        $lokasiPresensiModel = new LokasiPresensiModel();
        $rules = [
            'nama_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama lokasi Wajib Diisi"
                ],
            ],
            'alamat_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "alamat lokasi Wajib Diisi"
                ],
            ],
            'tipe_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "tipe lokasi Wajib Diisi"
                ],
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "latitude Wajib Diisi"
                ],
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "longitude Wajib Diisi"
                ],
            ],
            'radius' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "radius Wajib Diisi"
                ],
            ],
            'zona_waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "zona waktu Wajib Diisi"
                ],
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "jam masuk Wajib Diisi"
                ],
            ],
            'jam_pulang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "jam pulang Wajib Diisi"
                ],
            ],
        ];


        if (!$this->validate($rules)){
            $data = [
                'title' => "Edit Lokasi Presensi",
                'lokasi_presensi' => $lokasiPresensiModel->find($id),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/lokasi_presensi/edit', $data);
        } else {
            $lokasiPresensiModel = new LokasiPresensiModel();
            $lokasiPresensiModel->update($id,[
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'alamat_lokasi' => $this->request->getPost('alamat_lokasi'),
                'tipe_lokasi' => $this->request->getPost('tipe_lokasi'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'radius' => $this->request->getPost('radius'),
                'zona_waktu' => $this->request->getPost('zona_waktu'),
                'jam_masuk' => $this->request->getPost('jam_masuk'),
                'jam_pulang' => $this->request->getPost('jam_pulang'),
                
            ]);

            session()->setFlashData('berhasil', 'Data Lokasi Presensi Berhasil diupdate');
            return redirect()->to(base_url('admin/lokasi_presensi'));
        }
    }
        // untuk hapus data
        function delete($id)
        {
            $lokasiPresensiModel = new LokasiPresensiModel();
            $lokasi_presensi = $lokasiPresensiModel->find($id);
            if($lokasi_presensi){
                $lokasiPresensiModel->delete($id);
                session()->setFlashData('berhasil', 'Data Lokasi Presensi Berhasil dihapus');
                return redirect()->to(base_url('admin/lokasi_presensi'));

            }
        }
}
