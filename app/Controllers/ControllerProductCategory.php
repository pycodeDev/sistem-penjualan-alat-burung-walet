<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use App\Models\ModelCrud;

class ControllerProductCategory extends BaseController
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
        $data['title'] = "Data Product Category";
        $this->crud->setParamDataPagination("tbl_product_category",$id,$metode,"","","","","","id");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/product-category/index', $data);
    }

    public function add()
    {
        $data['title'] = "Add Data Product Category";

        return view('admin/content/product-category/add-data', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $product['name'] = $data['name'];
        $product['created_at'] = $waktuSekarang;
        $product['updated_at'] = $waktuSekarang;

        $this->crud->save_data('tbl_product_category', $product);
        $this->session->setFlashdata('success', 'Product Category Data Sucess Save');

        return redirect()->to("/product/category-product");
    }

    public function edit($id)
    {
        if ($id == 0) {
            $this->session->setFlashdata('error', 'Product Category Data Failed to Edit');
            return redirect()->to("/product/category-product");
        }
        $data['title'] = "Edit Data Product Category";
        $this->crud->setParamDataPagination("tbl_product_category");
        $cp=$this->crud->select_1_cond("id", $id);
        $data['data'] = $cp[0];

        return view('admin/content/product-category/edit-data', $data);
    }
    
    public function update()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $category_product['name'] = $data['name'];
        $category_product['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_product_category");
        $this->crud->update_data($category_product, "id", $data['id']);
        $this->session->setFlashdata('success', 'Product Category Data Sucess Update');

        return redirect()->to("/product/category-product");
    }

    public function delete($id)
    {
        if ($id == 0) {
            $this->session->setFlashdata('error', 'Product Category Data Failed to Delete');
            return redirect()->to("/product/category-product");
        }

        $this->crud->setParamDataPagination("tbl_product_category");
        $this->crud->delete_data($id);

        $this->session->setFlashdata('success', 'Product Category Data Sucess Delete');
        return redirect()->to("/product/category-product");
    }
}
