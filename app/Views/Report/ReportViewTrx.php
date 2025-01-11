<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Stok Penjualan Toko</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Laporan Data</h1>

    <table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Trx Id</th>
            <th>Nama User</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)): ?>
            <?php $no = 1; ?>
            <?php foreach ($data as $row): ?>
                <?php $item_count = count($row['item']); // Jumlah item untuk rowspan ?>
                <?php if ($item_count > 0): ?>
                    <?php foreach ($row['item'] as $key => $item): ?>
                        <tr>
                            <?php if ($key === 0): ?>
                                <!-- Kolom dengan rowspan untuk trx_id dan nama_user -->
                                <td rowspan="<?= $item_count; ?>"><?= $no++; ?></td>
                                <td rowspan="<?= $item_count; ?>"><?= htmlspecialchars($row['trx_id']); ?></td>
                                <td rowspan="<?= $item_count; ?>"><?= htmlspecialchars($row['nama_user']); ?></td>
                            <?php endif; ?>

                            <!-- Kolom data produk -->
                            <td><?= htmlspecialchars($item['nama_barang']); ?></td>
                            <td><?= htmlspecialchars($item['qty']); ?></td>
                            <?php if ($key === 0): ?>
                                <td rowspan="<?= $item_count; ?>"><?= htmlspecialchars($row['created_at']); ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['trx_id']); ?></td>
                        <td><?= htmlspecialchars($row['nama_user']); ?></td>
                        <td colspan="3" style="text-align: center;">Tidak ada item</td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
    </table>


    <div class="footer">
        <p>Generated on: <?= date('Y-m-d H:i:s'); ?></p>
    </div>
</body>
</html>
