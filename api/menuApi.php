<?php

namespace RMS;

use RMS\MenuItems;

require_once __DIR__ . '/../Model/MenuItems.php';
require_once __DIR__ . '/../config/site-settings.php';
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// session_start();

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
$menuItem = new MenuItems();
$url = API_URL . '/menu-item';

switch ($method) {
    case 'GET':
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $results = $menuItem->searchMenu($search);
            echo $results;
        } else if (isset($_GET['item'])) {
            $menuId = (int)$_GET['item'];
            $response = $menuItem->getMenuById($menuId);
            echo json_encode($response);
        }
        break;
    case 'POST':
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'));
        $response = $menuItem->addMenuItems($body);
        echo json_encode($response);
        break;
    default:
}
