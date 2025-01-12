<?= $this->extend('admin/Main') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $user ?></h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <?php
                        if (session()->get('level') == "admin") {?>
                            <a href="<?= base_url(); ?>user/data-user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $trx ?></h3>

                            <p>Transaction</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <?php
                        if (session()->get('level') == "admin") {?>
                            <a href="<?= base_url(); ?>trx/data-trx" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning text-white">
                        <div class="inner">
                            <h3><?= $product ?></h3>

                            <p>Product</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <?php if (session()->get('level') == "admin") {?>
                            <a href="<?= base_url(); ?>product/data-product" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <!-- ./col -->
            </div>
        </div>
        <div class="row">
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Transaction
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="chart">
                    <canvas id="areaChart" style="min-height: 300px; height: 250px; max-height: 300px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.card -->
          </section>
        </div>
    </section>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/admin/plugins/chart.js/Chart.min.js');?>"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // ID Canvas untuk Chart.js
        const ctx = document.getElementById('areaChart').getContext('2d');

        // Fungsi untuk Memuat Data dari API
        async function fetchData() {
            try {
                const response = await fetch('http://localhost:8080/graph');
                const json = await response.json();

                // Ambil data bulan dan total dari response JSON
                const labels = json.data.map(item => item.bulan);
                const data = json.data.map(item => item.total);

                // Inisialisasi Chart
                new Chart(ctx, {
                    type: 'line', // Jenis chart (line, bar, dll.)
                    data: {
                        labels: labels, // Bulan sebagai label
                        datasets: [{
                            label: 'Total Per Bulan',
                            data: data, // Data total
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Total'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Panggil fungsi fetchData untuk load data dan render chart
        fetchData();
    });
</script>
<?= $this->endSection() ?>