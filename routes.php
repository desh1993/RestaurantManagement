<?php

require_once __DIR__ . '/router.php';
require_once __DIR__ . '/config/site-settings.php';
$dir = BASE_URL;
$api_dir = API_URL;

get($dir, 'index.php');
get($dir . '/menu', 'views/Menu/index');
get($dir . '/admin', 'views/Admin/Login');
post($dir . '/admin', 'views/Admin/Login');
get($dir . '/admin-profile', 'views/Admin/Profile');

get($dir . '/login', 'views/Customer/Login');
get($dir . '/profile', 'views/Customer/Profile');
post($dir . '/login', 'views/Customer/Login');
post($dir . '/logout', 'views/logout.php');

//orders
get($dir . '/orders', 'views/Orders/Index');

//API
post($api_dir . '/menu-item', 'api/menuApi.php');
get($api_dir . '/menu-item', 'api/menuApi.php');
delete($api_dir . '/menu-item', 'api/menuApi.php');
put($api_dir . '/menu-item', 'api/menuApi.php');
get($api_dir . '/table', 'api/tableApi.php');
any('/404', 'views/404.php');
