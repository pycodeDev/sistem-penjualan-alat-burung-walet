<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;

class ControllerUser extends BaseController
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
        $data['title'] = "Data User";
        $this->crud->setParamDataPagination("tbl_user");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/user/index', $data);
    }
    
    public function detail($user_id)
    {
        if ($user_id == null || $user_id == "") {
            $this->session->setFlashdata('error', 'User Not Found');

            return redirect()->to("/user/data-user");
        }
        $data['title'] = "Detail User";
        $this->crud->setParamDataPagination("tbl_user");
        $user = $this->crud->select_1_cond("id", $user_id);

        $uid = $user[0]['id'];
        $this->crud->setParamDataPagination("tbl_rekening");
        $rekening = $this->crud->select_1_cond("user_id", $user_id);
        
        $this->crud->setParamDataPagination("tbl_trx");
        $data['trx'] = $this->crud->select_1_cond("user_id", $user_id);
        $data['user'] = $user[0];
        if (isset($rekening[0])) {
            $data['rek'] = $rekening[0];
        }else{
            $data['rek'] = [];
        }

        return view('admin/content/user/detail-user', $data);
    }

    public function dashboard_user($id = null, $metode = null, $search="")
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

        $this->crud->setParamDataPagination("tbl_product tp",$id,$metode,"tbl_product_category tpc", "tp.category_id=tpc.id", "tp.id, tp.name, tp.price, tp.stok, tp.image, tp.created_at, tp.updated_at, tpc.name as category_name", $where, $search);

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];
        $data['title'] = "Welcome To MarketPlace";

        $data_product_new = $this->crud->solo_query("select * from tbl_product order by id DESC limit 3");
        $data['new_product']=$data_product_new;

        return view('users/content/home', $data);
    }
}
