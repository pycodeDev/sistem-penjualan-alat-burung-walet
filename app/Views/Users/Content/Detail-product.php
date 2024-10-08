<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Product Detail -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Product Image -->
        <div class="flex-shrink-0 w-full md:w-1/2">
            <img src="<?= $data['image'] ?>" alt="Product Image" class="w-full h-auto object-cover rounded-lg shadow-md">
        </div>

        <!-- Product Info -->
        <div class="w-full md:w-1/2">
            <h2 class="text-3xl font-bold text-gray-800 mb-4"><?= $data['name'] ?></h2>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Stok: <?= $data['stok'] ?></h2>
            <p class="text-gray-600 text-xl mb-4">
                <?php
                $rupiah = "Rp " . number_format($data['price'], 0, ',', '.');
                echo $rupiah;
                ?>                
            </p>
            <p class="text-gray-700 mb-6"><?= $data['deskripsi']; ?></p>
            
            <!-- Quantity Form -->
            <div class="flex items-center mb-6">
                <label class="mr-4 text-gray-700 font-bold">Quantity:</label>
                <input id="quantity-input" type="number" min="1" value="1" class="w-20 px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button id="add-to-cart-btn" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Add to Cart</button>
                <button id="add-order-btn" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">Buy Now</button>
            </div>
        </div>
    </div>

    <!-- Additional Details -->
    <div class="mt-12">
        <!-- Heading dan Garis -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Comment</h3>
        <hr class="mb-6 border-gray-300">

        <div class="w-full">
            <?php 
            if (count($comments['data']) == 0) {?>
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <p class="text-gray-800">Belum ada Komen !!</p>
                    </div>
                </div>
            <?php }else{
                foreach ($comments['data'] as $comment): ?>
                    <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                        <div class="flex items-center">
                            <div>
                                <h2 class="text-lg font-semibold"><?= esc($comment['name']) ?></h2>
                                <p class="text-sm text-gray-600"><?= esc($comment['created_at']) ?></p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-800"><?= esc($comment['comment']) ?></p>
                        </div>
                    </div>
            <?php 
                endforeach;
            } 
            ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    document.getElementById('add-to-cart-btn').addEventListener('click', function() {
        // Data yang akan dikirim
        const productId = <?= json_encode($data['id']) ?>;
        const quantity = document.getElementById('quantity-input').value;

        // Melakukan POST request menggunakan fetch API
        fetch('<?= base_url('client/cart/') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>' // Untuk keamanan CSRF
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // alert('sukses')
                location.reload();
            } else {
                // alert('gagal')
                location.reload(); // Tetap refresh jika gagal
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
    
    document.getElementById('add-order-btn').addEventListener('click', function() {
        // Data yang akan dikirim
        const productId = <?= json_encode($data['id']) ?>;
        const quantity = document.getElementById('quantity-input').value;

        // Melakukan POST request menggunakan fetch API
        fetch('<?= base_url('client/trx/order/') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>' // Untuk keamanan CSRF
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
                is_cart: 0
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // alert('sukses')
                window.location.href = '<?= base_url() ?>client/trx/'+data.trx_id;
            } else {
                // alert('gagal')
                // console.log(data)
                location.reload(); // Tetap refresh jika gagal
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
</script>
<?= $this->endSection() ?>