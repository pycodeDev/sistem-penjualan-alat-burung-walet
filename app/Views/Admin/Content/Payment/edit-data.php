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
    <section class="content p-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Payment Method</h3>
                    </div>
                <!-- /.card-header -->
                    <form action="<?= site_url('payment/data-payment/edit-payment') ?>" method="post">
                        <div class="card-body p-2">
                        <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="exampleInputName">Payment Method Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Product Name"  value="<?= $data['name']; ?>">
                                <input type="hidden" class="form-control" name="id" value="<?= $data['id']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Rekening Number</label>
                                <input type="text" class="form-control" name="rek_num" placeholder="Enter Product Name"  value="<?= $data['rekening']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Rekening Name</label>
                                <input type="text" class="form-control" name="rek_name" placeholder="Enter Product Name"  value="<?= $data['rekening_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputStock">Image</label>
                                <input type="text" class="form-control" name="image" placeholder="Enter Url Image"  value="<?= $data['image']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputStock">Status</label>
                                <select class="form-control select2bs4" name="status" style="width: 100%;">
                                    <option value="1" <?= $data['status'] == 1 ? 'selected': "" ?>>Aktif</option>
                                    <option value="0" <?= $data['status'] == 0 ? 'selected': "" ?>>Tidak Aktif</option>
                                </select>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" >Update</button>
                            <a href="<?= base_url(); ?>payment/data-payment" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
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