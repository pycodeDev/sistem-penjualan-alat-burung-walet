<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier</h1>
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
                        <h3 class="card-title">Edit Data Supplier</h3>
                    </div>
                <!-- /.card-header -->
                    <form action="<?= site_url('supplier/data-supplier') ?>" method="post">
                        <div class="card-body p-2">
                        <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputName" placeholder="Enter Supplier Name" value="<?= $data['name']; ?>">
                                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                <input type="hidden" name="_method" value="PUT">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Hp</label>
                                <input type="text" class="form-control" name="hp" id="exampleInputName" placeholder="Enter Supplier Hp" value="<?= $data['hp']; ?>">
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" >Save</button>
                            <a href="<?= base_url(); ?>supplier/data-supplier" class="btn btn-secondary">Back</a>
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