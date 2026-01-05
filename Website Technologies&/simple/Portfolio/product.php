<?php

require('includes/session-cart.php'); // session + cart
require('connect_db.php');

// Validate product ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: products.php");
    exit();
}
$id = (int) $_GET['id'];

// Fetch product
$stmt = $link->prepare("SELECT * FROM products WHERE item_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows !== 1) die("Product not found.");
$product = $result->fetch_assoc();

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    add_to_cart($id, $product['item_price'], 1);
    $_SESSION['message'] = "{$product['item_name']} has been added to your cart.";
    header("Location: cart.php");
    exit();
}

$stmt->close();
?>

<?php include('includes/nav.php'); ?>

<div class="container mt-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($product['item_img']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['item_name']); ?>">
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2><?php echo htmlspecialchars($product['item_name']); ?></h2>
            <p><strong>Price: &pound;<?php echo number_format($product['item_price'], 2); ?></strong></p>

            <form method="post">
                <input type="hidden" name="add_to_cart" value="1">
                <button type="submit" class="btn btn-success btn-lg mb-3">Add to Cart</button>
                <a href="products.php" class="btn btn-secondary btn-lg mb-3">Back to Products</a>
            </form>
        </div>
    </div>

    <!-- Product Details Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Product Details</h3>
            <p><?php echo nl2br(htmlspecialchars($product['item_desc'])); ?></p>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3>Reviews</h3>

            <?php
            // Fetch reviews with ratings
            $reviews_stmt = $link->prepare("SELECT user_name, review_text, review_date, rating FROM reviews WHERE item_id = ? ORDER BY review_date DESC");
            $reviews_stmt->bind_param("i", $id);
            $reviews_stmt->execute();
            $reviews_result = $reviews_stmt->get_result();

            if ($reviews_result->num_rows > 0) {
                while ($review = $reviews_result->fetch_assoc()) {
                    echo '<div class="card mb-2">';
                    echo '<div class="card-body">';
                    echo '<strong>' . htmlspecialchars($review['user_name']) . '</strong> ';
                    echo '<span class="text-muted" style="font-size:0.9em;">(' . $review['review_date'] . ')</span>';
                    
                    // Display stars
                    echo '<p>';
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $review['rating'] ? '<span style="color:gold;">&#9733;</span>' : '<span style="color:#ccc;">&#9733;</span>';
                    }
                    echo '</p>';

                    echo '<p>' . htmlspecialchars($review['review_text']) . '</p>';
                    echo '</div></div>';
                }
            } else {
                echo '<p>No reviews yet.</p>';
            }
            ?>

            <!-- Add Review Form -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5>Add a Review</h5>
                    <form action="add_review.php" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label for="user_name">Name:</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <select class="form-control" id="rating" name="rating" required>
                                <option value="5" selected>5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="review_text">Review:</label>
                            <textarea class="form-control" id="review_text" name="review_text" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
$reviews_stmt->close();
$link->close();
include('includes/footer.php');
?>
