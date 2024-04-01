<?php

namespace RMS;

require_once __DIR__ . '/../Model/Base.php';

class Orders extends Base
{
    protected $table = 'Orders';
    protected $base_url;
    protected $ds;

    /**
     * Constructor
     */
    function __construct()
    {
        $base = new Base();
        $this->base_url = $base->base_url;
        $this->ds = $base->ds;
    }

    public function getOrders()
    {
        $query = "SELECT * from $this->table";
        $paramType = '';
        $paramValue = array();
        $response = $this->ds->select($query, $paramType, $paramValue);
        return $response;
    }

    public function getOrderById($orderId)
    {
        $query = "SELECT * from $this->table WHERE id = ?";
        $paramType = 'i';
        $paramValue = array($orderId);
        $response = $this->ds->select($query, $paramType, $paramValue);
        return $response[0];
    }

    private function generateOrderNumber($length = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function addOrders($data)
    {
        try {
            //code...
            $query = "INSERT INTO $this->table(OrderNumber,TableId,CustomerId,StaffId) VALUES (?,?,?,?)";
            $paramType = 'siii';
            $orderNumber = $this->generateOrderNumber();
            $tableId =  $data->tableId;
            $customerId =  $data->customerId ? $data->customerId : null;
            $staffId =  $_SESSION['userId'];

            $paramArray = [$orderNumber, $tableId, $customerId, $staffId];
            $result = $this->ds->insert($query, $paramType, $paramArray);
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //Search order by table number,customer name or order number
    public function searchOrders($name)
    {
        $name = '%' . $name . '%';
        $query = "SELECT o.id as OrderId, 
        o.OrderNumber as OrderNumber , 
        o.TableId as TableNo, 
        o.CustomerId as CustomerId, 
        c.username as CustomerName
        FROM `Orders` as o
        INNER JOIN Customers AS c
        ON o.CustomerId = c.id
        WHERE 
        c.username LIKE ?
        OR OrderNumber LIKE ?
        OR TableId = ?";
        $paramType = 'sss';
        $paramValue = array($name, $name, $name);
        $menus = $this->ds->select($query, $paramType, $paramValue);
        return json_encode($menus, JSON_PRETTY_PRINT);
    }
}
