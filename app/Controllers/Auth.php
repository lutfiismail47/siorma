<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('admin'));
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $model = new AdminModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $model->where('username', $username)->first();
        // dd($admin);

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'id_admin'   => $admin['id_admin'],
                'username'   => $admin['username'],
                'isLoggedIn' => true
            ]);

            return redirect()->to(base_url('admin'));
        }

        return redirect()->to(base_url('login'))->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
