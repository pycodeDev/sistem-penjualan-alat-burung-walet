<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier</h1>
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
                    <h3 class="card-title">Data Supplier</h3>

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
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>supplier/data-supplier/<?=$back?>/back">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>supplier/data-supplier/<?=$next?>/next">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <a class="btn btn-sm btn-success float-left m-2" href="<?= base_url(); ?>supplier/data-supplier/add-supplier">
                        Tambah Data
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Name</th>
                                <th style="text-align: center; vertical-align: middle;">Hp</th>
                                <th style="text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (count($data) == 0) {?>
                                    <tr>
                                        <td colspan="4" style="text-align: center; vertical-align: middle;">Tidak Ada Data !!</td>
                                    </tr>
                                <?php } else {
                                    $no = 1;
                                    foreach ($data as $sup) {
                                    ?>

                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?= $no;?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $sup['name'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $sup['hp'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><a href="<?= base_url(); ?>supplier/data-supplier/edit-supplier/<?= $sup['id'] ?>" class="btn btn-sm btn-warning"><div class="fa fa-pencil-alt text-white"></div></a><a href="<?= base_url(); ?>supplier/data-supplier/<?= $sup['id'] ?>" class="btn btn-sm btn-danger ml-2"><div class="fa fa-trash-alt"></div></a></td>
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