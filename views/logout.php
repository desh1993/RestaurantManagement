<?php

use RMS\Customers;
use RMS\Admin;

require_once __DIR__ . "/../Model/Admin.php";
require_once __DIR__ . "/../Model/Customers.php";

session_start();
if (isset($_SESSION)) {
    if (isset($_SESSION['role'])) {
        # code...
        $admin = new Admin();
        $response = $admin->logoutUser();
    } else {
        $user = new Customers();
        $response = $user->logoutUser();
    }
}
