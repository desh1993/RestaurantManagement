<?php

use RMS\AuthMiddleware;

require_once  __DIR__ . '/../../Middlewares/AuthMiddleware.php';
$auth_middleware = new AuthMiddleware();
$auth_middleware->authMiddleware($_SESSION);
