<?php
require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';
?>

<div class="container">
    <h2>Create Order</h2>
    <form action="/orders/create.php" method="POST">
        <div class="form-group">
            <label for="user_id">User ID:</label>
            <input type="number" class="form-control" id="user_id" name="user_id">
        </div>
        <div class="form-group">
            <label for="product_id">Product ID:</label>
            <input type="number" class="form-control" id="product_id" name="product_id">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>

<?php
require_once 'views/layouts/footer.php';
?>