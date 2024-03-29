<?php

namespace RMS;

use RMS\OrderItems;

require_once __DIR__ . '/../Model/OrderItems.php';
require_once __DIR__ . '/../config/site-settings.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
$orderItems = new OrderItems();
$url = API_URL . '/order-items';

switch ($method) {
    case 'GET':
        // if (isset($_GET['search'])) {
        //     $search = $_GET['search'];
        //     $results = $menuItem->searchMenu($search);
        //     echo $results;
        // } else if (isset($_GET['item'])) {
        //     $menuId = (int)$_GET['item'];
        //     $response = $menuItem->getMenuById($menuId);
        //     echo json_encode($response);
        // } else if (isset($_GET['all'])) {
        //     $response = $menuItem->getAllMenuItems();
        //     echo json_encode($response);
        // }
        break;
    case 'POST':
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'));
        // $response = $body;
        $response = $orderItems->addOrderItems($body);
        echo json_encode($response);
        break;
    case 'DELETE':
        // header('Content-Type: application/json');
        // $menuId = (int)$_GET['item'];
        // $response = $menuItem->deleteMenu($menuId);
        // echo json_encode($response);
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
