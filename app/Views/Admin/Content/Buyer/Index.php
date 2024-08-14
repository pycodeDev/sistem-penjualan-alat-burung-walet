<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buyer</h1>
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
                    <h3 class="card-title">Data Buyer</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <a class="btn btn-sm btn-success float-left m-2" href="<?= base_url(); ?>supplier/data-buyer/add-buyer">
                        Tambah Data
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Buyer Id</th>
                                <th style="text-align: center; vertical-align: middle;">Supplier</th>
                                <th style="text-align: center; vertical-align: middle;">Name</th>
                                <th style="text-align: center; vertical-align: middle;">Qty</th>
                                <th style="text-align: center; vertical-align: middle;">Price</th>
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
                                    $no = 1;
                                    foreach ($data as $buy) {
                                        $rupiah = "Rp " . number_format($buy['price'], 0, ',', '.');
                                    ?>

                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;"><?= $no;?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $buy['buyer_id'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $buy['supplier_name'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $buy['name'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $buy['qty'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $rupiah ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><a href="<?= base_url(); ?>supplier/data-buyer/edit-buyer/<?= $buy['id'] ?>" class="btn btn-sm btn-warning"><div class="fa fa-pencil-alt text-white"></div></a><a href="<?= base_url(); ?>supplier/data-buyer/<?= $buy['id'] ?>" class="btn btn-sm btn-danger ml-2"><div class="fa fa-trash-alt"></div></a></td>
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