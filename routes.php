<?php

require_once __DIR__ . '/router.php';
require_once __DIR__ . '/config/site-settings.php';
$dir = BASE_URL;
$api_dir = API_URL;

get($dir, 'index.php');
get($dir . '/menu', 'views/Menu/index');

//API
post($api_dir . '/menu-item', 'api/menuApi.php');
get($api_dir . '/menu-item', 'api/menuApi.php');
