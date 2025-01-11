<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

class ControllerBuyer extends BaseController
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
        $data['title'] = "Data Buyer";
        $this->crud->setParamDataPagination("tbl_buyer tby", $id, $metode, "tbl_supplier ts", "tby.supplier_id=ts.id", "tby.id, tby.buyer_id, tby.name, tby.qty, tby.price, ts.name as supplier_name","","","tby.id");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/buyer/index', $data);
    }

    public function add()
    {
        $data['title'] = "Add Data Buyer";

        $this->crud->setParamDataPagination("tbl_supplier");

        $data['data'] = $this->crud->read_all_data();

        $this->crud->setParamDataPagination("tbl_product");

        $data['data_product'] = $this->crud->read_all_data();

        return view('admin/content/buyer/add-data', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $buyer['buyer_id'] = $this->crud->generateString('buyer');
        $buyer['supplier_id'] = $data['sup_id'];

        $product = $data['product'];
        $get_product = explode("|", $product);

        $buyer['name'] = $get_product[1];
        $buyer['product_id'] = $get_product[0];
        $buyer['qty'] = $data['qty'];
        $buyer['price'] = $data['price'];
        $buyer['created_at'] = $waktuSekarang;
        $buyer['updated_at'] = $waktuSekarang;

        $this->crud->save_data('tbl_buyer', $buyer);
        $this->session->setFlashdata('success', 'Buyer Data Sucess Save');

        $qty = $data['qty'];
        $prd_id = $get_product[0];

        $this->crud->solo_query("update tbl_product set stok = stok + $qty where id = $prd_id");

        return redirect()->to("/supplier/data-buyer");
    }

    public function edit($id)
    {
        $data['title'] = "Edit Data Buyer";
        $this->crud->setParamDataPagination("tbl_buyer");
        $buyer = $this->crud->select_1_cond("id", $id);
        $data['data']=$buyer[0];

        $this->crud->setParamDataPagination("tbl_supplier");
        $data['supplier'] = $this->crud->read_all_data();

        return view('admin/content/buyer/edit-data', $data);
    }

    public function update()
    {
        $data = $this->request->getRawInput();
        $waktuSekarang = Time::now();

        $buyer['supplier_id'] = $data['sup_id'];
        $buyer['name'] = $data['name'];
        $buyer['qty'] = $data['qty'];
        $buyer['price'] = $data['price'];
        $buyer['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_buyer");
        $this->crud->update_data($buyer, "id", $data['id']);
        $this->session->setFlashdata('success', 'Buyer Data Sucess Update');

        return redirect()->to("/supplier/data-buyer");
    }

    public function delete($id)
    {
        if ($id == 0) {
            $this->session->setFlashdata('error', 'Buyer Data Failed to Delete');
            return redirect()->to("/supplier/data-buyer");
        }

        $this->crud->setParamDataPagination("tbl_buyer");
        $this->crud->delete_data($id);

        $this->session->setFlashdata('success', 'Buyer Data Sucess Delete');
        return redirect()->to("/supplier/data-buyer");
    }
}
