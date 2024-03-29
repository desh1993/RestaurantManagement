<?php

use RMS\OrderItems;

require_once __DIR__ . '/../../Model/OrderItems.php';

$orderId = (int)$orderId;
$orderItems = new OrderItems();
$items = $orderItems->getOrderItemsByOrderId($orderId);
$title = 'Orders';
include './views/partials/header.php';
include './views/partials/navbar.php';

include './views/partials/admin_middleware.php';

// Show admin profile page
$username = null;

if (isset($_SESSION['username'])) {
    # code...
    $username = $_SESSION['username'];
}

var_dump($username);
