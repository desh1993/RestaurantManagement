<?php

namespace RMS;

require_once __DIR__ . '/../Model/Base.php';

class Table extends Base
{
    protected $table = 'tables';
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

    public function getAllTables()
    {
        $query = "SELECT * from $this->table";
        $paramType = '';
        $paramValue = array();
        $response = $this->ds->select($query, $paramType, $paramValue);
        return $response;
    }

    public function searchTable($id)
    {
        $name = '%' . $id . '%';
        $query = "SELECT * from $this->table WHERE id LIKE ?";
        $paramType = 's';
        $paramValue = array($name);
        $menus = $this->ds->select($query, $paramType, $paramValue);
        return json_encode($menus, JSON_PRETTY_PRINT);
    }
}
