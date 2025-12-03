<?php
include('nav.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

# Open database connection.
require('../connect_db.php');

if (!isset($_GET['item_id'])) {
    echo "No item selected to delete.";
    exit();
}

$id = intval($_GET['item_id']); // safe integer

// Fetch item info for confirmation
$sql_select = "SELECT item_name FROM products WHERE item_id='$id'";
$result = $link->query($sql_select);

if ($result->num_rows == 0) {
    echo "Item not found.";
    exit();
}

$row = $result->fetch_assoc();

// Handle deletion after confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $delete_id = intval($_POST['item_id']);
    $sql_delete = "DELETE FROM products WHERE item_id='$delete_id'";
    if ($link->query($sql_delete) === TRUE) {
        header("Location: read.php");
        exit();
    } else {
        echo "Error deleting record: " . $link->error;
    }
}
?>

<h1>Delete Item</h1>
<p>Are you sure you want to delete: <strong><?php echo htmlspecialchars($row['item_name']); ?></strong>?</p>

<form action="delete.php?item_id=<?php echo $id; ?>" method="post">
    <input type="hidden" name="item_id" value="<?php echo $id; ?>">
    <input type="submit" class="btn btn-danger" value="Yes, Delete">
    <a href="read.php" class="btn btn-secondary">Cancel</a>
</form>

<?php
$link->close();
?>
