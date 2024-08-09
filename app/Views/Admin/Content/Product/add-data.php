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
    <section class="content p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Data Product</h3>
                    </div>
                <!-- /.card-header -->
                    <div class="card-body p-2">
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="exampleInputName">Product Name</label>
                            <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label>Category Product</label>
                            <select class="form-control select2bs4" style="width: 100%;">
                                <option selected="selected">Silahkan Pilih Category Produk</option>
                                <?php
                                    foreach ($data as $cp) {?>
                                    <option value="<?php $cp['id'] ?>"><?php $cp['name'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPrice">Price</label>
                            <input type="text" class="form-control" id="exampleInputPrice" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStock">Stock</label>
                            <input type="text" class="form-control" id="exampleInputStock" placeholder="Enter Stock">
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" onclick="saveData()">Save</button>
                        <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
                    </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
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