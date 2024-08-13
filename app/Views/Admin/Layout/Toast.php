<?php if(session()->getFlashdata('success_login')): ?>
    <script>
      toastr.success("<?= session()->getFlashdata('success_login') ?>")
    </script>
<?php endif; ?>
<?php if(session()->getFlashdata('success')): ?>
    <script>
      toastr.success("<?= session()->getFlashdata('success') ?>")
    </script>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <script>
      toastr.error("<?= session()->getFlashdata('error') ?>")
    </script>
<?php endif; ?>