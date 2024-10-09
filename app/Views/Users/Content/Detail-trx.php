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
        <?php if ($trx['payment_method_name'] == ""): ?>
            <label for="payment_method" class="block text-gray-700">Pilih Metode Pembayaran:</label>
            <select id="payment_method" name="payment_method" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="">-- Pilih Metode Pembayaran --</option>
                <?php
                    foreach ($payment_data as $payment):
                ?>
                    <option value="<?= $payment['id'] ?>"><?= $payment['name'] ?></option>
                <?php endforeach; ?>
                <!-- Tambahkan opsi metode pembayaran lainnya sesuai kebutuhan -->
            </select>
            <div class="mt-2 mb-3" id="tf_sini">
            </div>
            <!-- Tempat untuk menampilkan info rekening atau form input -->
            <div id="payment-info" class="mt-4"></div>
        <?php else: ?>
            <p class="text-gray-600 mb-2">Payment Method: <span id="payment-method"><?= $trx['payment_method_name']; ?></span></p>
            <p class="text-gray-600 mb-2">Payment Method Number: <span id="payment-method"><?= $trx['payment_method_number']; ?></span></p>
            <div id="payment-info" class="mb-4">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Account Payment Information</h4>
                <p class="text-gray-600 mb-2">Account Number: <span id="account-number"><?=$trx['rek_number']?></span></p>
                <p class="text-gray-600 mb-2">Account Name: <span id="account-name"><?=$trx['rek_name']?></span></p>
            </div>
        <?php endif; ?>
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
                    <!-- Hidden inputs for payment method details -->
                    <input type="hidden" id="payment_method_id" name="payment_method_id">
                    <input type="hidden" id="payment_method_number" name="payment_method_number">
                    <input type="hidden" id="payment_method_name" name="payment_method_name">
                    <input type="hidden" id="account_number" name="rekening">
                    <input type="hidden" id="account_name" name="rekening_name">
                    <input type="hidden" id="is_rekening" name="is_rekening">
                    <input type="hidden" name="trx_id" value="<?= $trx['trx_id'] ?>">
                </div>
                <button type="submit" id="submit_button" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Submit</button>
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

            <!-- Form input komentar -->
            <?php if (count($trx_item) == 1): ?>
                <form action="/submit-comment" method="POST" class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Tulis Komentar</label>
                    <textarea id="comment" name="comment" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>
                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                        Kirim Komentar
                    </button>
                </form>

                <!-- List komentar -->
                <div class="space-y-4">
                    <?php if (count($comments) > 0): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="p-4 bg-gray-100 rounded-lg shadow">
                                <p class="text-gray-800"><?= htmlspecialchars($comment['comment']) ?></p>
                                <span class="text-xs text-gray-500">Dikirim oleh <?= htmlspecialchars($comment['name']) ?> pada <?= htmlspecialchars($comment['created_at']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else:  ?>
                        <div class="p-4 bg-gray-100 rounded-lg shadow">
                            <span class="text-xs text-gray-500">Belum Ada Comment Pada Produk Ini !</span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
   // JavaScript to toggle bank transfer information visibility
document.getElementById('payment_method').addEventListener('change', function() {
    const paymentMethodId = this.value;
    const paymentMethodName = this.options[this.selectedIndex].text;

    // Kosongkan div info pembayaran sebelum memproses data
    const paymentInfoDiv = document.getElementById('payment-info');
    paymentInfoDiv.innerHTML = '';
    const tfsiniDiv = document.getElementById('tf_sini');
    tfsiniDiv.innerHTML = '';

    // Jika tidak ada payment method yang dipilih, hentikan
    if (!paymentMethodId) {
        return;
    }

    // Mengirim request ke API untuk mendapatkan informasi rekening
    fetch(`<?= base_url('client/rekening') ?>?payment_method_name=${paymentMethodName}`)
        .then(response => response.json())
        .then(data => {
            if (data.account_number) {
                // Jika data rekening ditemukan, tampilkan info rekening
                paymentInfoDiv.innerHTML = `
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Account Payment Information</h4>
                    <p class="text-gray-600 mb-2">Account Number: <span id="account-number">${data.account_number}</span></p>
                    <p class="text-gray-600 mb-2">Account Name: <span id="account-name">${data.account_name}</span></p>
                `;
                tfsiniDiv.innerHTML = `
                    <p class="text-gray-600 mb-2 font-semibold">Nomor Rekening: <span id="tf_sini">${data.payment_method_number}</span></p>
                `;

                // Set hidden input fields
                document.getElementById('payment_method_id').value = paymentMethodId;
                document.getElementById('payment_method_name').value = paymentMethodName;
                document.getElementById('payment_method_number').value = data.payment_method_number;
                document.getElementById('account_number').value = data.account_number;
                document.getElementById('account_name').value = data.account_name;
                document.getElementById('is_rekening').value = data.account_id;
            } else {
                // Jika tidak ada data, tampilkan form input untuk memasukkan informasi rekening
                paymentInfoDiv.innerHTML = `
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Input Account Information</h4>
                    <label for="account_number_input" class="block text-gray-700">Account Number:</label>
                    <input type="text" id="account_number_input" name="account_number_input" class="w-full p-2 border border-gray-300 rounded-md mb-4" placeholder="Enter account number">
                    
                    <label for="account_name_input" class="block text-gray-700">Account Name:</label>
                    <input type="text" id="account_name_input" name="account_name_input" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter account name">
                `;
                tfsiniDiv.innerHTML = `
                    <p class="text-gray-600 mb-2 font-semibold">Nomor Rekening: <span id="tf_sini">${data.payment_method_number}</span></p>
                `;

                document.getElementById('payment_method_id').value = paymentMethodId;
                document.getElementById('payment_method_name').value = paymentMethodName;
                document.getElementById('payment_method_number').value = data.payment_method_number;
                document.getElementById('is_rekening').value = 0;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            paymentInfoDiv.innerHTML = '<p class="text-red-500">Error fetching account information. Please try again later.</p>';
        });
});

// Tambahkan event listener setelah elemen-elemen input dihasilkan
const submitButton = document.getElementById('submit_button');
if (submitButton) {
    submitButton.addEventListener('click', function() {
        const accountNumberInput = document.getElementById('account_number_input').value;
        const accountNameInput = document.getElementById('account_name_input').value;
        document.getElementById('account_number').value = accountNumberInput;
        document.getElementById('account_name').value = accountNameInput;
    });
}


</script>
<?= $this->endSection() ?>