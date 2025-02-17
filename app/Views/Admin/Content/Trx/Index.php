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
                        <?php
                            if ($back == null) {
                                $back = 0;
                            }
                            if ($next == null) {
                                $next = 0;
                            }
                            ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>trx/data-trx/<?=$back?>/back">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>trx/data-trx/<?=$next?>/next">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <form action="javascript:void(0)" method="post" class="m-2" id="search-form">
                        <?= csrf_field() ?>
                        <div class="d-flex flex-wrap align-items-end gap-2">
                            <!-- TRX ID -->
                            <div class="form-group">
                                <label for="trx_id">Trx ID</label>
                                <input type="text" class="form-control" name="trx_id" id="trx_id" placeholder="Masukkan Trx ID">
                            </div>

                            <!-- STATUS (SELECT) -->
                            <div class="form-group">
                                <label for="category">Status</label>
                                <select class="form-control" name="category" id="status">
                                    <option value="">Pilih Status</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="KONFIRM">Konfirm</option>
                                    <option value="SHIPPING">Shipping</option>
                                    <option value="SUCCESS">Success</option>
                                    <option value="FAILED">Failed</option>
                                </select>
                            </div>

                            <!-- TANGGAL TRANSAKSI -->
                            <div class="form-group">
                                <label for="trx_date">Tgl Trx</label>
                                <input type="date" class="form-control" name="trx_date" id="trx_date">
                            </div>

                            <!-- BUTTONS -->
                            <div class="form-group d-flex gap-2">
                                <button type="button" id="search-btn" class="btn btn-primary">Cari</button>
                                <button type="button" id="reset-btn" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </form>

                    <table class="table">
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">Transaksi Tgl <span id="tgl"><?=$tgl?></span></th>
                            <th style="text-align: center; vertical-align: middle;">Pending</th>
                            <th style="text-align: center; vertical-align: middle;">Konfirm</th>
                            <th style="text-align: center; vertical-align: middle;">Shipping</th>
                            <th style="text-align: center; vertical-align: middle;">Success</th>
                            <th style="text-align: center; vertical-align: middle;">Failed</th>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;" id="total"><?= $total ?></td>
                            <td style="text-align: center; vertical-align: middle;" id="pending"><?= $pending ?></td>
                            <td style="text-align: center; vertical-align: middle;" id="konfirm"><?= $konfirm ?></td>
                            <td style="text-align: center; vertical-align: middle;" id="shipping"><?= $shipping ?></td>
                            <td style="text-align: center; vertical-align: middle;" id="success"><?= $success ?></td>
                            <td style="text-align: center; vertical-align: middle;" id="failed"><?= $failed ?></td>
                        </tr>
                    </table>


                    <table class="table" id="php-data">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No</th>
                                <th style="text-align: center; vertical-align: middle;">Trx Id</th>
                                <th style="text-align: center; vertical-align: middle;">Nama User</th>
                                <th style="text-align: center; vertical-align: middle;">Total Product</th>
                                <th style="text-align: center; vertical-align: middle;">Total Harga</th>
                                <th style="text-align: center; vertical-align: middle;">Status</th>
                                <th style="text-align: center; vertical-align: middle;">Note</th>
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
                                        </td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $trx['note'] ?></td>
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

                    <!-- Tabel untuk AJAX (Akan Ditampilkan Setelah Pencarian) -->
                    <table class="table" id="ajax-data" style="display: none;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Trx Id</th>
                                <th>Nama User</th>
                                <th>Total Product</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Note</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
<?= $this->endSection() ?>