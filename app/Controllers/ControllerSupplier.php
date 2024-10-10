<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

class ControllerSupplier extends BaseController
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
        $data['title'] = "Data Supplier";
        $this->crud->setParamDataPagination("tbl_supplier",$id,$metode,"","","","","","id");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/supplier/index', $data);
    }

    public function add()
    {
        $data['title'] = "Add Data Supplier";

        return view('admin/content/supplier/add-data', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $product['name'] = $data['name'];
        $product['hp'] = $data['hp'];
        $product['created_at'] = $waktuSekarang;
        $product['updated_at'] = $waktuSekarang;

        $this->crud->save_data('tbl_supplier', $product);
        $this->session->setFlashdata('success', 'Supplier Data Sucess Save');

        return redirect()->to("/supplier/data-supplier");
    }

    public function edit($id)
    {
        $data['title'] = "Edit Data Supplier";
        $this->crud->setParamDataPagination("tbl_supplier");
        $product = $this->crud->select_1_cond("id", $id);
        $data['data']=$product[0];

        return view('admin/content/supplier/edit-data', $data);
    }

    public function update()
    {
        $data = $this->request->getRawInput();
        $waktuSekarang = Time::now();

        $supplier['name'] = $data['name'];
        $supplier['hp'] = $data['hp'];
        $supplier['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_supplier");
        $this->crud->update_data($supplier, "id", $data['id']);
        $this->session->setFlashdata('success', 'Supplier Data Sucess Update');

        return redirect()->to("/supplier/data-supplier");
    }

    public function delete($id)
    {
        if ($id == 0) {
            $this->session->setFlashdata('error', 'Supplier Data Failed to Delete');
            return redirect()->to("/supplier/data-supplier");
        }

        $this->crud->setParamDataPagination("tbl_supplier");
        $this->crud->delete_data($id);

        $this->session->setFlashdata('success', 'Supplier Data Sucess Delete');
        return redirect()->to("/supplier/data-supplier");
    }
}
