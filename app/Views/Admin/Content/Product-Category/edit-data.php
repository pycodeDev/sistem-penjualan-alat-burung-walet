<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product Category</h1>
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
                        <h3 class="card-title">Edit Data Product Category</h3>
                    </div>
                <!-- /.card-header -->
                    <div class="card-body p-2">
                    <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="exampleInputName">Category Name</label>
                            <input type="text" class="form-control" id="exampleInputName" value="<?= $data['name']; ?>">
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" onclick="saveData()">Update</button>
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