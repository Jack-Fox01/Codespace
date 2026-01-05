<?php
// Start session (must be first)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If user is logged in, get full name
$user_name = '';
if (!empty($_SESSION['first_name']) && !empty($_SESSION['last_name'])) {
    $user_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
}


// Get cart count
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MKTIME</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
    crossorigin="anonymous">

  <style>
    /* Red circle badge */
    .cart-badge {
        background: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        vertical-align: top;
        margin-left: 5px;
    }
  </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="products.php">
    MKTIME
    <?php if ($user_name != ''): ?>
      - <?php echo htmlspecialchars($user_name); ?>
    <?php endif; ?>
  </a>

  <button class="navbar-toggler" type="button"
    data-toggle="collapse"
    data-target="#navbarNav"
    aria-controls="navbarNav"
    aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">

      <!-- Always visible -->
      <li class="nav-item">
        <a class="nav-link" href="products.php">Shop</a>
      </li>

      <?php if (!empty($_SESSION['user_id'])): ?>

  
            <li class="nav-item"><a class="nav-link" href="create.php">Create</a></li>
            <li class="nav-item"><a class="nav-link" href="read.php">Read</a></li>
            <li class="nav-item"><a class="nav-link" href="update.php">Update</a></li>
            <li class="nav-item"><a class="nav-link" href="delete.php">Delete</a></li>

        <!-- Cart with red badge -->
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            Cart <span class="cart-badge"><?php echo $cart_count; ?></span>
          </a>
        </li>

        <!-- Logged-in users -->
        <li class="nav-item">
          <a class="nav-link" href="order_history.php">My Orders</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      <?php else: ?>

        <!-- Guests -->
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>

        <!-- Cart with red badge for guests -->
        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            Cart <span class="cart-badge"><?php echo $cart_count; ?></span>
          </a>
        </li>

      <?php endif; ?>

    </ul>
  </div>
</nav>
