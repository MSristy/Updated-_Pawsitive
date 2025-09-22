<?php
session_start();
session_unset();
session_destroy();

// Redirect to Admin Login page
header("Location: admin_login.php");
exit();
?>
