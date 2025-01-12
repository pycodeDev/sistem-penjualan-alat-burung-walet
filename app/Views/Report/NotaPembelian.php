<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trx #<?= $trx['trx_id']; ?></title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            margin: 0 0 10px;
        }
        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        h2 {
            font-size: 18px;
            color: #333;
        }
        p {
            margin: 5px 0;
            color: #555;
        }
        .text-center {
            text-align: center;
        }
        .border-b {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .mt-6 {
            margin-top: 24px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f9fafb;
            text-align: left;
            font-weight: bold;
            color: #555;
        }
        .flex {
            display: flex;
            justify-content: space-between;
        }
        .bg-blue, .bg-green, .bg-gray {
            border-radius: 4px;
            padding: 10px;
        }
        .bg-blue {
            background-color: #e0f2ff;
            color: #0369a1;
        }
        .bg-green {
            background-color: #d1fae5;
            color: #065f46;
        }
        .bg-gray {
            background-color: #f3f4f6;
            color: #555;
        }
    </style>
</head>
<body>
    <?php
    if ($trx['status'] == "FAILED" || $trx['status'] == "PENDING") {
        echo "Maaf, Transaksi Belum Anda Bayar!!";
        exit;
    }
    ?>
    <div class="container">
        <div class="text-center border-b">
            <h1>Nota Pembelian</h1>
            <p>Nomor Transaksi: <?= $trx['trx_id']; ?></p>
            <p>Tanggal: <?= $trx['created']; ?></p>
        </div>

        <div class="mt-6">
            <h2>Informasi Pembeli</h2>
            <p><strong>Nama:</strong> <?= $user['name']; ?></p>
            <p><strong>Email:</strong> <?= $user['email']; ?></p>
        </div>

        <div class="mt-6">
            <h2>Detail Produk</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    foreach ($trx_item as $trx_i) {
                        $subtotal += $trx_i['price'];
                    ?>
                    <tr>
                        <td><?= $trx_i['nama_barang']; ?></td>
                        <td><?= $trx_i['qty']; ?></td>
                        <td><?= "Rp " . number_format($trx_i['price'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <h2>Ringkasan Harga</h2>
            <div class="flex">
                <span>Subtotal</span>
                <span><?= "Rp " . number_format($subtotal, 0, ',', '.'); ?></span>
            </div>
            <div class="flex">
                <span>Biaya Admin</span>
                <span>Rp 0</span>
            </div>
            <div class="flex" style="font-weight: bold;">
                <span>Total</span>
                <span><?= "Rp " . number_format($subtotal, 0, ',', '.'); ?></span>
            </div>
        </div>

        <div class="mt-6">
            <h2>Metode Pembayaran</h2>
            <div class="bg-blue">
                <p><?= $trx['payment_method_name']; ?></p>
            </div>
        </div>

        <div class="mt-6">
            <h2>Informasi Rekening Pembayaran</h2>
            <div class="bg-gray">
                <p><strong>Nama Bank:</strong> <?= $trx['payment_method_name']; ?></p>
                <p><strong>Nomor Rekening:</strong> <?= $trx['rek_number']; ?></p>
                <p><strong>Atas Nama:</strong> <?= $trx['rek_name']; ?></p>
            </div>
        </div>

        <div class="mt-6">
            <h2>Status Pembayaran</h2>
            <div class="bg-green">
                <p>Pembayaran Sukses</p>
            </div>
        </div>
    </div>
</body>
</html>
