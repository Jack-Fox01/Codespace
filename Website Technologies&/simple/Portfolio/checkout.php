<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('includes/nav.php');
include('includes/session-cart.php');
require('connect_db.php');

$errors = [];

// Stop if cart is empty
if (empty($_SESSION['cart'])) {
    echo '<div class="container mt-5 alert alert-warning">
            Your cart is empty.
          </div>';
    include('includes/footer.php');
    exit;
}

$user_id = $_SESSION['user_id'] ?? NULL;

// Fetch user info if logged in
$user_info = [];
if ($user_id) {
    $user_stmt = $link->prepare("
        SELECT first_name, last_name, email, shipping_address, home_address, postcode 
        FROM users 
        WHERE user_id = ?
    ");
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_info = $user_stmt->get_result()->fetch_assoc();
    $user_stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect info from form
    $first_name = trim($_POST['first_name'] ?? ($user_info['first_name'] ?? ''));
    $last_name = trim($_POST['last_name'] ?? ($user_info['last_name'] ?? ''));
    $email = trim($_POST['email'] ?? ($user_info['email'] ?? ''));
    $shipping_address = trim($_POST['shipping_address'] ?? ($user_info['shipping_address'] ?? ''));
    $home_address = trim($_POST['home_address'] ?? ($user_info['home_address'] ?? ''));
    $postcode = trim($_POST['postcode'] ?? ($user_info['postcode'] ?? ''));

    $card_name = trim($_POST['card_name'] ?? '');
    $card_number = trim($_POST['card_number'] ?? '');
    $card_expiry = trim($_POST['card_expiry'] ?? '');
    $card_cvc = trim($_POST['card_cvc'] ?? '');

    // Validation
    if (!$first_name || !$last_name || !$email || !$shipping_address || !$home_address || !$postcode) {
        $errors[] = "All personal and address fields are required.";
    }
    if (!$card_name || !$card_number || !$card_expiry || !$card_cvc) {
        $errors[] = "Please complete payment details.";
    }

    if (empty($errors)) {

        // Calculate total
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Insert order
        if ($user_id) {
            // Logged-in user: insert with user_id + personal info
            $stmt = $link->prepare("
                INSERT INTO orders 
                (user_id, total, order_date, first_name, last_name, email, shipping_address, home_address, postcode)
                VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param(
                "idssssss",
                $user_id,
                $total,
                $first_name,
                $last_name,
                $email,
                $shipping_address,
                $home_address,
                $postcode
            );
        } else {
            // Guest: insert personal info only
            $stmt = $link->prepare("
                INSERT INTO orders 
                (total, order_date, first_name, last_name, email, shipping_address, home_address, postcode)
                VALUES (?, NOW(), ?, ?, ?, ?, ?, ?)
            ");
            $stmt->bind_param(
                "dssssss",
                $total,
                $first_name,
                $last_name,
                $email,
                $shipping_address,
                $home_address,
                $postcode
            );
        }

        $stmt->execute();
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Insert order items
        foreach ($_SESSION['cart'] as $item_id => $item) {
            $stmt = $link->prepare("
                INSERT INTO order_contents (order_id, item_id, quantity, price)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param("iiid", $order_id, $item_id, $item['quantity'], $item['price']);
            $stmt->execute();
            $stmt->close();
        }

        // Clear cart
        $_SESSION['cart'] = [];
        mysqli_close($link);

        echo '<div class="container mt-5 alert alert-success" style="min-height:70vh;">
                <h4>Thank you for your order!</h4>
                <p>Your order number is <strong>#'.$order_id.'</strong></p>
                <a href="products.php" class="btn btn-dark mt-3">Continue Shopping</a>
              </div>';

        include('includes/footer.php');
        exit;
    } else {
        echo '<div class="container mt-4 alert alert-danger">';
        foreach ($errors as $err) {
            echo '<p>'.htmlspecialchars($err).'</p>';
        }
        echo '</div>';
    }
}
?>

<!-- ================= CHECKOUT FORM ================= -->
<div class="container mt-5" style="min-height:70vh;">
  <h2 class="mb-4">Checkout</h2>

  <form method="post">

    <h4 class="mb-3">Your Details</h4>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" 
               value="<?php echo htmlspecialchars($user_info['first_name'] ?? ''); ?>" required>
      </div>
      <div class="form-group col-md-6">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" 
               value="<?php echo htmlspecialchars($user_info['last_name'] ?? ''); ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" 
             value="<?php echo htmlspecialchars($user_info['email'] ?? ''); ?>" required>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Shipping Address</label>
        <input type="text" name="shipping_address" class="form-control" 
               value="<?php echo htmlspecialchars($user_info['shipping_address'] ?? ''); ?>" required>
      </div>
      <div class="form-group col-md-6">
        <label>Home Address</label>
        <input type="text" name="home_address" class="form-control" 
               value="<?php echo htmlspecialchars($user_info['home_address'] ?? ''); ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label>Postcode</label>
      <input type="text" name="postcode" class="form-control" 
             value="<?php echo htmlspecialchars($user_info['postcode'] ?? ''); ?>" required>
    </div>

    <h4 class="mb-3">Payment Details <small class="text-muted">(Demo Only)</small></h4>
    <div class="form-group">
      <label>Cardholder Name</label>
      <input type="text" name="card_name" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Card Number</label>
      <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Expiry Date</label>
        <input type="text" name="card_expiry" class="form-control" placeholder="MM/YY" required>
      </div>
      <div class="form-group col-md-6">
        <label>CVC</label>
        <input type="text" name="card_cvc" class="form-control" placeholder="123" required>
      </div>
    </div>

    <p class="text-muted small">
      This is a demo checkout. No payment information is stored.
    </p>

    <button type="submit" class="btn btn-success btn-lg btn-block">Place Order</button>

  </form>
</div>

<?php include('includes/footer.php'); ?>
