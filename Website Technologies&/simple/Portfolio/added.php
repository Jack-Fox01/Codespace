<?php
require('includes/session-cart.php');
require('connect_db.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = (int) $_GET['id'];

$stmt = $link->prepare("SELECT * FROM products WHERE item_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    add_to_cart($id, $row['item_price'], 1);
} else {
    header("Location: products.php");
    exit();
}

$stmt->close();
$link->close();
?>

<?php include('includes/nav.php'); ?>
<div class="container mt-4">
    <div class="alert alert-success">
        <p><strong><?php echo htmlspecialchars($row['item_name']); ?></strong> has been added to your cart!</p>
        <a href="products.php" class="btn btn-primary">Continue Shopping</a>
        <a href="cart.php" class="btn btn-success">View Cart</a>
    </div>
</div>
<?php include('includes/footer.html'); ?>
