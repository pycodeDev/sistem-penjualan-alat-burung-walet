<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Transaction Detail -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Transaction Detail</h2>

    <!-- Product Details -->
<div class="bg-white shadow-md rounded-lg p-6 mb-8">
    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Product Details</h3>
    
    <!-- Container for product details and price summary -->
    <div class="flex flex-col md:flex-row">
        <!-- Product details (stacked vertically) -->
        <div class="w-full md:w-2/3 flex flex-col space-y-4">
            <?php
            $subtotal = 0;
            foreach ($trx_item as $trx_i) {
                $subtotal = $subtotal + $trx_i['price'];
            ?>
            <div>
                <h4 class="text-xl font-bold text-gray-800 mb-2"><?= $trx_i['nama_barang'] ?></h4>
                <p class="text-gray-600 mb-2">Quantity: <span id="product-quantity"><?= $trx_i['qty'] ?></span></p>
                <p class="text-gray-600 mb-2">Price: <span id="product-price">
                    <?php
                    $price = "Rp " . number_format($trx_i['price'], 0, ',', '.');
                    echo $price;
                    ?>
                </span></p>
            </div>
            <?php
            }
            ?>
        </div>

        <!-- Price Summary -->
        <div class="w-full md:w-1/3 mt-6 md:mt-0 flex justify-end">
            <div class="bg-gray-100 p-4 rounded-lg shadow-md self-end">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Price Summary</h4>
                <p class="flex justify-between text-gray-600 mb-2">
                    <span>Subtotal:</span>
                    <span id="subtotal">
                    <?php
                    $price = "Rp " . number_format($subtotal, 0, ',', '.');
                    echo $price;
                    ?>
                    </span>
                </p>
                <p class="flex justify-between text-gray-600 mb-2">
                    <span>Admin:</span>
                    <span id="shipping">Rp 0</span>
                </p>
                <p class="flex justify-between text-gray-800 font-bold text-lg">
                    <span>Total:</span>
                    <span id="total">
                    <?php
                    $price = "Rp " . number_format($subtotal, 0, ',', '.');
                    echo $price;
                    ?>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>


    <!-- Payment Information -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Payment Information</h3>
        <p class="text-gray-600 mb-2">Payment Method: <span id="payment-method"><?= $trx['payment_method_name']; ?></span></p>
        <div id="payment-info" class="mb-4">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">Account Payment Information</h4>
            <?php
            if ($trx['payment_method_id'] == 1) {?>
            <p class="text-gray-600 mb-2">Account Number: <span id="account-number"><?=$trx['rek_number']?></span></p>
            <p class="text-gray-600 mb-2">Account Name: <span id="account-name"><?=$trx['rek_name']?></span></p>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Upload Payment Proof -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Status Transaction</h3>
        <?php
        if ($trx['status'] == 'PENDING'):?>
            <form action="<?= base_url() ?>client/trx/upload" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="payment-proof" class="block text-gray-700 font-bold mb-2">Upload Payment Proof:</label>
                    <input type="file" id="payment-proof" name="image" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                    <input type="hidden" name="trx_id" value="<?= $trx['trx_id'] ?>">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Submit</button>
            </form>
        <?php
        elseif ($trx['status'] == 'FAILED'):?>
            <div class="badge bg-red-500 text-white px-4 py-2 rounded-lg flex items-center">
                <span>Gagal Transaksi Silahkan Lakukan Transaksi Ulang.</span>
            </div>
        <?php elseif ($trx['status'] == 'CONFIRM'): ?>
            <div class="badge bg-blue-500 text-white px-4 py-2 rounded-lg">
                Bukti Transaksi Sedang di Proses
            </div>
            <?php elseif ($trx['status'] == 'SHIPPING'): ?>
                <span>Ayo Selesaikan Transaksi Anda. </span>
            <a href="url-to-complete-transaction" class="badge bg-yellow-500 text-white px-4 py-2 rounded-lg">
                Selesaikan Transaksi
            </a>
        <?php elseif ($trx['status'] == 'SUCCESS'): ?>
            <div class="badge bg-green-500 text-white px-4 py-2 rounded-lg">
                Sukses
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    // JavaScript to toggle bank transfer information visibility
    document.getElementById('payment-method').addEventListener('change', function() {
        const bankTransferInfo = document.getElementById('bank-transfer-info');
        if (this.value === 'bank-transfer') {
            bankTransferInfo.classList.remove('hidden');
        } else {
            bankTransferInfo.classList.add('hidden');
        }
    });
</script>
<?= $this->endSection() ?>