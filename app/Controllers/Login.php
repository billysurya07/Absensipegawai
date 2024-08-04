<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => service('validation')
        ];
        return view('login', $data);
    }

    public function login_action()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('login', $data);
        } else {
            $session = session(); // Mendapatkan instance session
            $loginModel = new LoginModel();

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $user = $loginModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Jika username dan password valid
                $session->set('username', $username);
                $session->set('role', $user['role']); // Menyimpan role ke session

                $session_data = [
                    'logged_in' => TRUE,
                    'role_id' => $user['role']
                ];
                $session->set($session_data);
                // Redirect berdasarkan role
                if ($user['role'] === 'Admin') {
                    return redirect()->to('admin/home'); // Redirect ke dashboard admin
                } elseif ($user['role'] === 'Pegawai') {
                    return redirect()->to('pegawai/home'); // Redirect ke dashboard pegawai
                } else {
                    $session->setFlashdata('pesan', 'Role pengguna tidak dikenali.');
                    return redirect()->to('/login'); // Arahkan kembali ke halaman login
                }
            } else {
                // Jika username atau password salah
                $session->setFlashdata('pesan', 'Username atau password salah. Silakan coba lagi.');
                return redirect()->to('/login'); // Arahkan kembali ke halaman login
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
