<?php
# PROCESS LOGIN ATTEMPT.

# Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

# Check form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    # Open database connection
    require('connect_db.php');

    # Get connection, load, and validate functions
    require('login_tools.php');

    # Check login
    list($check, $data) = validate($link, $_POST['email'], $_POST['pass']);

    if ($check) {
        # Ensure admin flag exists
        $is_admin = isset($data['is_admin']) ? (int)$data['is_admin'] : 0;

        # Set session variables
        $_SESSION['user_id'] = $data['user_id'];
        $_SESSION['first_name'] = $data['first_name'];
        $_SESSION['last_name'] = $data['last_name'];
        $_SESSION['is_admin'] = ['$is_admin'];

        # Redirect to products page
        header("Location: products.php");
        exit();
        
    } else {
        # Login failed
        $errors = $data; // pass to login.php
    }

    # Close DB connection
    mysqli_close($link);
}

# Include login page
include('login.php');
?>
