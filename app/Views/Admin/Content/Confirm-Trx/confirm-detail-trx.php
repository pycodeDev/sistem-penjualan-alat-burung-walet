<?= $this->extend('admin/Main') ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/summernote/summernote-bs4.min.css')?>">
<?= $this->endSection() ?>
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
                                        echo '<span class="right badge badge-primary text-white">SHIPPING</span>';
                                    }elseif ($trx['status'] == 'SUCCESS') {
                                        echo '<span class="right badge badge-success text-white">SUCCESS</span>';
                                    }else{
                                        echo '<span class="right badge badge-danger text-white">FAILED</span>';
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
                        <h3 class="card-title">Data Confirm</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="row m-1">
                            <div class="col-4">
                                <h5>Nama Rekening</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $rek['rekening_name'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Nomor Rekening</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $rek['rekening'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Bukti</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><img src="<?= $pc['image'] ?>" alt="bukti payment" style="width: 100%; max-width: 200px; height: auto;"></h5>
                                <a class="btn btn-primary btn-small" href="<?= $pc['image'] ?>" download><i class="fa fa-download"></i></a>
                            </div>
                            <form action="<?= site_url('trx/trx-confirm/') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $pc['id'] ?>">
                                <input type="hidden" name="trx_id" value="<?= $pc['trx_id'] ?>">
                                <div class="col-12">Note</div>
                                <div class="col-12">
                                    <textarea id="summernote" name="note">
                                        <?= $pc['note'] == "" ? "Masukkan Note nya" : $pc['note'] ?>
                                    </textarea>
                                </div>
                        </div>
                    </div>
                <!-- /.card-body -->
                    <div class="card-footer">
                        <?php
                        if ($pc['status'] == "SUCCESS") {?>
                            <p class="text-success">Transaksi ini Sudah Dikonfirmasi Benar oleh Admin.</p>
                        <?php
                        }else if ($pc['status'] == "REJECT") {?>
                            <p class="text-danger">Transaksi ini Sudah Dikonfirmasi Salah oleh Admin.</p>
                        <?php
                        }else{
                        ?>
                            <button type="submit" name="status" class="btn btn-sm btn-success" value="SUCCESS">Approve</button>
                            <button type="submit" name="status" class="btn btn-sm btn-danger" value="REJECT">Reject</button>
                        <?php
                        }
                        ?>
                    </div>
                                </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?php echo base_url('assets/admin/plugins/summernote/summernote-bs4.min.js')?>"></script>
    <script>
  $(function () {
    // Summernote
    $('#summernote').summernote()
  })
</script>
<?= $this->endSection() ?>