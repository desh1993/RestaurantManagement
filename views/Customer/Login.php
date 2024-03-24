<?php

use RMS\Customers;

require_once __DIR__ . '/../../Model/Customers.php';


$response = null;

$title = "Customers Login";
include './views/partials/header.php';
include './views/partials/navbar.php';

if (!empty($_POST["login-btn"])) {
    // session_start();
    $customer = new Customers();
    $isLoggedIn = $customer->loginUser();
    if (!$isLoggedIn || $isLoggedIn == "Invalid username or password.") {
        $_SESSION["errorMessage"] = "Invalid Credentials";
    }
}
?>


<main class="login-main">
    <div class="container-fluid">
        <div class="row">
            <?php
            if (isset($_SESSION["errorMessage"])) {
            ?>
                <div class="alert alert-danger" role="alert"><?php echo $_SESSION["errorMessage"]; ?></div>
            <?php
                unset($_SESSION["errorMessage"]);
            }
            ?>
        </div>
        <div class="row">
            <div class="col-12">
                <h2>Customer Login</h2>
            </div>
        </div>
        <div class="row">
            <div id="message"></div>
            <div class="col-md-12 col-12">
                <form action="" name="login" method="post">
                    <div class="mb-3 mt-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="john_doe">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="defaultpassword">
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-primary" type="submit" name="login-btn" id="login-btn" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include './views/partials/footer.php';
?>