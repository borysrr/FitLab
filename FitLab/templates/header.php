<?php
// Check if the session is started, if not, start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart count
$cart_count = 0;
// Check if there are items in the session cart
if (!empty($_SESSION['cart'])) {
    // Loop through the cart items and calculate the total quantity
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user']);
// If the user is logged in, get the user's email, else set it as an empty string
$user_email = $is_logged_in ? $_SESSION['user'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to the bootstrap CSS and main CSS files -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!-- Favicon for the website -->
    <link rel="icon" type="image/png" href="/products%20images/favicon.png">
</head>
<body>

<!-- Navbar section for navigation links -->
<nav class="navbar navbar-inverse navbar-fixed-top navbar-custom">
    <div class="container">
        <div class="navbar-header">
            <!-- Button for collapsing the navbar on small screens -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"></button>
            <!-- Link to the homepage (brand) -->
            <a class="navbar-brand navbar-brand-custom" href="/FitLabtrack.php">FitLab</a>
        </div>

        <!-- Links for main navigation -->
        <ul class="nav navbar-nav navbar-center">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/products.php">Supplements</a></li>
            <li><a href="/clothing.php">Apparel</a></li>
            <li><a href="/contact.php">Contact</a></li>
        </ul>

        <!-- Right-aligned navbar items, including search and user/cart actions -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Search form to search for items -->
            <li>
                <form class="navbar-form" action="search.php" method="GET">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Search Item">
                    </div>
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </li>
            <!-- Link to cart page, showing the number of items in the cart -->
            <li>
                <a href="/cart.php">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    Cart (<span id="cart-count"><?php echo $cart_count; ?></span>)
                </a>
            </li>

            <!-- User account section: logged in or not -->
            <?php if ($is_logged_in): ?>
                <!-- Dropdown for logged-in users -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <?php echo htmlspecialchars($user_email); ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/logout.php">Logout</a></li>
                    </ul>
                </li>
            <?php else: ?>
                <!-- Dropdown for users who are not logged in -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> Account <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/login.php">Login</a></li>
                        <li><a href="/signup.php">Sign Up</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Script to update the cart count dynamically when the page is loaded -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cartCount = <?php echo $cart_count; ?>;
        document.getElementById("cart-count").innerText = cartCount;
    });
</script>

</body>
</html>