<?php

use RMS\Orders;

require_once __DIR__ . '/../../Model/Orders.php';

$orders = new Orders();
$result = $orders->getOrders();
$title = 'Orders';
include './views/partials/header.php';
include './views/partials/navbar.php';
include './views/partials/admin_middleware.php';
$is_admin = isset($_SESSION['role']) ? true : false

?>
<div class="container mt-4">
    <h1>Orders</h1>
    <div class="row">
        <?php if ($is_admin) : ?>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="addItemBtn">
                    Add New Order
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Order Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Order </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="addItemForm" id="addItemForm">
                    <div class="mb-3">
                        <label for="itemTable" class="form-label">Table</label>
                        <input type="text" class="form-control" id="itemTable" name="itemTable">
                    </div>
                    <div class="mb-3">
                        <label for="itemCustomer" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="itemCustomer" name="itemCustomer" placeholder="Optional">
                        <input type="hidden" class="form-control itemCustomerHidden" id="itemCustomer" name="itemCustomerHidden">
                    </div>
                    <div id="menuItemsContainer">
                        <div class="mb-3">
                            <label for="item-1" class="form-label">Choose Menu 1</label>
                            <div>
                                <div class="menu-item-input">
                                    <input type="text" class="menu-item form-control" id="item-1" name="item_1">
                                    <input type="hidden" name="item_1_hidden" class="menu-item-hidden">
                                </div>
                                <div class="quantity-input mt-3 d-flex justify-content-end">
                                    <!-- Quantity -->
                                    <div class="input-group mb-3 quantityDiv" style="max-width: 150px;" data-id="<?php echo $item['cart_id']; ?>">
                                        <button class="btn btn-outline-primary decrease-quantity" type="button" onclick="this.nextElementSibling.stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="1" name="item_1_quantity" value="1" type="number" class="form-control quantity-btn text-center" aria-label="Quantity" aria-describedby="quantity-label">

                                        <button class="btn btn-outline-primary increase-quantity" type="button" data-id="item_1" onclick="this.previousElementSibling.stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- Quantity -->
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="item-2" class="form-label">Choose Menu 2</label>
                            <div>
                                <div class="menu-item-input">
                                    <input type="text" class="menu-item form-control" id="item-2" name="item_2">
                                    <input type="hidden" name="item_2_hidden" class="menu-item-hidden">
                                </div>
                                <div class="quantity-input mt-3 d-flex justify-content-end">
                                    <!-- Quantity -->
                                    <div class="input-group mb-3 quantityDiv" style="max-width: 150px;" data-id="<?php echo $item['cart_id']; ?>">
                                        <button class="btn btn-outline-primary decrease-quantity" type="button" onclick="this.nextElementSibling.stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="1" name="item_2_quantity" value="1" type="number" class="form-control quantity-btn text-center" aria-label="Quantity" aria-describedby="quantity-label">

                                        <button class="btn btn-outline-primary increase-quantity" type="button" data-id="item_2" onclick="this.previousElementSibling.stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- Quantity -->
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="item-3" class="form-label">Choose Menu 3</label>
                            <div>
                                <div class="menu-item-input">
                                    <input type="text" class="menu-item form-control" id="item-3" name="item_3">
                                    <input type="hidden" name="item_3_hidden" class="menu-item-hidden" value="">
                                </div>
                                <div class="quantity-input mt-3 d-flex justify-content-end">
                                    <!-- Quantity -->
                                    <div class="input-group mb-3 quantityDiv" style="max-width: 150px;" data-id="<?php echo $item['cart_id']; ?>">
                                        <button class="btn btn-outline-primary decrease-quantity" type="button" onclick="this.nextElementSibling.stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="1" name="item_3_quantity" value="1" type="number" class="form-control quantity-btn text-center" aria-label="Quantity" aria-describedby="quantity-label">

                                        <button class="btn btn-outline-primary increase-quantity" type="button" data-id="item_3" onclick="this.previousElementSibling.stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- Quantity -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-outline-success btn-block"><i class="fas fa-plus" id='addMenuBtn'></i> Add Item </button>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-primary" type="submit" name="submit-btn" id="submit-btn" value="Add Menu">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="module" src="js/Order/index.js"></script>