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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Trx</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <div class="row m-1">
                            <div class="col-4">
                                <h5>Trx ID</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>#<?= $trx['trx_id'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Qty</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $trx['total'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Price</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                    <?php 
                                    $rupiah = "Rp " . number_format($trx['price'], 0, ',', '.');
                                    echo $rupiah;
                                    ?>
                                </h5>
                            </div>
                            <div class="col-4">
                                <h5>Payment Method</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $trx['payment_method_name'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Payment Number</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $trx['payment_method_number'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Status</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                <?php
                                    if ($trx['status'] == "PENDING") {
                                        echo '<span class="right badge badge-warning text-white">PENDING</span>';
                                    }elseif ($trx['status'] == 'CONFIRM') {
                                        echo '<span class="right badge badge-info text-white">KONFIRM</span>';
                                    }elseif ($trx['status'] == 'SHIPPING') {
                                        echo '<span class="right badge badge-danger text-white">SHIPPING</span>';
                                    }elseif ($trx['status'] == 'SUCCESS') {
                                        echo '<span class="right badge badge-warning text-white">SUCCESS</span>';
                                    }else{
                                        echo '<span class="right badge badge-primary text-white">FAILED</span>';
                                    }
                                ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="row m-1">
                            <div class="col-4">
                                <h5>Nama User</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $user['name'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Email</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $user['email'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Hp</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $user['hp'] ?></h5>
                            </div>
                        </div>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Transaction Item</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item Id</th>
                                <th>Nama Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($item as $trx_item) {
                                    $formattedDate = date('d F Y', strtotime($trx_item['created']));
                                ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;"><?= $no;?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $trx_item['item_id'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $trx_item['nama_barang'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $trx_item['qty'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $trx_item['price'] ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?= $formattedDate ?></td>
                                </tr>
                                <?php
                                $no++;
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