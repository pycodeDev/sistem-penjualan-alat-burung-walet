<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;

class ControllerProduct extends BaseController
{
    protected $crud;
	public function __construct()
	{
		$this->crud = new ModelCrud();
	}

    public function index($id = null, $metode = null)
    {
        if ($id == null) {
            $id = 0;
            $metode = "";
        }
        $data['title'] = "Data Product";
        $this->crud->setParamDataPagination("tbl_product tp",$id,$metode,"tbl_product_category tpc", "tp.category_id=tpc.id", "tp.id, tp.name, tp.price, tp.stok, tp.image, tp.created_at, tp.updated_at, tpc.name");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/product/index', $data);
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
        $data['data']=$this->crud->select_1_cond("id", $id);
        
        $this->crud->setParamDataPagination("tbl_product_category");
        $data['cat_product'] = $this->crud->read_all_data();

        return view('admin/content/product/edit-data', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();

        $product['category_id'] = $data['category_id'];
        $product['name'] = $data['name'];
        $product['price'] = $data['price'];
        $product['stok'] = $data['stok'];
        $product['image'] = $data['image'];
        $product['created_at'] = $data['created_at'];
        $product['updated_at'] = $data['updated_at'];

        $this->crud->save_data('tbl_product', $product);

        return redirect()->to("/product/data-product");
    }
}
