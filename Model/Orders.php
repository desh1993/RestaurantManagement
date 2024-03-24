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
}
