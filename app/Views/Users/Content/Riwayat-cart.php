<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Shopping Cart -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Shopping Cart</h2>

    <!-- Cart Items -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Your Cart</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Example Cart Item Row -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Product 1</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$25.00</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <input type="number" value="1" min="1" class="w-16 px-2 py-1 border rounded-md">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$25.00</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-red-600 hover:text-red-800">Remove</a>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- Cart Summary -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Cart Summary</h3>
        <div class="flex flex-col md:flex-row md:justify-between mb-4">
            <div class="w-full md:w-2/3">
                <p class="text-gray-600 mb-2">Subtotal: <span id="cart-subtotal">$25.00</span></p>
                <p class="text-gray-600 mb-2">Shipping: <span id="cart-shipping">$5.00</span></p>
                <p class="text-gray-800 font-bold text-lg">Total: <span id="cart-total">$30.00</span></p>
            </div>
            <div class="w-full md:w-1/3 mt-6 md:mt-0">
                <a href="checkout.html" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>