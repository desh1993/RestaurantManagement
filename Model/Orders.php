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
}
