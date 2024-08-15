<!-- Navbar -->
<nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="#" class="text-2xl font-bold text-gray-800">Marketplace</a>
                <div class="flex items-center">
                    <!-- Conditional Rendering for Icons and Dropdowns -->
                    <div id="user-cart-icons" class="flex items-center space-x-4">
                        <!-- Cart Icon with item count -->
                        <div class="relative dropdown">
                            <a href="#" id="cart-icon" class="text-gray-600 hover:text-gray-800">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l1 9h12l1-9h2M6 21h12a2 2 0 002-2V6H4v13a2 2 0 002 2z"></path>
                                </svg>
                                <span id="cart-item-count" class="absolute top-0 right-0 transform -translate-x-1/2 translate-y-1/2 bg-red-500 text-white text-xs font-bold rounded-full px-2 py-1">0</span>
                            </a>
                            <!-- Dropdown Content -->
                            <div class="dropdown-content absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">View Cart</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Checkout</a>
                            </div>
                        </div>

                        <!-- User Icon with dropdown -->
                        <div class="relative dropdown">
                            <a href="#" id="user-icon" class="text-gray-600 hover:text-gray-800">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5v14M5 7h14M5 9h14M5 11h14"></path>
                                </svg>
                            </a>
                            <!-- Dropdown Content -->
                            <div class="dropdown-content absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Orders</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-gray-600 hover:text-gray-800 mx-4">Home</a>
                        <a href="#" class="text-gray-600 hover:text-gray-800 mx-4">Shop</a>
                        <a href="#" class="text-gray-600 hover:text-gray-800 mx-4">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>