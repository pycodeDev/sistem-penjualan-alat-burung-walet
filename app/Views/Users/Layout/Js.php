<?= $this->renderSection('js') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartDropdownToggle = document.getElementById('cartDropdownToggle');
        const cartDropdownMenu = document.getElementById('cartDropdownMenu');

        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdownMenu = document.getElementById('userDropdownMenu');

        // Toggle Cart Dropdown
        cartDropdownToggle.addEventListener('click', function (event) {
            event.preventDefault();
            cartDropdownMenu.classList.toggle('hidden');
        });

        // Toggle User Dropdown
        userDropdownToggle.addEventListener('click', function (event) {
            event.preventDefault();
            userDropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', function (event) {
            if (!cartDropdownToggle.contains(event.target)) {
                cartDropdownMenu.classList.add('hidden');
            }
            if (!userDropdownToggle.contains(event.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    });

    function showToast(message, tipe) {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('msg');
        toastMessage.textContent = message;  // Pesan ditempatkan di sini   
        if (tipe == "toast") {
            toast.classList.add('bg-green-200');
            toast.classList.add('border-green-200');
        }else{
            toast.classList.add('bg-red-200');
            toast.classList.add('border-red-200');
        }
        toast.classList.remove('hidden');
        toast.classList.add('fade-in');

        // Toast akan otomatis hilang setelah 3 detik
        setTimeout(() => {
            hideToast();
        }, 3000); // 3000 ms = 3 detik
    }

    function hideToast() {
        const toast = document.getElementById('toast');
        toast.classList.add('fade-out');
        setTimeout(() => {
            toast.classList.remove('fade-in', 'fade-out');
            toast.classList.add('hidden');
        }, 500); // Durasi animasi fade-out
    }
    <?php if(session()->getFlashdata('err_msg')): ?>
        document.addEventListener('DOMContentLoaded', () => {
            showToast("<?= session()->getFlashdata('err_msg') ?>", "toast-error");
        });
    <?php endif; ?>
    <?php if(session()->getFlashdata('msg')): ?>
        document.addEventListener('DOMContentLoaded', () => {
            showToast("<?= session()->getFlashdata('msg') ?>", "toast");
        });
    <?php endif; ?>
</script>
