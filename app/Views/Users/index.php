<!DOCTYPE html>
<html lang="en">
<?php echo $this->include('Users/Layout/Head'); ?>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <?php echo $this->include('Users/Layout/Navbar'); ?>
    <?php echo $this->include('Users/Layout/Toast'); ?>

    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <?php echo $this->include('Users/Layout/Footer'); ?>
    
    <?php echo $this->include('Users/Layout/Js'); ?>
</body>
</html>
