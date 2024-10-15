<?php

namespace App\Controllers;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    protected $crud;
    protected $session;
	public function __construct()
	{
        $this->session = session();
		$this->crud = new ModelCrud();
	}

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!$this->session->get('logged_in')) {
            return redirect()->to('auth/index');
        }

        $this->crud->setParamDataPagination("tbl_user");
        $user = $this->crud->read_all_data();

        $this->crud->setParamDataPagination("tbl_trx");
        $trx = $this->crud->read_all_data();

        $this->crud->setParamDataPagination("tbl_product");
        $product = $this->crud->read_all_data();

        $data['user'] = count($user);
        $data['trx'] = count($trx);
        $data['product'] = count($product);
        
        return view('admin/content/dashboard', $data);
    }
    
    public function tes(): string
    {
        $this->crud->setParamDataPagination("tbl_payment_method");
        $data_payment = $this->crud->read_all_data();
        $data['payment_data'] = $data_payment;
        return view('users/content/settings',$data);
    }
    
    public function login()
    {
        $data['title'] = "Login Marketplace";
        
        return view('users/login', $data);
    }

    public function register()
    {
        $data['title'] = "Register Marketplace";
        
        return view('users/register', $data);
    }
    
    public function p_register()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();
        
        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['hp'] = $data['hp'];
        $user['pass'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user['created_at'] = $waktuSekarang;
        $user['updated_at'] = $waktuSekarang;
        
        $id = $this->crud->save_data_return('tbl_user', $user);

        $this->session->set([
            'id' => $id,
            'email' => $user['email'],
            'name' => $user['name'],
            'logged_in_user' => TRUE
        ]);
        $this->session->setFlashdata('success', 'Success Register Account');
        return redirect()->to('/client/home');
    }

    public function p_login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $this->crud->setParamDataPagination("tbl_user");

        $data_user = $this->crud->select_1_cond("email", $email);

        $user = $data_user[0];

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['pass'])) {
                $this->session->set([
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'logged_in_user' => TRUE
                ]);
                $this->session->setFlashdata('success_login', 'Anda Berhasil Login, Selamat Datang '. $user['name']);
                return redirect()->to('/client/home');
            } else {
                $this->session->setFlashdata('error_login', 'Password salah');
                return redirect()->back();
            }
        } else {
            $this->session->setFlashdata('error_login', 'Email tidak ditemukan');
            return redirect()->back();
        }
    }
}
