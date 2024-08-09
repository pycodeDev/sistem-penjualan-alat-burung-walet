<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('admin/index');
    }
    
    public function tes(): string
    {
        return view('admin/content/dashboard');
    }
    
    public function prd(): string
    {
        return view('admin/content/trx/detail');
    }
    
    public function prdd(): string
    {
        return view('admin/content/dashboard');
    }
}
