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
    
    public function prd(): string
    {
        return view('admin/content/confirm-trx/confirm-detail-trx');
    }
    
    public function prdd(): string
    {
        return view('admin/content/dashboard');
    }
}
