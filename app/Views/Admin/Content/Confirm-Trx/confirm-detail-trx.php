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
                                <h5>#trx141bkjbkbafa</h5>
                            </div>
                            <div class="col-4">
                                <h5>Qty</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>5</h5>
                            </div>
                            <div class="col-4">
                                <h5>Price</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>Rp 100.000</h5>
                            </div>
                            <div class="col-4">
                                <h5>Payment Method</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>BCA</h5>
                            </div>
                            <div class="col-4">
                                <h5>Payment Number</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>89078979</h5>
                            </div>
                            <div class="col-4">
                                <h5>Status</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>SUCCESS</h5>
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
                                <h5>John Doe</h5>
                            </div>
                            <div class="col-4">
                                <h5>Nomor Rekening</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>801841241414</h5>
                            </div>
                            <div class="col-4">
                                <h5>Bukti</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>[image]</h5>
                            </div>
                            <div class="col-12">Note</div>
                            <div class="col-12">
                                <textarea id="summernote">
                                    Place <em>some</em> <u>text</u> <strong>here</strong>
                                </textarea>
                            </div>
                        </div>
                    </div>
                <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="#" class="btn btn-sm btn-success">Approve</a>
                        <a href="#" class="btn btn-sm btn-danger">Reject</a>
                    </div>
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