<?php

namespace App\Controllers;
use App\Models\ModelCrud;

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
        return view('users/register');
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
        
        $id = $this->crud->save_data_return('tbl_user', $product);
        $this->session->setFlashdata('success', 'Success Register Account');

        return redirect()->to("/product/data-product");
    }
}
