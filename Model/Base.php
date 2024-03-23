<?php

namespace RMS;

class Base
{
    protected $ds;
    protected $base_url;
    protected $order_generate_key;

    function __construct()
    {
        $configFilePath = __DIR__ . '/../config/site-settings.php';
        require_once($configFilePath);
        require_once __DIR__ . '/../lib/DB.php';
        $this->base_url = BASE_URL;
        $this->order_generate_key   = ORDER_GENERATE_KEY;
        $this->ds = new DB();
        return $this->ds;
    }
}
