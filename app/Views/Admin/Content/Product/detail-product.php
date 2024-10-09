<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product</h1>
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
                        <h3 class="card-title">Data Product</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <div class="row m-1">
                            <div class="col-4">
                                <h5>Name</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $prd['name'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Category Name</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $prd['category_name'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Stok</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $prd['stok'] ?></h5>
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
                                    $rupiah = "Rp " . number_format($prd['price'], 0, ',', '.');
                                    echo $rupiah;
                                    ?>
                                </h5>
                            </div>
                            <div class="col-4">
                                <h5>Deskripsi</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $prd['deskripsi'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Image</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5>
                                <img src="<?= $prd['image'] ?>" alt="image of Product" style="width: 100%; max-width: 200px; height: auto;"></h5>
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
                    <h3 class="card-title">Data Comment Produk</h3>

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
                                <th>Name</th>
                                <th>Comment</th>
                                <th>Tanggal</th>
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
                                    foreach ($data as $cmnt) {
                                        $date = explode(" ", $cmnt['created_at']);
                                        $formattedDate = date('d F Y', strtotime($date[0]));
                                    ?>
                                    <tr>
                                        <td ><?= $no;?></td>
                                        <td ><a href="<?= base_url(); ?>user/data-user/<?= $cmnt['user_id'] ?>"><?= $cmnt['name_user'] ?></a></td>
                                        <td ><?= $cmnt['comment'] ?></td>
                                        <td ><?= $formattedDate ?></td>
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