<?php

namespace RMS;

use RMS\Orders;

require_once __DIR__ . '/../Model/Orders.php';
require_once __DIR__ . '/../config/site-settings.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
$order = new Orders();
$url = API_URL . '/orders';

switch ($method) {
    case 'GET':
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $results = $order->searchOrders($search);
            echo $results;
        }
        break;
    case 'POST':
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'));
        $response = $order->addOrders($body);
        echo json_encode($response);
        break;
    case 'DELETE':
        header('Content-Type: application/json');
        $orderId = (int)$_GET['orderId'];
        $response = $order->deleteOrderById($orderId);
        echo json_encode($response);
        break;
    case 'PUT':
        // # code...
        // header('Content-Type: application/json');
        // $body = json_decode(file_get_contents('php://input'));
        // // $response = ['message' => 'Updating Menu.', 'data' => $body->data, 'menuId' => $body->menuId];
        // $response = $menuItem->updateMenu($body->menuId, $body->data);
        // echo json_encode($response);
        break;
    default:
}
