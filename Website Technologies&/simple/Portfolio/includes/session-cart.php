<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

/**
 * Add product to cart
 */
function add_to_cart($id, $price, $quantity = 1) {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = array(
            'quantity' => $quantity,
            'price' => $price
        );
    }
}

/**
 * Remove product from cart
 */
function remove_from_cart($id) {
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

/**
 * Get total items in cart
 */
function total_items() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['quantity'];
    }
    return $total;
}

/**
 * Get total price of cart
 */
function total_price() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['quantity'] * $item['price'];
    }
    return $total;
}

/**
 * Clear entire cart
 */
function clear_cart() {
    $_SESSION['cart'] = array();
}
?>
