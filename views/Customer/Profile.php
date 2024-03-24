<?php

include './views/partials/header.php';
include './views/partials/navbar.php';

include './views/partials/customer_middleware.php';


// Show admin profile page
$username = null;

if (isset($_SESSION['username'])) {
    # code...
    $username = $_SESSION['username'];
}
?>


<h1>Welcome <?php echo $username; ?></h1>