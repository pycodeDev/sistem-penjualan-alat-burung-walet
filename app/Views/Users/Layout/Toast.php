<div id="toast" class="hidden fixed top-4 right-4 max-w-xs  border  rounded-lg shadow-lg flex items-center space-x-4 p-4">
    <div class="flex-shrink-0">
        <!-- Icon sesuai tipe toast -->
        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
    </div>
    <div class="text-sm font-medium text-gray-600" id="msg">
        
    </div>
    <button onclick="hideToast()" class="ml-auto bg-transparent text-gray-400 hover:text-gray-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>