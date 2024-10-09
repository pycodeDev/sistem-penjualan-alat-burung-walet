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
                    <h1 class="m-0">Product</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Product</h3>
                    </div>
                <!-- /.card-header -->
                <form action="<?= site_url('product/data-product/edit-product') ?>" method="post">
                    <div class="card-body p-2">
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="exampleInputName">Product Name</label>
                            <input type="text" class="form-control" name="name" value="<?= $data['name']; ?>" placeholder="Enter Product Name">
                            <input type="hidden" class="form-control" name="id" value="<?= $data['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Category Product</label>
                            <select class="form-control select2bs4" name="category_id" style="width: 100%;">
                                <option selected="selected">Silahkan Pilih Category Produk</option>
                                <?php
                                    foreach ($cat_product as $cp) {?>
                                    <option value="<?= $cp['id'] ?>" <?= $data['category_id'] == $cp['id'] ? 'selected': "" ?> ><?= $cp['name'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPrice">Price</label>
                            <input type="text" class="form-control" name="price" value="<?= $data['price']; ?>" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStock">Stock</label>
                            <input type="text" class="form-control" name="stok" value="<?= $data['stok']; ?>" placeholder="Enter Stock">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStock">Image</label>
                            <input type="text" class="form-control" name="image" value="<?= $data['image']; ?>" placeholder="Enter Stock">
                        </div>
                        <div class="form-group">
                                <label for="exampleInputImage">Note</label>
                                <textarea id="summernote" name="deskripsi">
                                <?= $data['deskripsi'] == "" ? "Masukkan Note nya" : $data['deskripsi'] ?>
                                    </textarea>
                            </div>
                    <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" >Update</button>
                        <a href="<?= base_url(); ?>product/data-product" class="btn btn-secondary">Back</a>
                    </div>
                </form>
                <!-- /.card -->
                </div>
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

<!-- <script>
    function saveData() {
        // Implement the save functionality here
        alert('Save button clicked');
    }

    function goBack() {
        // Implement the back functionality here
        window.history.back();
    }
</script> -->