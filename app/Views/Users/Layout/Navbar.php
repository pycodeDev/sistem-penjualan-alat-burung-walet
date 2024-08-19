<!-- Navbar -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-gray-800">Marketplace</a>
            <?php
            if (session()->get('logged_in_user')) {?>

            <div class="flex items-center">
                <a href="<?= base_url() ?>client/home" class="text-gray-600 hover:text-gray-800 mx-4">Home</a>
                <a href="<?= base_url() ?>client/product" class="text-gray-600 hover:text-gray-800 mx-4">Product</a>
                <a href="<?= base_url() ?>client/trx" class="text-gray-600 hover:text-gray-800 mx-4">Trx</a>
            </div>
            
            <div class="flex items-center">
                <!-- Cart Icon with Dropdown -->
                <div class="relative">
                    <a href="#" class="text-gray-600 hover:text-gray-800 mx-4" id="cartDropdownToggle">
                        <i class="fa fa-cart-plus"></i>
                        <span class="ml-1">3</span> <!-- Display the number of items in the cart -->
                    </a>
                    <!-- Dropdown Menu -->
                    <div id="cartDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                        <div class="py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">View Cart</a>
                        </div>
                    </div>
                </div>

                <!-- User Icon with Dropdown -->
                <div class="relative">
                    <a href="#" class="text-gray-600 px-4 py-2 rounded hover:text-gray-800" id="userDropdownToggle">
                        <i class="fa fa-user"></i> <?= session()->get('name') ?>
                    </a>
                    <!-- Dropdown Menu -->
                    <div id="userDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 hidden">
                        <div class="py-2">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php }else {?>
            <div class="flex items-center">
            <a href="<?= base_url() ?>client/home" class="text-gray-600 hover:text-gray-800 mx-4">Home</a>
            <a href="<?= base_url() ?>client/product" class="text-gray-600 hover:text-gray-800 mx-4">Product</a>
            </div>
            <div class="flex items-center">
                <a href="<?= base_url(); ?>client/login" class="text-gray-600 hover:text-gray-800 mx-4">Login</a>
                <a href="<?= base_url(); ?>client/register" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Sign Up</a>
            </div>
            <?php }
            ?>
        </div>
    </div>
</nav>