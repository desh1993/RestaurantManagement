<?php

namespace RMS;

use RMS\Customers;

require_once __DIR__ . '/../Model/Customers.php';
require_once __DIR__ . '/../config/site-settings.php';

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
$customer = new Customers();
$url = API_URL . '/menu-item';

switch ($method) {
    case 'GET':
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $results = $customer->searchCustomer($search);
            echo $results;
        }
        break;
    default:
}
