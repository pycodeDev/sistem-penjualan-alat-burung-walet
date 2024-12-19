<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin</h1>
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
                        <h3 class="card-title">Add Data Admin</h3>
                    </div>
                <!-- /.card-header -->
                    <form action="<?= site_url('admin/data-admin') ?>" method="post">
                        <div class="card-body p-2">
                        <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label>Hp</label>
                                <input type="text" class="form-control" name="hp" placeholder="Enter Hp">
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control select2bs4" name="level" style="width: 100%;">
                                    <option value="owner">Owner</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        <!-- /.card-body -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" >Save</button>
                            <a href="<?= base_url(); ?>admin/data-admin" class="btn btn-secondary">Back</a>
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