<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order System</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Order System</a>
        <div class="navbar-nav">
            <span class="navbar-text">
                User: <?php echo $_SESSION['user_name'] ?? 'Guest'; ?>
            </span>
            <?php if (isset($_SESSION['user_name'])) : ?>
                <a class="nav-item nav-link" href="/logout.php">Logout</a>
            <?php else : ?>
                <a class="nav-item nav-link" href="/auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>