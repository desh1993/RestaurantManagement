<?php

namespace RMS;

require_once __DIR__ . '/../Model/Base.php';

class MenuItems extends Base
{
    protected $ds;
    private $limit = 10;
    protected $base_url;

    function __construct()
    {
        $base = new Base();
        $this->base_url = $base->base_url;
        $this->ds = $base->ds;
    }

    public function getAllMenuItems()
    {
        $query = "SELECT * from MenuItems";
        $paramType = '';
        $paramValue = array();
        $response = $this->ds->select($query, $paramType, $paramValue);
        return $response;
    }

    protected function convertMenuItemsToObject($menuItems)
    {
        $result = [];
        foreach ($menuItems as $item) {
            $result[$item->name] = $item->value;
        }
        return $result;
    }

    public function addMenuItems($data)
    {
        $query = 'INSERT INTO MenuItems(Name,Description,Price) VALUES (?,?,?)';
        $paramType = 'ssd';
        $name = $data->data->itemName;
        $description =  $data->data->itemDescription;
        $price =  $data->data->itemPrice;
        $paramArray = [$name, $description, $price];
        $result = $this->ds->insert($query, $paramType, $paramArray);
        return $result;
    }

    public function getMenuById($menuId)
    {
        $query = "SELECT * from MenuItems WHERE MenuItemId = ?";
        $paramType = 'i';
        $paramValue = array($menuId);
        $response = $this->ds->selectOne($query, $paramType, $paramValue);
        return $response;
    }

    public function searchMenu($name)
    {
        $name = '%' . $name . '%';
        $query = "SELECT * from MenuItems WHERE Name LIKE ?";
        $paramType = 's';
        $paramValue = array($name);
        $menus = $this->ds->select($query, $paramType, $paramValue);
        return json_encode($menus, JSON_PRETTY_PRINT);
    }
}
