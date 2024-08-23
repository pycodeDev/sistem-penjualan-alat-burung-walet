<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Product Grid -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Best Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x300" alt="Product 1" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800">Product 1</h3>
                <p class="text-gray-600 mt-2">$25.00</p>
                <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-600">Add to Cart</button>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x300" alt="Product 2" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800">Product 2</h3>
                <p class="text-gray-600 mt-2">$30.00</p>
                <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-600">Add to Cart</button>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/400x300" alt="Product 3" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800">Product 3</h3>
                <p class="text-gray-600 mt-2">$20.00</p>
                <button class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-600">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- Divider Line -->
<hr class="my-8">

<!-- Search Form -->
<div class="container mx-auto px-6 py-4">
    <form action="#" method="GET">
        <div class="flex justify-center">
            <input type="text" name="search" placeholder="Search products..." class="w-full md:w-1/2 px-4 py-2 border rounded-l-lg focus:outline-none">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600">Search</button>
        </div>
    </form>
</div>

<!-- Product List with Pagination -->
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
                foreach ($data as $value) { 
                $rupiah = "Rp " . number_format($value['price'], 0, ',', '.');
            ?>
            <!-- Repeatable Product Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="<?= $value['image'] ?>" alt="Product 4" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800"><?= $value['name'] ?></h3>
                    <p class="text-gray-600 my-2"><?= $rupiah ?></p>
                    <a href="<?= base_url() ?>client/product/<?= $value['id'] ?>" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-600">Detail</a>
                </div>
            </div>
            <?php
                }
            ?>
    </div>
    
    <!-- Pagination -->
    <div class="flex justify-center mt-6">
        <nav class="inline-flex">
            <a href="#" class="px-3 py-2 mx-1 bg-white border rounded-lg hover:bg-gray-200">Previous</a>
            <a href="#" class="px-3 py-2 mx-1 bg-white border rounded-lg hover:bg-gray-200">Next</a>
        </nav>
    </div>
</div>
<?= $this->endSection() ?>