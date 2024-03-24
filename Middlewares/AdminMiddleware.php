<?php

namespace RMS;

class AdminMiddleware
{

    private $base_url;

    function __construct()
    {
        $configFilePath = __DIR__ . '/../config/site-settings.php';
        require_once($configFilePath);
        $this->base_url = BASE_URL;
    }


    public function adminMiddleware($session)
    {
        if (!isset($session['isLoggedIn']) || $session['isLoggedIn'] !== true || !isset($session['role'])) {
            $url = $this->base_url . "/admin";
            header("Location: $url");
            exit;
        }
        return true;
    }
}
