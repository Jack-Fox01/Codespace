<?php
require('connect_db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['item_id'], $_POST['user_name'], $_POST['review_text'], $_POST['rating'])) {
        die("Incomplete form submission.");
    }

    $item_id = (int)$_POST['item_id'];
    $user_name = trim($_POST['user_name']);
    $review_text = trim($_POST['review_text']);
    $rating = (int)$_POST['rating'];

    if ($item_id <= 0 || empty($user_name) || empty($review_text) || $rating < 1 || $rating > 5) {
        die("Please fill in all fields correctly.");
    }

    $stmt = $link->prepare("INSERT INTO reviews (item_id, user_name, review_text, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $item_id, $user_name, $review_text, $rating);

    if ($stmt->execute()) {
        header("Location: product.php?id=$item_id");
        exit();
    } else {
        die("Error adding review: " . $stmt->error);
    }
} else {
    die("Invalid request.");
}
?>
