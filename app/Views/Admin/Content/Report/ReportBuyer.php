<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Report Data Buyer</h1>
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
                    <h3 class="card-title">Laporan Data Pembelian</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <a class="btn btn-sm btn-primary float-left m-2" target="_blank" href="<?= base_url(); ?>report/supplier/view">
                        View Data
                    </a>
                    <!-- <a class="btn btn-sm btn-danger float-left m-2" target="_blank" href="<?= base_url(); ?>report/supplier">
                        Download Data
                    </a> -->
                    <button type="button" class="btn btn-sm btn-danger float-left m-2" data-toggle="modal" data-target="#modal-default">
                        Download Data
                    </button>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cetak Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url(); ?>report/supplier" method="post">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary float-right m-2" data-toggle="modal" data-target="#modal-default">
                            Cetak
                        </button>
                    </form>
                </div>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?= $this->endSection() ?>