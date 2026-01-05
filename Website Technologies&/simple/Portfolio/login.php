<?php
// Start session
session_start();
include ('includes/nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - MKTIME</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
          crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Login</h2>

    <?php
    // Display errors if any
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $msg) {
            echo htmlspecialchars($msg) . "<br>";
        }
        echo '</div>';
    }
    ?>

    <form action="login_action.php" method="post">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="pass">Password:</label>
            <input type="password" class="form-control" id="pass" name="pass" required>
        </div>

        <button type="submit" class="btn btn-dark">Login</button>
    </form>

    <p class="mt-3">
        Don't have an account? <a href="register.php">Register here</a>.
    </p>
</div>

</body>
</html>
