<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

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

    public function index_admin($id = null, $metode = null)
    {
        if ($id == null) {
            $id = 0;
            $metode = "";
        }
        $data['title'] = "Data Admin";
        $this->crud->setParamDataPagination("tbl_admin",$id,$metode,"","","","","","id");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/admin/index', $data);
    }

    public function add_admin()
    {
        $data['title'] = "Add Data Admin";

        return view('admin/content/admin/add-data', $data);
    }

    public function save_admin()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $product['name'] = $data['name'];
        $product['email'] = $data['email'];
        $product['hp'] = $data['hp'];
        $product['level'] = $data['level'];
        $product['password'] = password_hash($data['password'], PASSWORD_DEFAULT);;
        $product['created_at'] = $waktuSekarang;
        $product['updated_at'] = $waktuSekarang;

        $this->crud->save_data('tbl_admin', $product);
        $this->session->setFlashdata('success', 'Admin Data Sucess Save');

        return redirect()->to("/admin/data-admin");
    }

    public function login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $this->crud->setParamDataPagination("tbl_admin");

        $data_user = $this->crud->select_1_cond("email", $email);
        if (count($data_user) == 0) {
            $this->session->setFlashdata('error_login', 'Email Atau Password Salah !!');
                return redirect()->back();
        }
        $user = $data_user[0];

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                $this->session->set([
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'level' => $user['level'],
                    'logged_in' => TRUE
                ]);
                $this->session->setFlashdata('success_login', 'Anda Berhasil Login, Selamat Datang '. $user['name']);
                return redirect()->to('/dashboard');
            } else {
                $this->session->setFlashdata('error_login', 'Email Atau Password Salah !!');
                return redirect()->back();
            }
        } else {
            $this->session->setFlashdata('error_login', 'Email Atau Password Salah !!');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/index');
    }
}
