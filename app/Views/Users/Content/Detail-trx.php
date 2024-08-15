<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Transaction Detail -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Transaction Detail</h2>

    <!-- Product Details -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Product Details</h3>
        <div class="flex flex-col md:flex-row md:justify-between mb-4">
            <div class="w-full md:w-2/3">
                <h4 class="text-xl font-bold text-gray-800 mb-2">Product Name</h4>
                <p class="text-gray-600 mb-2">Quantity: <span id="product-quantity">1</span></p>
                <p class="text-gray-600 mb-2">Price: <span id="product-price">$50.00</span></p>
            </div>
            
            <!-- Price Summary -->
            <div class="w-full md:w-1/3 mt-6 md:mt-0">
                <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Price Summary</h4>
                    <p class="flex justify-between text-gray-600 mb-2">
                        <span>Subtotal:</span>
                        <span id="subtotal">$50.00</span>
                    </p>
                    <p class="flex justify-between text-gray-600 mb-2">
                        <span>Shipping:</span>
                        <span id="shipping">$5.00</span>
                    </p>
                    <p class="flex justify-between text-gray-800 font-bold text-lg">
                        <span>Total:</span>
                        <span id="total">$55.00</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Payment Information</h3>
        <p class="text-gray-600 mb-2">Payment Method: <span id="payment-method">Bank Transfer</span></p>
        <div id="payment-info" class="mb-4">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">Bank Transfer Information</h4>
            <p class="text-gray-600 mb-2">Account Number: <span id="account-number">1234567890</span></p>
            <p class="text-gray-600 mb-2">Account Name: <span id="account-name">John Doe</span></p>
        </div>
    </div>

    <!-- Upload Payment Proof -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Upload Payment Proof</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="payment-proof" class="block text-gray-700 font-bold mb-2">Upload Payment Proof:</label>
                <input type="file" id="payment-proof" name="payment-proof" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Submit</button>
        </form>
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