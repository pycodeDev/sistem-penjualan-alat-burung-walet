<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;
use CodeIgniter\I18n\Time;
use CodeIgniter\Files\File;


class ControllerTrx extends BaseController
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
        $data['title'] = "Data Trx";
        $this->crud->setParamDataPagination("tbl_trx");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/trx/index', $data);
    }
    
    public function detail($trx_id)
    {
        if ($trx_id == null || $trx_id == "") {
            $this->session->setFlashdata('error', 'Trx Id Not Found');

            return redirect()->to("/trx/data-trx");
        }
        $data['title'] = "Detail Trx";
        $this->crud->setParamDataPagination("tbl_trx");
        $trx = $this->crud->select_1_cond("trx_id", $trx_id);

        $user_id = $trx[0]['user_id'];
        $this->crud->setParamDataPagination("tbl_user");
        $user = $this->crud->select_1_cond("id", $user_id);
        
        $this->crud->setParamDataPagination("tbl_trx_item");
        $data['item'] = $this->crud->select_1_cond("trx_id", $trx_id);
        $data['trx'] = $trx[0];
        $data['user'] = $user[0];

        return view('admin/content/trx/detail-trx', $data);
    }

    public function confirm_trx($id = null, $metode = null)
    {
        if ($id == null) {
            $id = 0;
            $metode = "";
        }
        $data['title'] = "Data Trx Confirm";
        $this->crud->setParamDataPagination("tbl_payment_confirm");

        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];

        return view('admin/content/confirm-trx/index', $data);
    }
    
    public function detail_confirm_trx($trx_id)
    {
        if ($trx_id == null || $trx_id == "") {
            $this->session->setFlashdata('error', 'Trx Id Not Found');

            return redirect()->to("/trx/data-trx");
        }
        $data['title'] = "Detail Trx";
        $this->crud->setParamDataPagination("tbl_trx");
        $trx = $this->crud->select_1_cond("trx_id", $trx_id);

        $rek_id = $trx[0]['rek_id'];
        $this->crud->setParamDataPagination("tbl_rekening");
        $rekening = $this->crud->select_1_cond("id", $rek_id);
        
        $this->crud->setParamDataPagination("tbl_payment_confirm");
        $data['pc'] = $this->crud->select_1_cond("trx_id", $trx_id)[0];
        $data['trx'] = $trx[0];
        $data['rek'] = $rekening[0];

        return view('admin/content/confirm-trx/confirm-detail-trx', $data);
    }

    public function action_confirm_trx()
    {
        $data = $this->request->getPost();
        $waktuSekarang = Time::now();
        $status = $data['status'];
        
        if ($status == "SUCCESS") {
            $status_trx = "SHIPPING";
            $this->session->setFlashdata('success', 'Success Approve Payment');
        }else {
            $status_trx = "FAILED";
            $this->session->setFlashdata('success', 'Success Reject Payment');
        }

        
        $trx_id = $data['trx_id'];

        $payment_confirm['note'] = $data['note'];
        $payment_confirm['status'] = $status;

        $this->crud->setParamDataPagination("tbl_payment_confirm");
        $this->crud->update_data($payment_confirm, "id", $data['id']);

        $trx['status'] = $status_trx;
        $trx['updated_at'] = $waktuSekarang;

        $this->crud->setParamDataPagination("tbl_trx");
        $this->crud->update_data($trx, "trx_id", $data['trx_id']);

        return redirect()->to("/trx/trx-confirm/$trx_id");
    }

    public function client_index($search = "", $id = 0, $metode = ""){
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return redirect()->to('/client/home');
        }

        $data['title']="Riwayat Transaction";

        $id =$this->session->get('id');

        $query = "select * from tbl_trx where user_id = '$id' ";
        if ($metode == "next") {
            $query .= " or id < $id ";
        }else if ($metode == "back") {
            $query .= " or id < $id ";
        }

        if ($search != "") {
            $query .= " or trx_id = '$search' ";
        }

        $query .= " order by id DESC LIMIT 10";

        $data_trx = $this->crud->solo_query($query);

        $ids = array_column($data_trx, 'id');
        
        $first_id = !empty($ids) ? reset($ids) : null; // Ambil ID pertama
        $last_id = !empty($ids) ? end($ids) : null; // Ambil ID terakhir

        $data['data'] = $data_trx;
        $data['next'] = $last_id;
        $data['back'] = $first_id;

        return view('users/content/riwayat-trx', $data);
    }
    
    public function client_detail($trx_id){
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return redirect()->to('/client/home');
        }

        $data['title']="Detail Transaction #$trx_id";

        $this->crud->setParamDataPagination("tbl_trx");
        $data_trx = $this->crud->select_1_cond("trx_id", $trx_id);

        $this->crud->setParamDataPagination("tbl_trx_item");
        $data_trx_item = $this->crud->select_1_cond("trx_id", $trx_id);

        $data['trx'] = $data_trx[0];
        $data['trx_item'] = $data_trx_item;

        return view('users/content/detail-trx', $data);
    }

    public function upload()
    {
        // Ambil file yang diupload
        $image = $this->request->getFile('image');

        // Pastikan file ada
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Generate nama file yang unik
            $newName = $image->getRandomName();

            // Pindahkan file ke direktori tujuan
            $image->move(WRITEPATH . 'uploads', $newName);

            // $image->move(ROOTPATH . 'upload', $newName); //jika ingin diluar folder writable

            // Kompresi gambar
            $this->compressImage(WRITEPATH . 'uploads/' . $newName);
            $fileURL = base_url('upload/' . $newName);

            $data = $this->request->getPost();
            $payment_confirm['trx_id'] = $data['trx_id'];
            $payment_confirm['image'] = $fileURL;
            $payment_confirm['status'] = 'PENDING';

            $this->crud->save_data('tbl_payment_confirm', $payment_confirm);
            $waktuSekarang = Time::now();

            $trx['status'] = "CONFIRM";
            $trx['updated_at'] = $waktuSekarang;
            $this->crud->setParamDataPagination("tbl_trx");
            $this->crud->update_data($trx, "trx_id", $data['trx_id']);

            return redirect()->back()->with('msg', 'Berhasil Upload Bukti Pembayaran');
        }

        return redirect()->back()->with('err_msg', 'Gagal Upload Bukti Pembayaran!');
    }

    private function compressImage($filePath)
    {
        // Load layanan Image Manipulation
        $image = \Config\Services::image()
            ->withFile($filePath)
            ->resize(800, 800, true, 'auto') // Ubah ukuran gambar (lebar x tinggi)
            ->save($filePath, 75); // Simpan gambar dengan kualitas 75%
    }

    public function show($filename)
    {
        $filePath = WRITEPATH . 'uploads/' . $filename;

        if (file_exists($filePath)) {
            // Menentukan tipe konten berdasarkan ekstensi file
            $mimeType = mime_content_type($filePath);
            return $this->response
                ->setHeader('Content-Type', $mimeType)
                ->setBody(file_get_contents($filePath));
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($filename);
        }
    }
}
