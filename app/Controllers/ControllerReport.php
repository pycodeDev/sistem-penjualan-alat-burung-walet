<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCrud;

class ControllerReport extends BaseController
{
    protected $crud;
	public function __construct()
	{
		$this->crud = new ModelCrud();
	}

    public function nota_pembelian($trx_id)
    {
        $this->crud->setParamDataPagination("tbl_trx");
        $data_trx = $this->crud->select_1_cond("trx_id", $trx_id);

        $this->crud->setParamDataPagination("tbl_trx_item");
        $data_trx_item = $this->crud->select_1_cond("trx_id", $trx_id);

        $this->crud->setParamDataPagination("tbl_user");
        $user = $this->crud->select_1_cond("id", $data_trx[0]['user_id']);

        $data['trx'] = $data_trx[0];
        $data['trx_item'] = $data_trx_item;
        $data['user'] = $user[0];

        return view('report/NotaPembelian', $data);
    }
    
    public function exportPdfNota($trx_id)
    {
        $this->crud->setParamDataPagination("tbl_trx");
        $data_trx = $this->crud->select_1_cond("trx_id", $trx_id);

        $this->crud->setParamDataPagination("tbl_trx_item");
        $data_trx_item = $this->crud->select_1_cond("trx_id", $trx_id);

        $this->crud->setParamDataPagination("tbl_user");
        $user = $this->crud->select_1_cond("id", $data_trx[0]['user_id']);

        $data['trx'] = $data_trx[0];
        $data['trx_item'] = $data_trx_item;
        $data['user'] = $user[0];

        // Load view ke dalam HTML
        $html = view('report/NotaPembelian', $data);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Mengatur opsi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Kirim file PDF ke browser untuk diunduh
        $dompdf->stream("nota_pembelian.pdf", ["Attachment" => true]);
    }
    
    public function index_view_supplier()
    {
        $data['title'] = "Data Buyer Supplier";

        return view('admin/content/report/ReportBuyer', $data);
    }
    
    public function index_view_trx()
    {
        $data['title'] = "Data Seller Product";

        return view('admin/content/report/ReportTrx', $data);
    }

    public function index_view_product()
    {
        $data['title'] = "Data Stock Product";

        return view('admin/content/report/ReportStok', $data);
    }

    public function index()
    {
        // Data laporan (bisa diambil dari database)
        $data = $this->crud->solo_query("SELECT buy.buyer_id, sup.name, buy.name as product_name, buy.qty, buy.price, buy.created_at, buy.updated_at from tbl_buyer buy left join tbl_supplier sup on buy.supplier_id=sup.id order by buy.id desc");

        // Menampilkan view laporan
        return view('report/ReportView', ['data' => $data]);
    }
    
    public function indexTrx()
    {
        // Data laporan (bisa diambil dari database)
        $data_trx = [];
        $data = $this->crud->solo_query("SELECT trx_id, nama_user, created_at, updated_at from tbl_trx where status = 'SUCCESS' order by id desc");

        foreach ($data as $trx) {
            $trx_id = $trx['trx_id'];
            $item_trx =$this->crud->solo_query("SELECT nama_barang, qty, price from tbl_trx_item where trx_id = '$trx_id' order by id desc");

            // Gabungkan data transaksi dengan itemnya
            $data_trx[] = [
                'trx_id'    => $trx['trx_id'],
                'nama_user' => $trx['nama_user'],
                'created_at' => $trx['created_at'],
                'updated_at' => $trx['updated_at'],
                'item'      => $item_trx,
            ];
        }
        // Menampilkan view laporan
        return view('report/ReportViewTrx', ['data' => $data_trx]);
    }
    
    public function indexStock()
    {
        $data = $this->crud->solo_query("SELECT name, price, stok, created_at, updated_at from tbl_product order by id desc");
        // Menampilkan view laporan
        return view('report/ReportViewProduct', ['data' => $data]);
    }

    public function exportPdf()
    {
        $data_post = $this->request->getPost();

        $start = $data_post['start_date']." "."00:00:00";
        $end = $data_post['end_date']." "."23:59:59";

        $data = $this->crud->solo_query("SELECT buy.buyer_id, sup.name, buy.name as product_name, buy.qty, buy.price, buy.created_at, buy.updated_at from tbl_buyer buy left join tbl_supplier sup on buy.supplier_id=sup.id where buy.created_at between '$start' and '$end'  order by buy.id desc");

        // Load view ke dalam HTML
        $html = view('report/ReportView', ['data' => $data]);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Mengatur opsi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Kirim file PDF ke browser untuk diunduh
        $dompdf->stream("Laporan_Data.pdf", ["Attachment" => true]);
    }
    
    public function exportPdfStok()
    {
        $data = $this->crud->solo_query("SELECT name, price, stok, created_at, updated_at from tbl_product order by id desc");

        // Load view ke dalam HTML
        $html = view('report/ReportViewProduct', ['data' => $data]);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Mengatur opsi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Kirim file PDF ke browser untuk diunduh
        $dompdf->stream("Laporan_Data.pdf", ["Attachment" => true]);
    }

    public function exportPdfTrx()
    {
        $data_post = $this->request->getPost();

        $start = $data_post['start_date'];
        $end = $data_post['end_date'];
        $data_trx = [];
        $data = $this->crud->solo_query("SELECT trx_id, nama_user, created_at, updated_at from tbl_trx where status = 'SUCCESS' and created between '$start' and '$end' order by id desc");

        foreach ($data as $trx) {
            $trx_id = $trx['trx_id'];
            $item_trx =$this->crud->solo_query("SELECT nama_barang, qty, price from tbl_trx_item where trx_id = '$trx_id' order by id desc");

            // Gabungkan data transaksi dengan itemnya
            $data_trx[] = [
                'trx_id'    => $trx['trx_id'],
                'nama_user' => $trx['nama_user'],
                'created_at' => $trx['created_at'],
                'updated_at' => $trx['updated_at'],
                'item'      => $item_trx,
            ];
        }
        // Load view ke dalam HTML
        $html = view('report/ReportViewTrx', ['data' => $data_trx]);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Mengatur opsi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf->setOptions($options);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Kirim file PDF ke browser untuk diunduh
        $dompdf->stream("Laporan_Data.pdf", ["Attachment" => true]);
    }
}
