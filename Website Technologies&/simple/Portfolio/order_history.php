<?php
include('includes/nav.php');
include('includes/session-cart.php');

// Must be logged in
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require('connect_db.php');

$user_id = (int) $_SESSION['user_id'];
?>

<div class="container mt-5">
  <h2 class="mb-4">Your Order History</h2>

<?php
// Get user's orders
$stmt = $link->prepare(
    "SELECT order_id, total, order_date
     FROM orders
     WHERE user_id = ?
     ORDER BY order_date DESC"
);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo '<div class="alert alert-info">You have not placed any orders yet.</div>';
    include('includes/footer.html');
    exit;
}

while ($order = $result->fetch_assoc()):
?>

  <div class="card mb-4">
    <div class="card-header bg-dark text-light">
      <strong>Order #<?= $order['order_id']; ?></strong>
      <span class="float-right">
        <?= date('d M Y', strtotime($order['order_date'])); ?>
      </span>
    </div>

    <div class="card-body">
      <p><strong>Total:</strong> £<?= number_format($order['total'], 2); ?></p>

      <table class="table table-sm">
        <thead>
          <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>

<?php
// Get order items
$item_stmt = $link->prepare(
    "SELECT p.item_name, oc.quantity, oc.price
     FROM order_contents oc
     JOIN products p ON p.item_id = oc.item_id
     WHERE oc.order_id = ?"
);
$item_stmt->bind_param("i", $order['order_id']);
$item_stmt->execute();
$items = $item_stmt->get_result();

while ($item = $items->fetch_assoc()):
  $subtotal = $item['quantity'] * $item['price'];
?>
          <tr>
            <td><?= htmlspecialchars($item['item_name']); ?></td>
            <td><?= $item['quantity']; ?></td>
            <td>£<?= number_format($item['price'], 2); ?></td>
            <td>£<?= number_format($subtotal, 2); ?></td>
          </tr>
<?php endwhile; ?>

        </tbody>
      </table>
    </div>
  </div>

<?php
$item_stmt->close();
endwhile;

$stmt->close();
mysqli_close($link);
?>

</div>

<?php include('includes/footer.html'); ?>
