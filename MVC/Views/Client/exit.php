<?php
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or home page
header("Location: ?controller=home&action=login"); // TO MODIFY LATER
exit();

?>
