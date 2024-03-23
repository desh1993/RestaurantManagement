<?php
$item_id = $_GET['item-id'];
$single_item = $menu_items->getMenuById($item_id);
?>

<div class="row">
    <div>
        <a href="menu" class="btn btn-primary">Back</a>
    </div>
    <div class="card mt-3" style="width: 18rem;">
        <img src="<?php echo $single_item['ImageUrl']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $single_item['Name']; ?></h5>
            <p class="card-text"><?php echo $single_item['Description']; ?></p>
            <p class="card-text">$<?php echo $single_item['Price']; ?></p>
        </div>
    </div>

</div>