<?php
require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';

$orders = [];

?>

<div class="container">
    <h2>List of Orders</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['product_id']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['price']; ?></td>
                    <td>
                        <a href="/orders/update.php?id=<?php echo $order['id']; ?>" class="btn btn-warning">Update</a>
                        <a href="/orders/delete.php?id=<?php echo $order['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
require_once 'views/layouts/footer.php';
?>