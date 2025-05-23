<?php

// Start session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to add an item to the cart
function addToCart($image, $name, $price) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item is already in cart
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] == $name) {
            $item['quantity'] += 1; // Increase quantity
            return;
        }
    }

    // If item is not in cart, add it
    $_SESSION['cart'][] = [
        'image' => $image,
        'name' => $name,
        'price' => $price,
        'quantity' => 1
    ];
}

// Function to remove an item from the cart
function removeFromCart($name) {
    if (isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($name) {
            return $item['name'] != $name;
        });
        // Reset array keys
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Function to clear the cart
function clearCart() {
    unset($_SESSION['cart']);
}
?>