<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;

class ControllerAdmin extends BaseController
{
    protected $crud;
    protected $session;

	public function __construct()
	{
		$this->crud = new ModelCrud();
        $this->session = session();
	}

    public function index()
    {
        // Cek apakah pengguna sudah login
        if ($this->session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('admin/index');
    }

    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $this->crud->setParamDataPagination("tbl_admin");

        $data_user = $this->crud->select_1_cond("email", $email);

        $user = $data_user[0];

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                $this->session->set([
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'logged_in' => TRUE
                ]);
                $this->session->setFlashdata('success_login', 'Anda Berhasil Login, Selamat Datang '. $user['name']);
                return redirect()->to('/dashboard');
            } else {
                $this->session->setFlashdata('error_login', 'Password salah');
                return redirect()->back();
            }
        } else {
            $this->session->setFlashdata('error_login', 'Email tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/index');
    }
}
