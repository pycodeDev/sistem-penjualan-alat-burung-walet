<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data User</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <div class="row m-1">
                            <div class="col-4">
                                <h5>Nama</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $user['name'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Hp</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $user['hp'] ?></h5>
                            </div>
                            <div class="col-4">
                                <h5>Email</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5><?= $user['email'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Rekening</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="row m-1">
                            <input type="hidden" id="user_id" value="<?= $user['id'] ?>">
                            <select class="form-control select2bs4" id="paymentMethod" onchange="fetchPaymentData()" style="width: 100%;">
                                <option value="">Pilih Metode Pembayaran</option>
                                <?php foreach ($payment as $pm) { ?>
                                    <option value="<?= $pm['name'] ?>"><?= $pm['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>    
                        <div class="row m-1">
                            <div class="col-4">
                                <h5>Nama Rekening</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5 id="rekening_name">-</h5>
                            </div>
                            <div class="col-4">
                                <h5>Nomor Rekening</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5 id="rekening_number">-</h5>
                            </div>
                            <div class="col-4">
                                <h5>Payment Method</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5 id="payment_method_name">-</h5>
                            </div>
                            <div class="col-4">
                                <h5>Status</h5>
                            </div>
                            <div class="col-1">
                                <h5>:</h5>
                            </div>
                            <div class="col-7">
                                <h5 id="status">-</h5>
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
                    <h3 class="card-title">Data Transaction User</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>user/data-user/<?=$user['id']?>/<?=$back?>/back">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url() ?>user/data-user/<?=$user['id']?>/<?=$next?>/next">&raquo;</a></li>
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
                                <th>Total</th>
                                <th>Price</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($trx as $trx_item) {
                                    $formattedDate = date('d F Y', strtotime($trx_item['created']));
                                ?>
                                <tr>
                                    <td ><?= $no;?></td>
                                    <td ><a href="<?= base_url(); ?>trx/data-trx/<?= $trx_item['trx_id'] ?>"><?= $trx_item['trx_id'] ?></a></td>
                                    <td ><?= $trx_item['total'] ?></td>
                                    <td ><?= $trx_item['price'] ?></td>
                                    <td ><?= $formattedDate ?></td>
                                </tr>
                                <?php
                                $no++;
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
<?= $this->section('js') ?>
<script>
function fetchPaymentData() {
    const paymentMethod = document.getElementById('paymentMethod').value;
    const hiddenId = document.getElementById('user_id').value;

    if (paymentMethod) {
        // Lakukan POST ke API dengan paymentMethod dan hiddenId
        fetch('<?= base_url() ?>/user/get-rek', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>' // Untuk keamanan CSRF
            },
            body: JSON.stringify({
                payment_method_name: paymentMethod,
                user_id: hiddenId
            })
        })
        .then(response => response.json())
        .then(data => {
            // Cek apakah data rekening valid
            if (data.account_id !== "-") {
                // Tampilkan data rekening di HTML
                document.getElementById('rekening_name').innerText = data.account_name;
                document.getElementById('rekening_number').innerText = data.account_number;
                document.getElementById('payment_method_name').innerText = data.payment_method_name;

                const statusElement = document.getElementById('status');
                if (data.status == 1) {
                    statusElement.innerHTML = '<span class="right badge badge-success text-white">Aktif</span>';
                } else {
                    statusElement.innerHTML = '<span class="right badge badge-danger text-white">Tidak Aktif</span>';
                }
            } else {
                // Tampilkan pesan jika tidak ada rekening
                document.getElementById('rekening_name').innerText = '-';
                document.getElementById('rekening_number').innerText = '-';
                document.getElementById('payment_method_name').innerText = '-';
                document.getElementById('status').innerHTML = '-';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
}
</script>
<?= $this->endSection() ?>