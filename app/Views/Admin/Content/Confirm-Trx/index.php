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
                    <h3 class="card-title">Data Transaction Confirmation</h3>

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
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>trx/trx-confirm/<?=$back?>/back">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>trx/trx-confirm/<?=$next?>/next">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Trx Id</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (count($data) == 0) {?>
                                    <tr>
                                        <td colspan="6">Tidak Ada Data !!</td>
                                    </tr>
                                <?php } else {
                                    $no=1;
                                    foreach ($data as $ct) {
                                        $formattedDate = date('d F Y', strtotime($ct['created']));
                                    ?>
                                    <tr>
                                        <td ><?= $no;?></td>
                                        <td ><?= $ct['trx_id'] ?></td>
                                        <td ><?= $ct['note'] ?></td>
                                        <td >
                                            <?php
                                                if ($ct['status'] == "PENDING") {
                                                    echo '<span class="right badge badge-warning text-white">PENDING</span>';
                                                }elseif ($ct['status'] == 'SUCCESS') {
                                                    echo '<span class="right badge badge-success text-white">APPROVE</span>';
                                                }else{
                                                    echo '<span class="right badge badge-danger text-white">REJECT</span>';
                                                }
                                            ?>
                                        </td>
                                        <td ><?= $formattedDate ?></td>
                                        <td ><a href="<?= base_url(); ?>trx/trx-confirm/<?= $ct['trx_id'] ?>" class="btn btn-sm btn-info"><div class="fa fa-eye text-white"></div></a>
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