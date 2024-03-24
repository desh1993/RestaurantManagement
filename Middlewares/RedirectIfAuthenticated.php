<?php

namespace RMS;

class RedirectIfAuthenticated
{
    private $base_url;
    function __construct()
    {
        $configFilePath = __DIR__ . '/../config/site-settings.php';
        require_once($configFilePath);
        $this->base_url = BASE_URL;
    }

    public function handle($session)
    {
        if (!isset($session['isLoggedIn'])) {
            return;
        } else if (isset($session['isLoggedIn']) || $session['isLoggedIn'] == true) {
            $url = $this->base_url . "/profile";
            header("Location: $url");
            exit;
        }
    }
}
