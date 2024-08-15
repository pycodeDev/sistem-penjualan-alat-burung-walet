<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Product Detail -->
<div class="container mx-auto px-6 py-8 flex-grow">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Image -->
            <div class="flex-shrink-0 w-full md:w-1/2">
                <img src="https://via.placeholder.com/600x400" alt="Product Image" class="w-full h-auto object-cover rounded-lg shadow-md">
            </div>

            <!-- Product Info -->
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Product Name</h2>
                <p class="text-gray-600 text-xl mb-4">$50.00</p>
                <p class="text-gray-700 mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
                
                <!-- Quantity Form -->
                <div class="flex items-center mb-6">
                    <label class="mr-4 text-gray-700 font-bold">Quantity:</label>
                    <input type="number" min="1" value="1" class="w-20 px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Add to Cart</button>
                    <button class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">Buy Now</button>
                </div>
            </div>
        </div>

        <!-- Additional Details -->
        <div class="mt-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Product Details</h3>
            <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</p>
            <ul class="list-disc pl-5 text-gray-700">
                <li>Feature 1</li>
                <li>Feature 2</li>
                <li>Feature 3</li>
                <li>Feature 4</li>
            </ul>
        </div>
    </div>
<?= $this->endSection() ?>