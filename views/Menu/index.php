<?php

use RMS\MenuItems;

require_once __DIR__ . '/../../Model/MenuItems.php';

$menu_items = new MenuItems();
$items = $menu_items->getAllMenuItems();
$title = 'Menu';
include './views/partials/header.php';
include './views/partials/navbar.php';

$single_item = isset($_GET['item-id']) ? (int)$_GET['item-id'] : null;

?>

<div class="container mt-4">
    <h1>Our Menu</h1>
    <?php if ($single_item !== null) : ?>
        <?php include 'SingleItem.php'; ?>
    <?php else : ?>
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="addItemBtn">
                    Add New Item
                </button>
            </div>
            <!-- <div class="col-md-6">
                <input type="text" class="form-control searchProduct" placeholder="Search Menu">
                <div class="spinner-border loader-menu-items" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="position-relative">
                    <input type="text" class="form-control searchMenu" placeholder="Search Menu">
                    <div class="spinner-border loader-menu-items position-absolute end-0 top-0" role="status" style="display:none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="menuItemsList">
                <?php foreach ($items as $key => $item) : ?>
                    <!-- Menu items will be dynamically added here -->
                    <tr>
                        <td>
                            <?php echo $key + 1 ?>
                        </td>
                        <td>
                            <?php echo $item['Name'] ?>
                        </td>
                        <td>
                            <?php echo $item['Description'] ?>
                        </td>
                        <td>
                            <?php echo $item['Price'] ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-item-id="<?php echo $item['MenuItemId']  ?>
                            data-bs-target=" #editItemModal" ">Edit</button>
                            <button type=" button" class="btn btn-danger btn-sm delete-btn" data-item-id="<?php echo $item['MenuItemId'] ?>">Delete</button>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" id='addItemBtn'>
        Add New Item
    </button>
    <input type="text" class="form-control searchProduct" placeholder="Search Menu"> -->

</div>


<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="addItemForm" id="addItemForm">
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="itemName" required name="itemName">
                    </div>
                    <div class="mb-3">
                        <label for="itemDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="itemDescription" rows="3" name="itemDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="itemPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="itemPrice" name="itemPrice" step="0.01" required>
                    </div>
                    <input class="btn btn-primary" type="submit" name="submit-btn" id="submit-btn" value="Add Menu">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="editItemForm" id="editItemForm">
                    <div class="mb-3">
                        <label for="editItemName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editItemName" required name="editItemName">
                    </div>
                    <div class="mb-3">
                        <label for="editItemDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editItemDescription" rows="3" name="editItemDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editItemPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editItemPrice" name="editItemPrice" step="0.01" required>
                    </div>
                    <input type="hidden" id="editItemId" name="editItemId">
                    <input class="btn btn-primary" type="submit" name="edit-submit-btn" id="edit-submit-btn" value="Save Changes">
                </form>
            </div>
        </div>
    </div>
</div>



<script type="module" src="js/Menu/index.js"></script>
<script type="module" src="js/Menu/search.js"></script>