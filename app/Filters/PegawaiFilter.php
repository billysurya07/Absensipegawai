<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PegawaiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah pengguna sudah login
        if (!$session->get('logged_in')) {
            $session->setFlashdata('pesan', 'Anda Belum Login');
            return redirect()->to('/');
        }

        // Cek apakah role_id adalah "Pegawai"
        if ($session->get('role_id') !== "Pegawai") {
            $session->setFlashdata('pesan', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here if needed
    }
}
