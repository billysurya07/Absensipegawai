<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    // Cek apakah pengguna sudah login
    if (!session()->get('logged_in'))
    {
        // Jika pengguna belum login, set flash message dan redirect ke halaman utama
        // Menyampaikan pesan kepada pengguna bahwa mereka perlu login terlebih dahulu
        session()->setFlashdata('pesan', 'Anda Belum Login');
        return redirect()->to('/');
    }

    // Cek apakah role pengguna adalah "Admin"
    if (session()->get('role_id') != "Admin" )
    {
        // Jika role pengguna bukan "Admin", set flash message dan redirect ke halaman utama
        // Menyampaikan pesan kepada pengguna bahwa mereka tidak memiliki izin akses
        session()->setFlashdata('pesan', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        return redirect()->to('/');
    }
}
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}