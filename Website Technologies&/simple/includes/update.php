<?php
# Include navigation 
include ( 'nav.php' ) ;

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  # Initialize an error array.
  $errors = array();

# Check for a item name.
  if ( empty( $_POST[ 'item_id' ] ) )
  { $errors[] = 'Update item ID.' ; }
  else
  { $id = mysqli_real_escape_string( $link, trim( $_POST[ 'item_id' ] ) ) ; }
  
  # Check for a item name.
  if ( empty( $_POST[ 'item_name' ] ) )
  { $errors[] = 'Update item name.' ; }
  else
  { $n = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ) ; }

  # Check for a item description.
  if (empty( $_POST[ 'item_desc' ] ) )
  { $errors[] = 'Update item description.' ; }
  else
  { $d = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ) ; }

# Check for a item price.
  if (empty( $_POST[ 'item_img' ] ) )
  { $errors[] = 'Update image address.' ; }
  else
  { $img = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ) ; }
  
  # Check for a item price.
  if (empty( $_POST[ 'item_price' ] ) )
  { $errors[] = 'Update item price.' ; }
  else
  { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ; }

  if ( empty( $errors ) ) 
  {
    $q = "UPDATE products SET item_id='$id',item_name='$n', item_desc='$d', item_img='$img', item_price='$p'  WHERE item_id='$id'";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    {
       header("Location: read.php");
       } else {
        echo "Error updating record: " . $link->error;
    }
     # Close database connection.
    mysqli_close( $link );
  } 
}
?>

<form action="update.php" method="post">
    <!-- Item ID (hidden or read-only if needed) -->
    <label for="item_id">Item ID:</label>
    <input type="text" name="item_id" id="item_id" class="form-control"
           value="<?php if (isset($_POST['item_id'])) echo htmlspecialchars($_POST['item_id']); ?>" required>

    <!-- Item Name -->
    <label for="item_name">Item Name:</label>
    <input type="text" name="item_name" id="item_name" class="form-control"
           value="<?php if (isset($_POST['item_name'])) echo htmlspecialchars($_POST['item_name']); ?>" required>

    <!-- Item Description -->
    <label for="item_desc">Item Description:</label>
    <textarea name="item_desc" id="item_desc" class="form-control" required><?php if (isset($_POST['item_desc'])) echo htmlspecialchars($_POST['item_desc']); ?></textarea>

    <!-- Item Image -->
    <label for="item_img">Item Image Path:</label>
    <input type="text" name="item_img" id="item_img" class="form-control"
           value="<?php if (isset($_POST['item_img'])) echo htmlspecialchars($_POST['item_img']); ?>" required>

    <!-- Item Price -->
    <label for="item_price">Item Price:</label>
    <input type="number" name="item_price" id="item_price" class="form-control" step="0.01" min="0"
           value="<?php if (isset($_POST['item_price'])) echo htmlspecialchars($_POST['item_price']); ?>" required><br>

    <!-- Submit Button -->
    <input type="submit" class="btn btn-dark" value="Update Item">
</form>
