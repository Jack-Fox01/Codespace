<?php
# Access session.
session_start();

# Unset all session variables.
$_SESSION = array();

# Destroy the session.
session_destroy();

# Regenerate session ID.
session_regenerate_id(true);

# Redirect to login page.
require ('login_tools.php');
load();
?>
