<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PegawaiModel;
use App\Models\UserModel;
use App\Models\LokasiPresensiModel;
use App\Models\JabatanModel;

class DataPegawai extends BaseController
{
    function __construct()
    {
        helper(['url','form']);
    }
    public function index()
    {
        $PegawaiModel = new PegawaiModel();
        $data = [
            'title' => 'Data Pegawai',
            'pegawai' => $PegawaiModel->findAll()
        ];

        return view('admin/data_pegawai/data_pegawai', $data);
    }
        
    public function detail($id)
    {
        $PegawaiModel = new PegawaiModel();
        $data = [
            'title' => 'Detail Data Pegawai',
            'pegawai' => $PegawaiModel->detailPegawai($id)
        ];
        
        return view('admin/data_pegawai/detail', $data);
    }

    public function create()
    {
        $lokasi_presensi = new LokasiPresensiModel();
        $jabatan_model = new JabatanModel();
        $data = [
            'title' => "Tambah Pegawai",
            'lokasi_presensi' => $lokasi_presensi->findAll(),
            'jabatan' => $jabatan_model->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/data_pegawai/create', $data);
    }

        // public function generateNIP()
        // {
        //     $PegawaiModel = new PegawaiModel();
        //     $PegawaiTerakhir = $PegawaiModel->select('nip')->orderBy('id', 'DESC')->first();
        //     dd($PegawaiTerakhir);
        // }


        // untuk Menyimpan Data
    public function store()
    {
           $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama  Wajib Diisi"
                ],
            ],
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nip  Wajib Diisi"
                ],
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jenis Kelamin Wajib Diisi"
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "alamat Wajib Diisi"
                ],
            ],
            'no_handphone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "no handphone Wajib Diisi"
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "jabatan Wajib Diisi"
                ],
            ],
            'lokasi_presensi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "lokasi Presensi Wajib Diisi"
                ],
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => "File foto wajib di upload",
                    'max_size' => "ukuran foto melebihi 10 MB",
                    'mime_in' => "jenis File hanya Boleh png atau jpeg"
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "username Wajib Diisi"
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "password Wajib Diisi"
                ],
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => "konfirmasi password Wajib Diisi",
                    'matches' => "konfirmasi password tidak cocok"
                ],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "role Wajib Diisi"
                ],
            ],
        ];

        if (!$this->validate($rules)){
            $lokasi_presensi = new LokasiPresensiModel();
            $jabatan_model = new JabatanModel();
            $data = [
                'title' => "Tambah Pegawai",
                'lokasi_presensi' => $lokasi_presensi->findAll(),
                'jabatan' => $jabatan_model->findAll(),
                'validation' => \Config\Services::validation()
            ];
            echo view('admin/data_pegawai/create', $data);
        } else {
            // $nipBaru = $this->generateNIP();
            // $PegawaiModel = new PegawaiModel();
            // dd($id_pegawai);
            $nama_foto = '';
            $foto = $this->request->getFile('foto');
            if ($foto && !$foto->hasMoved()) {
                if ($foto->getError() == 4) {
                    $nama_foto = '';
                } else {
                    $nama_foto = $foto->getRandomName();
                    $foto->move('profile', $nama_foto);
                }
            } else {
                // Handle error jika file tidak ada atau sudah di-upload
            }

            $PegawaiModel = new PegawaiModel();
            $PegawaiModel->insert([
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_handphone' => $this->request->getPost('no_handphone'),
                'jabatan' => $this->request->getPost('jabatan'),
                'lokasi_presensi' => $this->request->getPost('lokasi_presensi'),
                'foto' => $nama_foto,
                
            ]);
            $id_pegawai = $PegawaiModel->insertID();
            $userModel = new UserModel();
            $userModel->insert([
                'id_pegawai' => $id_pegawai,
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'status' => 'Aktif',
                'role' => $this->request->getPost('role'),
            ]);    

            session()->setFlashData('berhasil', 'Pegawai Berhasil Tersimpan');
            return redirect()->to(base_url('admin/data_pegawai'));
        }
    }
            //  Untuk Mengedit data
        public function edit($id)
        {
        $lokasi_presensi = new LokasiPresensiModel();
        $jabatan_model = new JabatanModel();
        $PegawaiModel = new PegawaiModel();
        $data = [
            'title' => "Edit Data Pegawai",
            'pegawai' => $PegawaiModel->editPegawai($id),
            'lokasi_presensi' => $lokasi_presensi->findAll(),
            'jabatan' => $jabatan_model->findAll(),
            'validation' => \Config\Services::validation()
        ];
            return view('admin/data_pegawai/edit', $data);
        }

            // Untuk Mengedit Data
        public function update($id)
    {
        $PegawaiModel = new PegawaiModel();
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nama  Wajib Diisi"
                ],
            ],
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Nip  Wajib Diisi"
                ],
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Jenis Kelamin Wajib Diisi"
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "alamat Wajib Diisi"
                ],
            ],
            'no_handphone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "no handphone Wajib Diisi"
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "jabatan Wajib Diisi"
                ],
            ],
            'lokasi_presensi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "lokasi Presensi Wajib Diisi"
                ],
            ],
            'foto' => [
                'rules' => 'max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => "ukuran foto melebihi 10 MB",
                    'mime_in' => "jenis File hanya Boleh png atau jpeg"
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "username Wajib Diisi"
                ],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "role Wajib Diisi"
                ],
            ],
        ];


        if (!$this->validate($rules)){
        $lokasi_presensi = new LokasiPresensiModel();
        $jabatan_model = new JabatanModel();
        $PegawaiModel = new PegawaiModel();
        $data = [
            'title' => "Edit Data Pegawai",
            'pegawai' => $PegawaiModel->editPegawai($id),
            'lokasi_presensi' => $lokasi_presensi->findAll(),
            'jabatan' => $jabatan_model->findAll(),
            'validation' => \Config\Services::validation()
        ];
            return view('admin/data_pegawai/edit', $data);
        } else {
            $PegawaiModel = new PegawaiModel();
            $userModel = new UserModel();
            $foto = $this->request->getFile('foto');
            $foto_lama = $this->request->getPost('foto_lama');
                if ($foto && !$foto->hasMoved()) {
                    if ($foto->getError() == 4) {
                        // Tidak ada file baru yang diunggah, gunakan foto lama
                        $nama_foto = $foto_lama;
                    } else {
                        // Ada file baru yang diunggah, gunakan nama acak untuk file baru
                        $nama_foto = $foto->getRandomName();
                        $foto->move('profile', $nama_foto); // Pindahkan file baru ke direktori 'profile'
                    }
                } else {
                    // Tidak ada file baru atau file sudah di-upload sebelumnya, gunakan foto lama
                    $nama_foto = $foto_lama;
                }

            $PegawaiModel->update($id,[
                'nip' => $this->request->getPost('nip'),
                'nama' => $this->request->getPost('nama'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_handphone' => $this->request->getPost('no_handphone'),
                'jabatan' => $this->request->getPost('jabatan'),
                'lokasi_presensi' => $this->request->getPost('lokasi_presensi'),
                'foto' => $nama_foto,
                
            ]);
                
                if ($this->request->getPost('password') == ''){
                    $password = $this->request->getPost('password_lama');
                } else {
                    $password = password_hash( $this->request->getPost('password'), PASSWORD_DEFAULT);
                }
                $userModel
                ->where('id_pegawai', $id)
                ->set([
                    'username' => $this->request->getPost('username'),
                    'password' => $password,
                    // 'status' => $this->request->getPost('status'),
                    'role' => $this->request->getPost('role'),

                    ])
                ->update();

            session()->setFlashData('berhasil', 'Data Pegawai Berhasil diupdate');
            return redirect()->to(base_url('admin/data_pegawai'));
        }
    }
        // untuk hapus data
        function delete($id)
        {
            $PegawaiModel = new PegawaiModel();
            $userModel = new UserModel();
            $pegawai = $PegawaiModel->find($id);
            if($pegawai){
                $userModel->where('id_pegawai', $id)->delete();
                $PegawaiModel->delete($id);
                session()->setFlashData('berhasil', 'Data Pegawai Berhasil dihapus');
                return redirect()->to(base_url('admin/data_pegawai'));

            }
        }
}
