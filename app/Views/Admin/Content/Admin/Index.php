<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin</h1>
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
                    <h3 class="card-title">Data Admin</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>admin/data-admin/<?=$back?>/back">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>admin/data-admin/<?=$next?>/next">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                <a class="btn btn-sm btn-success float-left m-2" href="<?= base_url(); ?>admin/data-admin/add-admin">
                        Tambah Admin
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Nama</th>
                                <th style="text-align: center; vertical-align: middle;">Email</th>
                                <th style="text-align: center; vertical-align: middle;">Hp</th>
                                <th style="text-align: center; vertical-align: middle;">Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (count($data) == 0) {?>
                                    <tr>
                                        <td colspan="5" style="text-align: center; vertical-align: middle;">Tidak Ada Data !!</td>
                                    </tr>
                                <?php } else {
                                    $no = 1;
                                    foreach ($data as $admin) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?= $no;?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $admin['name'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $admin['email'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $admin['hp'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $admin['level'] ?></td>
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