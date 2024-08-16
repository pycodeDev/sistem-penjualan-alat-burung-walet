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
</script>
