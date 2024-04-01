<?php

namespace RMS;

require_once __DIR__ . '/../Model/Base.php';

class OrderItems extends Base
{
    protected $table = 'OrderItems';
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

    public function getOrderItems()
    {
        $query = "SELECT * from $this->table";
        $paramType = '';
        $paramValue = array();
        $response = $this->ds->select($query, $paramType, $paramValue);
        return $response;
    }

    protected function convertOrderDetailsToObject($orderDetails)
    {
        $result = [];
        foreach ($orderDetails as $item) {
            // $result[][] = $item->orderId;
            // $result[][] = $item->id;
            // $result[][] = $item->quantity;

            $result[] = [$item->orderId, $item->id, $item->quantity];
        }
        return $result;
    }

    public function addOrderItems($order_data)
    {
        try {
            /**
             * data is a two dimensional array 
             * $data = [
             *  [6,1,1], //OrderId, MenuId, Quantity
             *  [6,5,1]
             * ]
             */
            $data = $this->convertOrderDetailsToObject($order_data);

            // //code...
            $query = "INSERT INTO $this->table(OrderId,MenuId,Quantity) VALUES";
            $result = $this->ds->insertMultiple($query, $data);
            return  $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOrderItemsByOrderId($orderId)
    {
        try {
            $query = "SELECT 
            i.id,i.OrderId, i.Quantity as Quantity , m.Name , m.Price as PricePerItem , (m.Price * i.Quantity) as TotalPrice
            FROM `OrderItems` as i 
            INNER JOIN MenuItems as m 
            ON i.MenuId = m.MenuItemId 
            WHERE i.OrderId = ?";
            $paramType = 'i';
            $paramValue = array($orderId);
            $result = $this->ds->select($query, $paramType, $paramValue);
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOrderItemsByTableId($tableId)
    {
        try {
            $query = "SELECT
            i.OrderId, 
            i.Quantity as Quantity , 
            m.Name , 
            m.Price as PricePerItem , 
            (m.Price * i.Quantity) as TotalPrice 
            FROM orders as o
            INNER JOIN OrderItems as i 
            ON o.id = i.OrderId
            INNER JOIN MenuItems as m
            ON m.MenuItemId = i.MenuId
            WHERE o.TableId = ?";
            $paramType = 'i';
            $paramValue = array($tableId);
            $result = $this->ds->select($query, $paramType, $paramValue);
            return $result;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    protected function convertOrderDetailsForUpdate($orderDetails)
    {
        $result = [];
        foreach ($orderDetails as $item) {
            // $result[] = [$item->OrderId, $item->id, $item->Quantity];
            $result[] = [$item->Quantity, $item->OrderId, $item->id];
        }
        return $result;
    }

    public function updateOrderItems($order_data, $orderId)
    {
        try {
            //code...
            $sql = "UPDATE $this->table SET Quantity = ? WHERE OrderId = ? AND id = ?";
            $params = $this->convertOrderDetailsForUpdate($order_data);
            $paramTypes = 'iii';
            $result = $this->ds->updateMultipleRows($sql, $paramTypes, $params);
            return $result;
        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }
    }
}
