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
                        <h3 class="card-title">Add Data Payment Method</h3>
                    </div>
                <!-- /.card-header -->
                    <div class="card-body p-2">
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="exampleInputName">Payment Method Name</label>
                            <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label>Rekening Number</label>
                            <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label>Rekening Name</label>
                            <input type="text" class="form-control" id="exampleInputName" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStock">Image</label>
                            <input type="text" class="form-control" id="exampleInputStock" placeholder="Enter Stock">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputStock">Status</label>
                            <select name="status" id="">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
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