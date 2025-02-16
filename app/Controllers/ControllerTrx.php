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
    protected $db;
	public function __construct()
	{
        $this->db = \Config\Database::connect(); // Koneksi DB
        $this->session = session();
		$this->crud = new ModelCrud();
	}

    public function graph()
    {
        $currentDate = new \DateTime();
        $jumlah = [];

        for ($i = 1; $i <= 12; $i++) { 
            $bulan = $currentDate->format('F'); // Format bulan dan tahun
            $search = $currentDate->format('Y-m'); // Format untuk pencarian di query
            $currentDate->modify('-1 month'); // Mundur 1 bulan

            // Query untuk mendapatkan total transaksi
            $data_trx = $this->crud->solo_query("SELECT COUNT(id) as total FROM tbl_trx WHERE created LIKE '%$search%'");

            // Menambahkan data ke array $jumlah
            $jumlah[] = [
                'bulan' => $bulan,
                'total' => isset($data_trx[0]['total']) ? $data_trx[0]['total'] : 0, // Pastikan total ada
            ];
        }

        // Mengembalikan data dalam format JSON
        return $this->response->setJSON(['data' => $jumlah]);
    }

    public function search()
    {
        $trx_id = $this->request->getPost('trx_id');
        $status = $this->request->getPost('status');
        $trx_date = $this->request->getPost('trx_date');

        // Awal query dengan JOIN
        $query = "SELECT tbl_trx.*, COUNT(tbl_trx_item.id) AS total_produk 
                FROM tbl_trx 
                LEFT JOIN tbl_trx_item ON tbl_trx.trx_id = tbl_trx_item.trx_id";
        
        $conditions = [];

        // Tambahkan kondisi jika ada input
        if (!empty($trx_id)) {
            $conditions[] = "tbl_trx.trx_id = " . $this->db->escape($trx_id);
        }
        if (!empty($status)) {
            $conditions[] = "tbl_trx.status = " . $this->db->escape($status);
        }
        if (!empty($trx_date)) {
            $conditions[] = "tbl_trx.created LIKE '%" . $this->db->escapeLikeString($trx_date) . "%'";
        }

        // Gabungkan kondisi jika ada
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        // Grouping berdasarkan transaksi
        $query .= " GROUP BY tbl_trx.id";
        // Tambahkan ini sebelum eksekusi query
        log_message('debug', 'Query Search: ' . $query);

        // Jalankan query
        $data_trx = $this->crud->solo_query($query);

        // Kembalikan hasil dalam format JSON
        return $this->response->setJSON([
            'data' => $data_trx
        ]);
    }

    public function filter()
    {
        if ($this->request->isAJAX()) {
            $trx_id = $this->request->getPost('trx_id');
            $status = $this->request->getPost('status');
            $trx_date = $this->request->getPost('trx_date');

            $query = "SELECT status, COUNT(id) AS total_trx, SUM(total) AS total_produk 
                    FROM tbl_trx WHERE 1=1";

            if (!empty($trx_date)) {
                $query .= " AND DATE(created) = '$trx_date'";
            }

            if (!empty($trx_id)) {
                $query .= " AND trx_id = '$trx_id'";
            }

            if (!empty($status)) {
                $query .= " AND status = '$status'";
            }

            $query .= " GROUP BY status";
            log_message('debug', 'Query Search: ' . $query);
            $data_trx = $this->crud->solo_query($query);

            // Inisialisasi data default jika tidak ada hasil
            $result = [
                'total' => 0,
                'pending' => 0,
                'konfirm' => 0,
                'shipping' => 0,
                'success' => 0,
                'failed' => 0
            ];

            // Mapping hasil query ke dalam result
            if ($data_trx) {
                foreach ($data_trx as $trx) {
                    switch ($trx['status']) {
                        case 'PENDING':
                            $result['pending'] = $trx['total_trx'];
                            break;
                        case 'KONFIRM':
                            $result['konfirm'] = $trx['total_trx'];
                            break;
                        case 'SHIPPING':
                            $result['shipping'] = $trx['total_trx'];
                            break;
                        case 'SUCCESS':
                            $result['success'] = $trx['total_trx'];
                            break;
                        case 'FAILED':
                            $result['failed'] = $trx['total_trx'];
                            break;
                    }
                    $result['total'] += $trx['total_trx'];
                }
            }

            return $this->response->setJSON(['success' => true, 'data' => $result]);
        }

        return $this->response->setJSON(['success' => false]);
    }




    public function index($id = null, $metode = null)
    {
        if ($id == null) {
            $id = 0;
            $metode = "";
        }
        
        $data['title'] = "Data Trx";
        $this->crud->setParamDataPagination("tbl_trx",$id,$metode,"","","","","","id");
        
        $data_product = $this->crud->data_pagination();
        $data['data'] = $data_product["data"];
        $data['next'] = $data_product["last_id"];
        $data['back'] = $data_product["first_id"];
        
        $query = "SELECT status, COUNT(id) AS total_trx, SUM(total) AS total_produk 
              FROM tbl_trx 
              WHERE DATE(created) = CURDATE() 
              AND status IN ('PENDING', 'KONFIRM', 'SHIPPING', 'SUCCESS', 'FAILED') 
              GROUP BY status";

        $data_trx = $this->crud->solo_query($query);

        // Inisialisasi default jika tidak ada data
        $data = [
            'tgl'      => date('Y-m-d'), // Tanggal hari ini
            'total'    => 0,
            'pending'  => 0,
            'konfirm'  => 0,
            'shipping' => 0,
            'success'  => 0,
            'failed'   => 0,
            'next' => $data_product["first_id"],
            'back' => $data_product["last_id"],
            'data' => $data_product["data"]
        ];

        // Loop hasil query dan simpan ke variabel sesuai statusnya
        foreach ($data_trx as $row) {
            if ($row['status'] == 'PENDING') {
                $data['pending'] = $row['total_trx'];
            } elseif ($row['status'] == 'KONFIRM') {
                $data['konfirm'] = $row['total_trx'];
            } elseif ($row['status'] == 'SHIPPING') {
                $data['shipping'] = $row['total_trx'];
            } elseif ($row['status'] == 'SUCCESS') {
                $data['success'] = $row['total_trx'];
            } elseif ($row['status'] == 'FAILED') {
                $data['failed'] = $row['total_trx'];
            }

            // Hitung total dari semua transaksi
            $data['total'] += $row['total_trx'];
        }

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
        $this->crud->setParamDataPagination("tbl_payment_confirm",$id,$metode,"","","","","","id");

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

    public function client_index($id = 0,$metode=""){
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

        if (!empty($this->request->getPost('trx_id'))) {
            $search = $this->request->getPost('trx_id');
            $query .= " and trx_id = '$search' ";
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

        $this->crud->setParamDataPagination("tbl_payment_method");
        $data_payment = $this->crud->read_all_data();

        if (count($data_trx_item) == 1) {
            $this->crud->setParamDataPagination("tbl_comment tc",0,"","tbl_user tu", "tc.user_id=tu.id", "tc.id, tc.user_id, tc.product_id, tc.comment, tc.created_at, tu.name", "tc.product_id =", $data_trx_item[0]['barang_id']);
            $komen = $this->crud->data_pagination();    

            $data['comments'] = $komen;
        }
        

        $data['trx'] = $data_trx[0];
        $data['trx_item'] = $data_trx_item;
        $data['payment_data'] = $data_payment;

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

            $waktuSekarang = Time::now();
            $created = explode(" ", $waktuSekarang);

            $data = $this->request->getPost();
            $payment_confirm['trx_id'] = $data['trx_id'];
            $payment_confirm['image'] = $fileURL;
            $payment_confirm['status'] = 'PENDING';
            $payment_confirm['created'] = $created[0];
            $payment_confirm['created_at'] = $waktuSekarang;
            $payment_confirm['updated_at'] = $waktuSekarang;

            $this->crud->save_data('tbl_payment_confirm', $payment_confirm);
            $waktuSekarang = Time::now();

            if ($data['is_rekening'] == 0) {
                $rekening['name']= $data['payment_method_name'];
                $rekening['user_id']= $this->session->get('id');
                $rekening['rekening']= $data['rekening'];
                $rekening['rekening_name']= $data['rekening_name'];
                $rekening['status']= 1;
                $rekening['created_at']= $waktuSekarang;
                $rekening['updated_at'] = $waktuSekarang;
                $id_rek = $this->crud->save_data_return('tbl_rekening', $rekening);
            }else{
                $id_rek = $data['is_rekening'];
            }

            $trx['status'] = "CONFIRM";
            $trx['updated_at'] = $waktuSekarang;
            $trx['rek_name'] = $data['rekening_name'];
            $trx['rek_id'] = $id_rek;
            $trx['rek_number'] = $data['rekening'];
            $trx['payment_method_id'] = $data['payment_method_id'];
            $trx['payment_method_name'] = $data['payment_method_name'];
            $trx['payment_method_number'] = $data['payment_method_number'];
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

    public function order()
    {
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return $this->response->setJSON(['success' => false]);
        }
        $request = service('request');

        $tipe = $request->getJSON()->is_cart;
        
        $uid =$this->session->get('id');
        $waktuSekarang = Time::now();
        $created = explode(" ", $waktuSekarang);

        //user
        $this->crud->setParamDataPagination("tbl_user");
        $user = $this->crud->select_1_cond("id", $uid);

        $trx_id = $this->crud->generateString("trx");
        if ($tipe == 0) {
            $produk_id = $request->getJSON()->product_id;
            $qty = $request->getJSON()->quantity;

            $trx_id_item = $this->crud->generateString("trx_item");
            //product
            $this->crud->setParamDataPagination("tbl_product");
            $produk = $this->crud->select_1_cond("id", $produk_id);

            $price = $qty * $produk[0]['price'];
            if ($produk[0]['stok'] < $qty) {
                $this->session->setFlashdata('err_msg', 'Maaf, Stok Tidak Mencukupi !');
                return $this->response->setJSON(['success' => false]);
            }
            
            $trx_item['trx_id'] = $trx_id;
            $trx_item['item_id'] = $trx_id_item;
            $trx_item['barang_id'] = $produk_id;
            $trx_item['nama_barang'] = $produk[0]['name'];
            $trx_item['qty'] = $qty;
            $trx_item['price'] = $price;
            $trx_item['created']=$created[0];
            $trx_item['created_at']= $waktuSekarang;
            $trx_item['updated_at']= $waktuSekarang;

            $this->crud->save_data('tbl_trx_item', $trx_item);
            $this->crud->solo_query("update tbl_product set stok = stok - $qty where id = $produk_id");
        }else{ 
            $qty = 0;
            $success = 0;
            $fail = 0;
            $price = 0;
            $this->crud->setParamDataPagination("tbl_cart");
            $cart = $this->crud->select_1_cond("user_id", $uid);
            if (count($cart) == 0) {
                $this->session->setFlashdata('err_msg', 'Maaf, Cart Anda Kosong !');
                return $this->response->setJSON(['success' => false]);
            }
            foreach ($cart as $cart_item) {
                $trx_id_item = $this->crud->generateString("trx_item");  

                $this->crud->setParamDataPagination("tbl_product");
                $produk = $this->crud->select_1_cond("id", $cart_item['product_id']);

                $price_item = $cart_item['qty'] * $produk[0]['price'];
                if ($produk[0]['stok'] > $qty) {
                    $trx_item['trx_id'] = $trx_id;
                    $trx_item['item_id'] = $trx_id_item;
                    $trx_item['barang_id'] = $cart_item['product_id'];
                    $trx_item['nama_barang'] = $produk[0]['name'];
                    $trx_item['qty'] = $cart_item['qty'];
                    $trx_item['price'] = $price_item;
                    $trx_item['created']=$created[0];
                    $trx_item['created_at']= $waktuSekarang;
                    $trx_item['updated_at']= $waktuSekarang;
                    $qty = $cart_item['qty'] + $qty;

                    $stok = $cart_item['qty'];
                    $id_p = $cart_item['product_id'];

                    $this->crud->save_data('tbl_trx_item', $trx_item);
                    $this->crud->solo_query("update tbl_product set stok = stok - $stok where id = $id_p");

                    $this->crud->setParamDataPagination("tbl_cart");
                    $this->crud->delete_data($cart_item['id']);
                    $success = $success + 1;
                }else {
                    $fail = $fail + 1;
                }
                $price = $price + $price_item;
            }
        }

        if ($tipe == 1) {
            if ($success != 0) {
                $trx['trx_id'] = $trx_id;
                $trx['user_id'] = $uid;
                $trx['nama_user'] = $user[0]['name'];
                $trx['total'] = $qty;
                $trx['price'] = $price;
                $trx['status'] = "PENDING";
                $trx['created']=$created[0];
                $trx['created_at']= $waktuSekarang;
                $trx['updated_at']= $waktuSekarang;
                $this->crud->save_data('tbl_trx', $trx);
                $this->session->setFlashdata('msg', 'Silahkan Pilih Metode Pembayaran');
        
                return $this->response->setJSON(['success' => true, 'trx_id' => $trx_id]);
            }else {
                $this->session->setFlashdata('msg', 'Maaf Transaksi Tidak di proses !!');
        
                return $this->response->setJSON(['success' => false]);
            }
        }else{
            $trx['trx_id'] = $trx_id;
            $trx['user_id'] = $uid;
            $trx['nama_user'] = $user[0]['name'];
            $trx['total'] = $qty;
            $trx['price'] = $price;
            $trx['status'] = "PENDING";
            $trx['created']=$created[0];
            $trx['created_at']= $waktuSekarang;
            $trx['updated_at']= $waktuSekarang;
            $this->crud->save_data('tbl_trx', $trx);
            $this->session->setFlashdata('msg', 'Silahkan Pilih Metode Pembayaran');
    
            return $this->response->setJSON(['success' => true, 'trx_id' => $trx_id]);
        }
    }

    public function complete_trx($trx_id)
    {
        $waktuSekarang = Time::now();

        $trx['status'] = "SUCCESS";
        $trx['updated_at'] = $waktuSekarang;
        $this->crud->setParamDataPagination("tbl_trx");
        $this->crud->update_data($trx, "trx_id", $trx_id);

        $this->session->setFlashdata('msg', 'Berhasil Menyelesaikan Transaksi !!');
        return redirect()->to("/client/trx/$trx_id");
    }

    public function review()
    {
        if (!$this->session->get('logged_in_user')) {
            $this->session->setFlashdata('err_msg', 'Silahkan Login Dahulu');
            return redirect()->to('/client/home');
        }

        $data = $this->request->getPost();
        $waktuSekarang = Time::now();
        $uid =$this->session->get('id');
        $rvw['user_id'] = $uid;
        $rvw['product_id'] = $data['product_id'];
        $rvw['comment'] = $data['comment'];
        $rvw['created_at']= $waktuSekarang;
        $rvw['updated_at']= $waktuSekarang;
        $trx_id = $data['trx_id'];
        $this->crud->save_data('tbl_comment', $rvw);
        $this->session->setFlashdata('msg', 'Berhasil Menambahkan Review !');
        return redirect()->to("/client/trx/$trx_id");
    }
}
