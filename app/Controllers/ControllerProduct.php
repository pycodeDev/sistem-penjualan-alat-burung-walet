<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

class ControllerProduct extends BaseController
{
    protected $crud;
    protected $session;
	public function __construct()
	{
        $this->session = session();
		$this->crud = new ModelCrud();
	}

    public function index($id = null, $metode = null)
    {
        if ($id == null) {
            $id = 0;
            $metode = "";
        }
        $data['title'] = "Data Product";
        $this->crud->setParamDataPagination("tbl_product tp",$id,$metode,"tbl_product_category tpc", "tp.category_id=tpc.id", "tp.id, tp.name, tp.price, tp.stok, tp.image, tp.created_at, tp.updated_at, tpc.name as category_name");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/product/index', $data);
    }
    
    public function detail($id_product, $id = null, $metode = null)
    {
        if ($id == null) {
            $id = 0;
            $metode = "";
        }
        $data['title'] = "Detail Product";
        $this->crud->setParamDataPagination("tbl_comment tm",$id,$metode,"tbl_user tu", "tm.user_id=tu.id", "tm.id, tm.user_id, tm.product_id, tm.comment, tm.created_at, tu.name as name_user", "product_id", $id_product);

        $data_comment = $this->crud->data_pagination();

        $this->crud->setParamDataPagination("tbl_product tp",0,"","tbl_product_category tpc", "tp.category_id=tpc.id", "tp.id, tp.name, tp.price, tp.stok, tp.image, tp.created_at, tp.updated_at, tpc.name as category_name, tp.deskripsi", "tp.id", $id_product);
        $product = $this->crud->data_pagination();
        
        $data['prd']=$product['data'][0];
        $data['data'] = $data_comment["data"];
        $data['next'] = $data_comment["last_id"];
        $data['back'] = $data_comment["first_id"];

        return view('admin/content/product/detail-product', $data);
    }
    
    public function add()
    {
        $data['title'] = "Add Data Product";
        $this->crud->setParamDataPagination("tbl_product_category");

        $data['data'] = $this->crud->read_all_data();

        return view('admin/content/product/add-data', $data);
    }
    
    public function edit($id)
    {
        $data['title'] = "Edit Data Product";
        $this->crud->setParamDataPagination("tbl_product");
        $product = $this->crud->select_1_cond("id", $id);
        $data['data']=$product[0];
        
        $this->crud->setParamDataPagination("tbl_product_category");
        $data['cat_product'] = $this->crud->read_all_data();

        return view('admin/content/product/edit-data', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $product['category_id'] = $data['category_id'];
        $product['name'] = $data['name'];
        $product['price'] = $data['price'];
        $product['stok'] = $data['stok'];
        $product['image'] = $data['image'];
        $product['created_at'] = $waktuSekarang;
        $product['updated_at'] = $waktuSekarang;

        $this->crud->save_data('tbl_product', $product);
        $this->session->setFlashdata('success', 'Product Data Sucess Save');

        return redirect()->to("/product/data-product");
    }

    public function update()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $product['category_id'] = $data['category_id'];
        $product['name'] = $data['name'];
        $product['price'] = $data['price'];
        $product['stok'] = $data['stok'];
        $product['image'] = $data['image'];
        $product['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_product");
        $this->crud->update_data($product, "id", $data['id']);
        $this->session->setFlashdata('success', 'Product Data Sucess Update');

        return redirect()->to("/product/data-product");
    }

    public function delete($id)
    {
        if ($id == 0) {
            $this->session->setFlashdata('error', 'Product Data Failed to Delete');
            return redirect()->to("/product/data-product");
        }

        $this->crud->setParamDataPagination("tbl_product");
        $this->crud->delete_data($id);

        $this->session->setFlashdata('success', 'Product Data Sucess Delete');
        return redirect()->to("/product/data-product");
    }

    public function client_index($id = null, $metode = null, $search="")
    {
        if ($id == null) {
            $id = 0;
            $metode = "";
        }
        if ($search != "") {
            $where = "name";
        }else{
            $where="";
        }

        $data['title'] = "Data Product";
        $this->crud->setParamDataPagination("tbl_product tp",$id,$metode,"tbl_product_category tpc", "tp.category_id=tpc.id", "tp.id, tp.name, tp.price, tp.stok, tp.image, tp.created_at, tp.updated_at, tpc.name as category_name", $where, $search);

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];
        
        return view('users/content/product', $data);
    }
    
    public function client_detail($id = null, $last_id=0,$metode="")
    {
        $data['title'] = "Data Product";
        $this->crud->setParamDataPagination("tbl_product tp",0,"","tbl_product_category tpc", "tp.category_id=tpc.id", "tp.id, tp.name, tp.price, tp.stok, tp.image, tp.created_at, tp.updated_at, tpc.name as category_name,tp.deskripsi", "tp.id", $id);

        $data_product = $this->crud->data_pagination();
        
        $this->crud->setParamDataPagination("tbl_comment tc",$last_id,$metode,"tbl_user tu", "tc.user_id=tu.id", "tc.id, tc.user_id, tc.product_id, tc.comment, tc.created_at, tu.name", "tc.product_id", $id);
        $komen = $this->crud->data_pagination();

        $data['data'] = $data_product["data"][0];
        $data['comments'] = $komen;
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('users/content/detail-product', $data);
    }
}
