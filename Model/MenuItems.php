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

    public function deleteMenu($menuId)
    {
        $query = 'DELETE FROM MenuItems WHERE MenuItemId = ? ';
        $paramType = 'i';
        $paramArray = [$menuId];
        $result = $this->ds->delete($query, $paramType, $paramArray);
        return $result;
    }

    public function updateMenu($menuId, $data)
    {
        try {
            $sql = 'UPDATE MenuItems SET Name = ?, Description = ?, Price = ? WHERE MenuItemId = ?';

            $paramType = 'ssdi'; // Corrected parameter type for Price as a decimal or floating-point number

            $params = [
                $data->name,
                $data->description,
                $data->price,
                $menuId // Use the function parameter $menuId here
            ];

            // Perform the update operation
            $isUpdated = $this->ds->update($sql, $paramType, $params);

            if ($isUpdated) {
                return $isUpdated; // Return true if update was successful
            } else {
                throw new Exception('Error updating menu item.'); // Throw an exception if update failed
            }
        } catch (Exception $e) {
            return $e->getMessage(); // Return the error message if an exception occurs
        }
    }
}
