<?php
session_start();
$displayItems = false;
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
    // User is logged in, so display the <li> items
    $displayItems = true;
} else {
    // User is not logged in, so hide the <li> items
    $displayItems = false;
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Restaurant Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>

                <?php if ($displayItems) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders">Orders</a>
                    </li>
                    <form method="post" action="logout">
                        <button type="submit" class="nav nav-link">Logout</button>
                    </form>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-login" tabindex="-1" aria-disabled="true">Admin Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login" tabindex="-1" aria-disabled="true">Customer Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>