<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$cart_count = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLab.com</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/products%20images/favicon.png">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: dodgerblue; border-color: darkblue; border-width: 4px; border-style: solid;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"></button>
            <a class="navbar-brand" href="/FitLabtrack.php" style="color: Black">FitLab</a>
        </div>

        <ul class="nav navbar-nav" style="display: flex; justify-content: center; width: 35%;">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/products.php">Supplements</a></li>
            <li><a href="/clothing.php">Apparel</a></li>
            <li><a href="/contact.php">Contact</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <form class="navbar-form" action="search.php" method="GET">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Search Item">
                    </div>
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </li>
            <li><a href="/cart.php" style="color: white;"><span class="glyphicon glyphicon-shopping-cart"></span> Cart (<span id="cart-count"><?php echo $cart_count; ?></span>)</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;"><span class="glyphicon glyphicon-user"></span> Account <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/login.php">Login</a></li>
                    <li><a href="/signup.php">Sign Up</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cartCount = <?php echo $cart_count; ?>;
        document.getElementById("cart-count").innerText = cartCount;
    });
</script>

</body>
</html>