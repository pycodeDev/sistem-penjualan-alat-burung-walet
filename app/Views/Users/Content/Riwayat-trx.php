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
                <input type="text" name="search" placeholder="Search by transaction ID" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300" required>
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
                 <?php 
                 if (count($data) == 0) {?>
                 <tr>
                    <td colspan ="5">Tidak Ada Data !!</td>
                 </tr>
                 <?php   
                 }else {
                    foreach ($data as $trx) {
                 ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $trx['trx_id'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?php 
                        $date = explode(" ", $trx['created_at']);
                        echo $date[0];
                        ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?php
                        $price = "Rp " . number_format($trx['price'], 0, ',', '.');
                        echo $price;
                        ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?php
                        if ($trx['status'] == "PENDING") {
                            echo '<span class="inline-block bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded">'.$trx['status'].'</span>';
                        }elseif ($trx['status'] == 'KONFIRM') {
                            echo '<span class="inline-block bg-indigo-500 text-white text-xs font-semibold px-2 py-1 rounded">'.$trx['status'].'</span>';
                        }elseif ($trx['status'] == 'SHIPPING') {
                            echo '<span class="inline-block bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded">'.$trx['status'].'</span>';
                        }elseif ($trx['status'] == 'SUCCESS') {
                            echo '<span class="inline-block bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">'.$trx['status'].'</span>';
                        }else {
                            echo '<span class="inline-block bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">'.$trx['status'].'</span>';
                        }
                        ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="<?= base_url() ?>client/trx/<?= $trx['trx_id'] ?>" class="text-blue-600 hover:text-blue-800">View Details</a>
                    </td>
                </tr>
                <?php
                }
                }
                ?>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>