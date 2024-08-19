<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<style>
    .dropdown-menu {
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .dropdown-menu.show {
        display: block;
        opacity: 1;
    }

    /* tambahkan dalam file CSS Anda */
    .fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .fade-out {
        animation: fadeOut 0.5s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(10px); }
    }

</style>
