<?php

use RMS\AdminMiddleware;

require_once  __DIR__ . '/../../Middlewares/AdminMiddleware.php';
$admin_middleware = new AdminMiddleware();
$admin_middleware->adminMiddleware($_SESSION);
