<?php 
include 'nav.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    require('../connect_db.php');

    // Initialize an error array
    $errors = array();

    // Validate item name
    if (empty($_POST['item_name'])) {
        $errors[] = 'Enter the item name.';
    } else {
        $n = trim($_POST['item_name']);
    }

    // Validate item description
    if (empty($_POST['item_desc'])) {
        $errors[] = 'Enter the item description.';
    } else {
        $d = trim($_POST['item_desc']);
    }

    // Validate item image
    if (empty($_POST['item_img'])) {
        $errors[] = 'Enter the item image.';
    } else {
        $img = trim($_POST['item_img']);
    }

    // Validate item price
    if (empty($_POST['item_price'])) {
        $errors[] = 'Enter the item price.';
    } else {
        $p = trim($_POST['item_price']);
        if (!is_numeric($p) || $p < 0) {
            $errors[] = 'Enter a valid positive price.';
        }
    }

    // If no errors, insert into database
    if (empty($errors)) {
        // Use prepared statement to prevent SQL injection
        $stmt = $link->prepare("INSERT INTO products (item_name, item_desc, item_img, item_price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $n, $d, $img, $p); // s = string, d = double

        if ($stmt->execute()) {
            echo '<p>New record created successfully.</p>';
            $stmt->close();
            mysqli_close($link);
            // Optional: redirect to listing page
            // header("Location: view_products.php");
            // exit();
        } else {
            echo '<p>Error inserting record: ' . htmlspecialchars($stmt->error) . '</p>';
            $stmt->close();
            mysqli_close($link);
        }
    } else {
        // Display errors
        echo '<p>The following error(s) occurred:</p>';
        foreach ($errors as $msg) {
            echo htmlspecialchars($msg) . "<br>";
        }
        echo '<p>Please try again.</p>';
        mysqli_close($link);
    }
}
?>

<h1>Add Item</h1>
<form action="create.php" method="post">
    <!-- Item Name -->
    <label for="item_name">Item Name:</label>
    <input type="text" id="item_name" class="form-control" name="item_name" required
           value="<?php if (isset($_POST['item_name'])) echo htmlspecialchars($_POST['item_name']); ?>">

    <!-- Item Description -->
    <label for="item_desc">Description:</label>
    <textarea id="item_desc" class="form-control" name="item_desc" required><?php
        if (isset($_POST['item_desc'])) echo htmlspecialchars($_POST['item_desc']);
    ?></textarea>

    <!-- Item Image -->
    <label for="item_img">Image:</label>
    <input type="text" id="item_img" class="form-control" name="item_img" required
           value="<?php if (isset($_POST['item_img'])) echo htmlspecialchars($_POST['item_img']); ?>">

    <!-- Item Price -->
    <label for="item_price">Price:</label>
    <input type="number" id="item_price" class="form-control" name="item_price" min="0" step="0.01" required
           value="<?php if (isset($_POST['item_price'])) echo htmlspecialchars($_POST['item_price']); ?>"><br>

    <input type="submit" class="btn btn-dark" value="Submit">
</form>

<?php include 'footer.php'; ?>
