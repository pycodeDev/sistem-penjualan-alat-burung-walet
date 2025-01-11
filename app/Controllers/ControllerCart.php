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

        $id =$this->session->get('id');

        $this->crud->setParamDataPagination("tbl_cart tc",0,"","tbl_product tp", "tc.product_id=tp.id", "tc.id, tc.user_id, tc.product_id, tc.qty, tc.created_at, tc.updated_at, tp.name, tp.price, (tp.price * tc.qty) as harga", "tc.user_id =", $id);

        $buyer = $this->crud->data_pagination();
        $totalSum = array_sum(array_column($buyer['data'], 'harga'));

        $data['data']=$buyer['data'];
        $data['total_cart']=$totalSum;
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

        $this->crud->setParamDataPagination("tbl_cart");
        $cart_user = $this->crud->read_all_data();
        if (count($cart_user) > 3) {
            $this->session->setFlashdata('err_msg', 'Maaf Jumlah Product Yang Ada di Keranjang tidak boleh lebih dari 3');
            return $this->response->setJSON(['success' => false]);
        }

        $this->crud->save_data('tbl_cart', $cart);
        $this->session->setFlashdata('msg', 'Success Add Cart');
        return $this->response->setJSON(['success' => true]);
    }
    
    public function edit()
    {
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return $this->response->setJSON(['success' => false]);
        }

        $request = service('request');
        $id_cart = $request->getJSON()->id_cart;
        $quantity = $request->getJSON()->qty;
        $waktuSekarang = Time::now();

        $cart['qty'] = (int)$quantity;
        $cart['updated_at'] =$waktuSekarang;

        $this->crud->setParamDataPagination("tbl_cart");
        $this->crud->update_data($cart, "id", $id_cart);
        $this->session->setFlashdata('msg', 'Success Edit Cart');

        return $this->response->setJSON(['success' => true]);
    }

    public function updateCart()
    {
        $request = $this->request->getJSON(true);

        if (!isset($request['cart_items'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak valid']);
        }

        foreach ($request['cart_items'] as $item) {
            $id_cart = $item['id_cart'];
            $qty = $item['qty'];

            $this->crud->solo_query("UPDATE tbl_cart SET qty = $qty WHERE id = $id_cart");
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Keranjang berhasil diperbarui']);
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
