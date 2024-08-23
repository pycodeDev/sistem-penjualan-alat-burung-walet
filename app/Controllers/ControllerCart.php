<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

class ControllerCart extends BaseController
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
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return redirect()->to('/client/home');
        }

        $this->crud->setParamDataPagination("tbl_cart");
        $buyer = $this->crud->select_1_cond("user_id", $id);
        $data['data']=$buyer[0];
        $data['titel']= "Cart user";

        return view('users/content/riwayat-cart', $data);
    }
    
    public function add()
    {
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return $this->response->setJSON(['success' => false]);
        }

        $request = service('request');
        $waktuSekarang = Time::now();

        $cart['user_id'] = $this->session->get('id');
        $productId = $request->getJSON()->product_id;
        $quantity = $request->getJSON()->quantity;
        $cart['product_id'] = $productId;
        $cart['qty'] = $quantity;
        $cart['created_at'] = $waktuSekarang;
        $cart['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_product");
        $product = $this->crud->select_1_cond("id", $productId);
        if ($product[0]['stok'] < $quantity) {
            $this->session->setFlashdata('err_msg', 'Maaf Stok yang Tersisa hanya '. $product['stok']);
            return $this->response->setJSON(['success' => false]);
        }

        $this->crud->setParamDataPagination("tbl_product_category");
        $cart_user = $this->crud->read_all_data();
        if (count($cart_user) > 5) {
            $this->session->setFlashdata('err_msg', 'Maaf Jumlah Product Yang Ada di Keranjang tidak boleh lebih dari 5');
            return $this->response->setJSON(['success' => false]);
        }

        $this->crud->save_data('tbl_cart', $cart);
        $this->session->setFlashdata('msg', 'Success Add Cart');
        return $this->response->setJSON(['success' => true]);
    }
    
    public function edit($id)
    {
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return redirect()->to('/client/home');
        }

        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $cart['qty'] = $data['qty'];
        $cart['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_cart");
        $this->crud->update_data($cart, "id", $id);
        $this->session->setFlashdata('msg', 'Success Edit Cart');

        return redirect()->to("/client/cart");
    }
    
    public function delete($id)
    {
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return redirect()->to('/client/home');
        }

        $this->crud->setParamDataPagination("tbl_cart");
        $this->crud->delete_data($id);

        return redirect()->to("/client/cart");
    }
}
