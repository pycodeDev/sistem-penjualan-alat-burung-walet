<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Search Form -->
<div class="container mx-auto px-6 py-4">
    <form action="<?=base_url()?>client/search/product" method="GET">
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
            <a href="<?=base_url()?>clientproduct/<?=$back?>/back" class="px-3 py-2 mx-1 bg-white border rounded-lg hover:bg-gray-200">Previous</a>
            <a href="<?=base_url()?>clientproduct/<?=$next?>/next" class="px-3 py-2 mx-1 bg-white border rounded-lg hover:bg-gray-200">Next</a>
        </nav>
    </div>
</div>
<?= $this->endSection() ?>