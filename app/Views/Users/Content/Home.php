<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Product Grid -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">New Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        foreach ($new_product as $prd):
            $rupiah = "Rp " . number_format($prd['price'], 0, ',', '.');
        ?>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="<?= $prd['image'] ?>" alt="Product 1" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800"><?= $prd['name']; ?></h3>
                <p class="text-gray-600 my-2"><?= $rupiah; ?></p>
                <a href="<?= base_url() ?>client/product/<?= $prd['id'] ?>" class="bg-blue-500 text-white px-4 py-2 mt-4 rounded hover:bg-blue-600">Detail</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Divider Line -->
<hr class="my-8">
</div>
<?= $this->endSection() ?>