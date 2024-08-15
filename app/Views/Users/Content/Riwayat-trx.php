<?= $this->extend('Users/Index') ?>
<?= $this->section('content') ?>
<!-- Transaction History -->
<div class="container mx-auto px-6 py-8 flex-grow">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Transaction History</h2>

    <!-- Search Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Search Transactions</h3>
        <form action="#" method="GET">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Search by transaction ID, date, or status" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
                <button type="submit" class="ml-4 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Search</button>
            </div>
        </form>
    </div>

    <!-- Transactions List -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Transactions</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Example Transaction Row -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">123456</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-08-14</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$55.00</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Completed</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-blue-600 hover:text-blue-800">View Details</a>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>