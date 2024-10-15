<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">User Information</h2>
    <div class="bg-gray-100  p-4">
        <div class="bg-white shadow-md rounded-lg w-full p-6">
            <!-- Profile Information -->
            <div class="flex items-center mb-4">
                <img class="w-16 h-16 rounded-full" src="https://via.placeholder.com/150" alt="Profile Picture">
                <div class="ml-4">
                    <h2 class="text-lg font-semibold text-gray-800">John Doe</h2>
                    <p class="text-sm text-gray-600">johndoe@example.com</p>
                    <p class="text-sm text-gray-600">+1 234 567 890</p>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="border-t pt-4">
                <button class="ml-4 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Update</button>
            </div>
        </div>
    </div>

    <!-- Border antara User Information dan Rekening Information -->
    <div class="border-t border-gray-300 my-6"></div>

    <h2 class="text-3xl font-bold text-gray-800 mb-6">Rekening Information</h2>
    <div class="bg-gray-100 min-h-screen p-4">
        <div class="bg-white shadow-md rounded-lg w-full p-6">
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
            <!-- Tempat untuk menampilkan info rekening atau form input -->
            <div id="payment-info" class="mt-4"></div>
        </div>
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
                    <label for="account_number_input" class="block text-gray-700">Account Number:</label>
                    <input type="text" id="account_number_input" name="account_number_input" class="w-full p-2 border border-gray-300 rounded-md mb-4" value="${data.account_number}">
                    
                    <label for="account_name_input" class="block text-gray-700">Account Name:</label>
                    <input type="text" id="account_name_input" name="account_name_input" class="w-full p-2 border border-gray-300 rounded-md" value="${data.account_name}">
                    <input type="hidden" id="account_id" name="account_id" value="${data.account_id}">
                `;
            } else {
                // Jika tidak ada data, tampilkan form input untuk memasukkan informasi rekening
                paymentInfoDiv.innerHTML = `
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Input Account Information</h4>
                    <label for="account_number_input" class="block text-gray-700">Account Number:</label>
                    <input type="text" id="account_number_input" name="account_number_input" class="w-full p-2 border border-gray-300 rounded-md mb-4" placeholder="Enter account number">
                    
                    <label for="account_name_input" class="block text-gray-700">Account Name:</label>
                    <input type="text" id="account_name_input" name="account_name_input" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Enter account name">
                    <input type="hidden" id="account_id" name="account_id" value="0">
                `;
            }

            // Menambahkan button submit setelah data ditampilkan
            paymentInfoDiv.innerHTML += `
                <button id="submit-payment" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit Payment</button>
            `;

            // Tambahkan event listener untuk button submit
            document.getElementById('submit-payment').addEventListener('click', function() {
                submitPayment();
            });
        })
        .catch(error => {
            console.error('Error:', error);
            paymentInfoDiv.innerHTML = '<p class="text-red-500">Error fetching account information. Please try again later.</p>';
        });
});

// Fungsi untuk mengirim data ke API
function submitPayment() {
    const accountNumber = document.getElementById('account_number_input').value;
    const accountName = document.getElementById('account_name_input').value;
    const accountId = document.getElementById('account_id').value;
    const selectElement = document.getElementById('payment_method');
    const paymentMethodText = selectElement.options[selectElement.selectedIndex].text;


    // Buat data yang akan dikirim ke API
    const paymentData = {
        account_number: accountNumber,
        account_name: accountName,
        account_id: accountId,
        payment_method: paymentMethodText
    };

    // Kirim data ke API
    fetch('<?= base_url('client/payment-submit') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(paymentData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Tetap refresh jika gagal
        } else {
            alert('Failed to submit payment: ' + data.message);
            location.reload(); // Tetap refresh jika gagal
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting payment. Please try again later.');
    });
}
</script>
<?= $this->endSection() ?>