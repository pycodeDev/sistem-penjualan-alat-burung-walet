<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment Method</h1>
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
                    <h3 class="card-title">Data Payment Method</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                        <?php
                            if ($back == null) {
                                $back = 0;
                            }
                            if ($next == null) {
                                $next = 0;
                            }
                            ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>payment/data-payment/<?=$back?>/back">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>payment/data-payment/<?=$next?>/next">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                <a class="btn btn-sm btn-success float-left m-2" href="<?= base_url(); ?>payment/data-payment/add-payment">
                        Tambah Data
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Name</th>
                                <th style="text-align: center; vertical-align: middle;">Image</th>
                                <th style="text-align: center; vertical-align: middle;">Rekening</th>
                                <th style="text-align: center; vertical-align: middle;">Rekening Name</th>
                                <th style="text-align: center; vertical-align: middle;">Status</th>
                                <th style="text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (count($data) == 0) {?>
                                    <tr>
                                        <td colspan="7" style="text-align: center; vertical-align: middle;">Tidak Ada Data !!</td>
                                    </tr>
                                <?php } else {
                                    $no=1;
                                    foreach ($data as $pm) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?= $no ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $pm['name'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><img src="<?= $pm['image'] ?>" alt="logo payment method" style="width: 100%; max-width: 200px; height: auto;"></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $pm['rekening'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $pm['rekening_name'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $pm['status'] == 1 ? '<span class="right badge badge-success">Aktif</span>' : '<span class="right badge badge-danger">Tidak Aktif</span>' ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><a href="<?= base_url(); ?>payment/data-payment/edit-payment/<?= $pm['id'] ?>" class="btn btn-sm btn-warning"><div class="fa fa-pencil-alt text-white"></div></a><a href="<?= base_url(); ?>payment/data-payment/<?= $pm['id'] ?>" class="btn btn-sm btn-danger ml-2"><div class="fa fa-trash-alt"></div></a></td>
                                        </td>
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