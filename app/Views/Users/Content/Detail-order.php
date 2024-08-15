<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Order Detail -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Order Detail</h2>

    <!-- Payment Method -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Payment Information</h3>
        <form action="#" method="POST">
            <div class="mb-4">
                <label for="payment-method" class="block text-gray-700 font-bold mb-2">Payment Method:</label>
                <select id="payment-method" name="payment-method" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                    <option value="credit-card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank-transfer">Bank Transfer</option>
                </select>
            </div>

            <!-- Bank Transfer Information -->
            <div id="bank-transfer-info" class="hidden mb-4">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Bank Transfer Information</h4>
                <div class="mb-4">
                    <label for="account-number" class="block text-gray-700 font-bold mb-2">Account Number:</label>
                    <input type="text" id="account-number" name="account-number" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" placeholder="1234567890">
                </div>
                <div class="mb-4">
                    <label for="account-name" class="block text-gray-700 font-bold mb-2">Account Name:</label>
                    <input type="text" id="account-name" name="account-name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" placeholder="John Doe">
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Proceed to Payment</button>
        </form>
    </div>

    <!-- Order Summary -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Order Summary</h3>
        <div class="flex flex-col md:flex-row md:justify-between mb-4">
            <!-- Product Details -->
            <div class="w-full md:w-2/3">
                <h4 class="text-xl font-bold text-gray-800 mb-2">Product Name</h4>
                <p class="text-gray-600 mb-2">Quantity: <span id="product-quantity">1</span></p>
                <p class="text-gray-600 mb-2">Price: <span id="product-price">$50.00</span></p>
                <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
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