<?php

namespace RMS;

class AuthMiddleware
{

    private $base_url;

    function __construct()
    {
        $configFilePath = __DIR__ . '/../config/site-settings.php';
        require_once($configFilePath);
        $this->base_url = BASE_URL;
    }


    public function authMiddleware($session)
    {

        if (!isset($session['isLoggedIn']) || $session['isLoggedIn'] !== true) {
            $url = $this->base_url . "/login";
            header("Location: $url");
            exit;
        }
        return true;
    }
}
