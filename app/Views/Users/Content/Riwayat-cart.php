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
                <?php
                if (count($data) == 0) {
                    // Kode untuk ketika data kosong
                } else {
                    foreach ($data as $cart) {
                        $price = "Rp " . number_format($cart['price'], 0, ',', '.');
                        $total = "Rp " . number_format($cart['price'] * $cart['qty'], 0, ',', '.');
                        ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $cart['name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $price ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <input type="number" value="<?= $cart['qty'] ?>" min="1" class="w-16 px-2 py-1 border rounded-md quantity" data-product-id="<?= $cart['id'] ?>">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $total ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-yellow-300 hover:text-yellow-500 update-cart-btn" data-product-id="<?= $cart['id'] ?>">Update</button>
                                <a href="<?= base_url() ?>client/cart/<?= $cart['id'] ?>" class="text-red-600 hover:text-red-800">Remove</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>

                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>

    <!-- Cart Summary -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Cart Summary</h3>
        <div class="flex flex-col md:flex-row md:justify-between mb-4">
            <div class="w-full md:w-2/3">
                <p class="text-gray-600 mb-2">Subtotal: <span id="cart-subtotal"><?php 
                $price = "Rp " . number_format($total_cart, 0, ',', '.');
                echo $price;
                ?></span></p>
                <p class="text-gray-600 mb-2">Admin: <span id="cart-shipping">Rp 0</span></p>
                <p class="text-gray-800 font-bold text-lg">Total: <span id="cart-total"><?php 
                $price = "Rp " . number_format($total_cart, 0, ',', '.');
                echo $price;
                ?></span></p>
            </div>
            <div class="w-full md:w-1/3 mt-6 md:mt-0">
                <a href="checkout.html" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tangkap semua tombol update
        const updateButtons = document.querySelectorAll('.update-cart-btn');

        updateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const quantityInput = document.querySelector(`.quantity[data-product-id='${productId}']`);
                const quantity = quantityInput.value;

                // Mengirim data ke server menggunakan fetch
                const url = "<?= base_url('client/cart/') ?>"
                fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({
                        id_cart: productId,
                        qty: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Berhasil, lakukan refresh halaman
                        location.reload();
                    } else {
                        // Tampilkan error jika ada
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate cart.');
                });
            });
        });
    });
</script>
<?= $this->endSection() ?>