<?php
include('nav.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Open database connection
require('../connect_db.php');

// Fetch products from database
$q = "SELECT * FROM products";
$r = mysqli_query($link, $q);

echo '<div class="container mt-4">';
if ($r && mysqli_num_rows($r) > 0) {
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($r)) {
        echo '
        <div class="col-md-3 d-flex justify-content-center mb-4">
            <div class="card" style="width: 18rem;">
                <img src="' . htmlspecialchars($row['item_img']) . '" class="card-img-top" alt="' . htmlspecialchars($row['item_name']) . '">
                <div class="card-body">
                    <h5 class="card-title text-center">' . htmlspecialchars($row['item_name']) . '</h5>
                    <p class="card-text">' . htmlspecialchars($row['item_desc']) . '</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">&pound;' . htmlspecialchars($row['item_price']) . '</li>
                    <li class="list-group-item">
                        <a class="btn btn-dark btn-lg btn-block" href="update.php?id=' . $row['item_id'] . '">Update</a>
                    </li>
                    <li class="list-group-item">
                        <a class="btn btn-dark" href="delete.php?item_id=' . $row['item_id'] . '">Delete Item</a>
                    </li>
                </ul>
            </div>
        </div>';
    }
    echo '</div>'; // Close row
} else {
    echo '<p class="text-center">There are currently no items in the table to display.</p>';
}
echo '</div>'; // Close container

// Close database connection
mysqli_close($link);

include('footer.php');
?>
