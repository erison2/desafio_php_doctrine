<?php
require_once 'views/layouts/header.php';
require_once 'views/layouts/sidebar.php';
?>

<div class="container">
    <h2>Login</h2>
    <form action="/auth/login.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php
require_once 'views/layouts/footer.php';
?>