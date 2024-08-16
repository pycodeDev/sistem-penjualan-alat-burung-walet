<!-- Navbar -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-gray-800">Marketplace</a>
            <div class="flex items-center">
                <a href="#" class="text-gray-600 hover:text-gray-800 mx-4">Home</a>
                <a href="#" class="text-gray-600 hover:text-gray-800 mx-4">Shop</a>
                <a href="#" class="text-gray-600 hover:text-gray-800 mx-4">Contact</a>
            </div>
            <?php
            if (session()->get('logged_in')) {?>
            <div class="flex items-center">
                <a href="#" class="text-gray-600 hover:text-gray-800 mx-4"> 
                    <i class="fa fa-cart-plus"></i>
                </a>
                <a href="#" class="text-gray-600 px-4 py-2 rounded hover:text-gray-800">
                <i class="fa fa-user"><?= session()->get('name') ?></i>
                </a>
            </div>
            <?php }else {?>
            <div class="flex items-center">
                <a href="#" class="text-gray-600 hover:text-gray-800 mx-4">Login</a>
                <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Sign Up</a>
            </div>
            <?php }
            ?>
        </div>
    </div>
</nav>