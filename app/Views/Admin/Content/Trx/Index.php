<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaction</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Transaction</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <a class="btn btn-sm btn-success float-left m-2" href="<?= base_url(); ?>product/category-product/add-category-product">
                        <i class="fas fa-print"></i> Cetak
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Trx Id</th>
                                <th style="text-align: center; vertical-align: middle;">Nama User</th>
                                <th style="text-align: center; vertical-align: middle;">Total Product</th>
                                <th style="text-align: center; vertical-align: middle;">Total Harga</th>
                                <th style="text-align: center; vertical-align: middle;">Status</th>
                                <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                                <th style="text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (count($data) == 0) {?>
                                    <tr>
                                        <td colspan="8" style="text-align: center; vertical-align: middle;">Tidak Ada Data !!</td>
                                    </tr>
                                <?php } else {
                                    $no = 1;
                                    foreach ($data as $trx) {
                                        $formattedDate = date('d F Y', strtotime($trx['created']));
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?= $no;?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $trx['trx_id'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $trx['nama_user'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $trx['total'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $trx['price'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <?php
                                                if ($trx['status'] == "PENDING") {
                                                    echo '<span class="right badge badge-warning text-white">PENDING</span>';
                                                }elseif ($trx['status'] == 'KONFIRM') {
                                                    echo '<span class="right badge badge-info text-white">KONFIRM</span>';
                                                }elseif ($trx['status'] == 'SHIPPING') {
                                                    echo '<span class="right badge badge-danger text-white">SHIPPING</span>';
                                                }elseif ($trx['status'] == 'SUCCESS') {
                                                    echo '<span class="right badge badge-warning text-white">SUCCESS</span>';
                                                }else{
                                                    echo '<span class="right badge badge-primary text-white">FAILED</span>';
                                                }
                                            ?>
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $formattedDate ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><a href="<?= base_url(); ?>trx/data-trx/<?= $trx['trx_id'] ?>" class="btn btn-sm btn-info"><div class="fa fa-eye text-white"></div></a></td>
                                    </tr>
                                <?php
                                $no++;
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
<?= $this->endSection() ?>