<?php

include './views/partials/header.php';
include './views/partials/navbar.php';

include './views/partials/admin_middleware.php';


$username = null;

if (isset($_SESSION['username'])) {
    # code...
    $username = $_SESSION['username'];
}
?>

<h1>Admin Profile <?php echo $username; ?></h1>