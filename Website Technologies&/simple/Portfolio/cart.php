<?php
session_start();
require('includes/session-cart.php'); // session + cart
require('connect_db.php');

// Handle remove item via GET
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $id = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        $_SESSION['message'] = "Item removed from your cart.";
    }
    header("Location: cart.php");
    exit();
}

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach ($_POST['qty'] as $item_id => $item_qty) {
            $id = (int)$item_id;
            $qty = (int)$item_qty;
            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id]['quantity'] = $qty;
            }
        }
        $_SESSION['message'] = "Cart updated successfully.";
        header("Location: cart.php");
        exit();
    }
}

// Show flash message if exists
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

include('includes/nav.php');
?>

<style>
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
    main {
        flex: 1 0 auto;
    }
</style>

<main>
<div class="container mt-5 mb-5">
    <h1 class="mb-4">Your Shopping Cart</h1>

    <?php if ($message) echo "<div class='alert alert-success'>$message</div>"; ?>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-secondary">
            Your cart is currently empty. 
            <a href="products.php" class="btn btn-dark btn-sm ml-2">Go to Home</a>
        </div>
    <?php else: ?>
        <form method="post">
            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <?php
                    $total = 0;
                    $ids = implode(',', array_keys($_SESSION['cart']));
                    $q = "SELECT * FROM products WHERE item_id IN ($ids) ORDER BY item_id ASC";
                    $r = mysqli_query($link, $q);

                    while ($row = mysqli_fetch_assoc($r)) {
                        $qty = $_SESSION['cart'][$row['item_id']]['quantity'];
                        $subtotal = $row['item_price'] * $qty;
                        $total += $subtotal;
                    ?>
                        <div class="card mb-3">
                            <div class="row no-gutters align-items-center">
                                <div class="col-md-3">
                                    <img src="<?php echo htmlspecialchars($row['item_img']); ?>" class="img-fluid p-2" alt="<?php echo htmlspecialchars($row['item_name']); ?>">
                                </div>
                                <div class="col-md-5">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($row['item_name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($row['item_desc']); ?></p>
                                        <p class="card-text"><small class="text-muted">&pound;<?php echo number_format($row['item_price'], 2); ?></small></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="qty[<?php echo $row['item_id']; ?>]" value="<?php echo $qty; ?>" min="1" class="form-control">
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="mb-2">&pound;<?php echo number_format($subtotal, 2); ?></p>
                                    <a href="cart.php?remove=<?php echo $row['item_id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <button type="submit" name="update" class="btn btn-dark">Update Cart</button>
                    <a href="products.php" class="btn btn-secondary">Back to Home</a>
                </div>

                <!-- Summary -->
                <div class="col-lg-4">
                    <div class="card p-3">
                        <h4>Summary</h4>
                        <hr>
                        <p>Total: &pound;<?php echo number_format($total, 2); ?></p>
                        <a href="checkout.php?total=<?php echo $total; ?>" class="btn btn-success btn-block">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
</main>

<?php
mysqli_close($link);
include('includes/footer.php');
?>
