<?php

use RMS\MenuItems;

require_once __DIR__ . '/Model/MenuItems.php';

$menu_items = new MenuItems();
$result = $menu_items->getAllMenuItems();
$title = 'Home Page';
include './views/partials/header.php';
include './views/partials/navbar.php';
?>

<body>
    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to Restaurant Management System</h1>
            <p class="lead">Your ultimate destination for delicious food and exceptional service.</p>
            <hr class="my-4">
            <p>Explore our menu, make reservations, manage orders, and more!</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Get Started</a>
        </div>
    </div>
</body>