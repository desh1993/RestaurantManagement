<?php

namespace RMS;

use RMS\Table;

require_once __DIR__ . '/../Model/Table.php';
require_once __DIR__ . '/../config/site-settings.php';

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['REQUEST_URI'];
$table = new Table();
$url = API_URL . '/table';

switch ($method) {
    case 'GET':
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $results = $table->searchTable($search);
            echo $results;
        } else {
            // Get all tables
            $results = $table->getAllTables();
            // $results = ['message' => 'Updating table.', 'data' => $body->data, 'menuId' => $body->menuId];
            echo json_encode($results);
        }
        break;

    default:
}
