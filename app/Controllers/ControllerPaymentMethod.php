<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

class ControllerPaymentMethod extends BaseController
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
        $data['title'] = "Data Payment Method";
        $this->crud->setParamDataPagination("tbl_payment_method");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/payment/index', $data);
    }

    public function add()
    {
        $data['title'] = "Add Data Payment";

        return view('admin/content/payment/add-data', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $pm['name'] = $data['name'];
        $pm['image'] = $data['image'];
        $pm['rekening'] = $data['rek_num'];
        $pm['rekening_name'] = $data['rek_name'];
        $pm['status'] = $data['status'];
        $pm['created_at'] = $waktuSekarang;
        $pm['updated_at'] = $waktuSekarang;

        $this->crud->save_data('tbl_payment_method', $pm);
        $this->session->setFlashdata('success', 'Payment Data Sucess Save');

        return redirect()->to("/payment/data-payment");
    }

    public function edit($id)
    {
        if ($id == 0) {
            $this->session->setFlashdata('error', 'Payment Data Failed to Edit');
            return redirect()->to("/payment/data-payment");
        }
        $data['title'] = "Edit Data Payment Method";
        $this->crud->setParamDataPagination("tbl_payment_method");
        $cp=$this->crud->select_1_cond("id", $id);
        $data['data'] = $cp[0];

        return view('admin/content/payment/edit-data', $data);
    }

    public function update()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();

        $pm['name'] = $data['name'];
        $pm['image'] = $data['image'];
        $pm['rekening'] = $data['rek_num'];
        $pm['rekening_name'] = $data['rek_name'];
        $pm['status'] = $data['status'];
        $pm['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_payment_method");
        $this->crud->update_data($pm, "id", $data['id']);
        $this->session->setFlashdata('success', 'Payment Method Data Sucess Update');

        return redirect()->to("/payment/data-payment");
    }

    public function delete($id)
    {
        if ($id == 0) {
            $this->session->setFlashdata('error', 'Payment Method Data Failed to Delete');
            return redirect()->to("/payment/data-payment");
        }

        $this->crud->setParamDataPagination("tbl_payment_method");
        $this->crud->delete_data($id);

        $this->session->setFlashdata('success', 'Payment Method Data Sucess Delete');
        return redirect()->to("/payment/data-payment");
    }
}
