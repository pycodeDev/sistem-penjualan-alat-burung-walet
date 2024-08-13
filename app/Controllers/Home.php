<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $session;

	public function __construct()
	{
        $this->session = session();
	}

    public function index()
    {
        // Cek apakah pengguna sudah login
        if (!$this->session->get('logged_in')) {
            return redirect()->to('auth/index');
        }
        return view('admin/content/dashboard');
    }
    
    public function tes(): string
    {
        return view('admin/content/dashboard');
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
