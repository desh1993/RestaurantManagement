<?php

use RMS\OrderItems;
use RMS\Orders;

require_once __DIR__ . '/../../Model/OrderItems.php';
require_once __DIR__ . '/../../Model/Orders.php';

$orderId = $_GET['orderId'] ? (int)$_GET['orderId'] : null;
$orderItems = new OrderItems();
$orders = new Orders();
$items = $orderItems->getOrderItemsByOrderId($orderId);
$orderResults = $orders->getOrderById($orderId);
$orderNumber = null;
$total = 0;

$title = 'Orders';
include './views/partials/header.php';
include './views/partials/navbar.php';
include './views/partials/admin_middleware.php';


$username = null;

if (isset($_SESSION['username'])) {
    # code...
    $username = $_SESSION['username'];
}

if ($orderResults) {
    $orderNumber = $orderResults['OrderNumber'];
}

if ($items !== null) {
    $total = array_reduce($items, function ($carry, $item) {
        return $carry + $item['TotalPrice'];
    }, 0);
}

?>

<div class="container mt-4">
    <?php if ($items === null || $orderResults === null) : ?>
        <div class="row">
            <div class="col-md-6">
                <h3>No items found</h3>
            </div>
        </div>
    <?php else : ?>
        <input type="hidden" name="order_id_hidden" class="order_id_hidden" value="<?php echo $orderId; ?>">
        <div class="row">
            <h1>Order : <?php echo ($orderNumber); ?></h1>
        </div>
        <div class="row">
            <div class="text-end">
                <button id="addItemBtn" type=" button" class="btn btn-success add-btn" data-item-id="<?php echo $item['OrderId'] ?>">Add Item</button>
            </div>

        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>OrderId</th>
                    <th>Name</th>
                    <th colspan="3">Quantity</th>
                    <th>Price Per Item</th>
                    <th>SubTotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="orderItemsList">
                <?php foreach ($items as $key => $item) :  ?>
                    <tr class="<?php echo $item['id'] . '_row'; ?>">
                        <td>
                            <?php echo $key + 1 ?>
                        </td>
                        <td>
                            <?php echo $item['id'] ?>
                        </td>
                        <td>
                            <?php echo $item['Name'] ?>
                        </td>
                        <td colspan="3">
                            <!-- Quantity -->
                            <div class="input-group mb-3 quantityDiv" style="max-width: 150px;" data-id="<?php echo $item['OrderId']; ?>">
                                <button class="btn btn-outline-primary decrease-quantity" type="button" data-id="<?php echo $item['id']; ?>">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <input id="form1" min="1" name="item_1_quantity" value="<?php echo $item['Quantity']; ?>" type="number" class="form-control quantity-btn text-center" aria-label="Quantity" aria-describedby="quantity-label">
                                <button class="btn btn-outline-primary increase-quantity" type="button" data-id="<?php echo $item['id']; ?>">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <!-- Quantity -->
                        </td>
                        <td>
                            <?php echo $item['PricePerItem'] ?>
                        </td>
                        <td class="subtotal">
                            <?php echo $item['TotalPrice'] ?>
                        </td>
                        <td>
                            <button type=" button" class="btn btn-danger btn-sm delete-btn" data-item-id="<?php echo $item['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <button type=" button" class="btn btn btn-warning update-btn" data-item-id="<?php echo $item['OrderId'] ?>">Update Order</button>
                    </td>
                    <td colspan="5" style="text-align: right;"><strong>Total:</strong></td>
                    <td colspan="2" class="total">RM
                        <span class="total-amount">
                            <?php echo $total; ?>
                        </span>
                    </td> <!-- Display total in the footer -->
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
</div>

<!-- Add Order Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Item </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="addItemForm" id="addItemForm">
                    <div id="menuItemsContainer">
                        <div class="mb-3">
                            <label for="item-1" class="form-label">Choose Menu 1</label>
                            <div>
                                <div class="menu-item-input">
                                    <input type="text" class="menu-item form-control" id="item-1" name="item_1">
                                    <input type="hidden" name="item_1_hidden" class="menu-item-hidden">
                                    <input type="hidden" name="item_1_price_hidden" class="item_1_price_hidden menu-price-hidden">
                                </div>
                                <div class="quantity-input mt-3 d-flex justify-content-end">
                                    <!-- Quantity -->
                                    <div class="input-group mb-3 updateQuantityDiv" style="max-width: 150px;" data-id="<?php echo $orderResults['id']; ?>">
                                        <button class="btn btn-outline-primary update-decrease-quantity" type="button" onclick="this.nextElementSibling.stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="1" name="item_1_quantity" value="1" type="number" class="form-control quantity-btn text-center" aria-label="Quantity" aria-describedby="quantity-label">

                                        <button class="btn btn-outline-primary update_increase-quantity" type="button" data-id="item_1" onclick="this.previousElementSibling.stepUp()">
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
<script type="module" src="js/OrderItems/index.js"></script>