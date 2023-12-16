<?php
// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user']) && !empty($_SESSION['user']);

// Debugging: Dump the entire user object
if ($isLoggedIn) {
    var_dump($_SESSION['user']);

} else {
    // User is not logged in
    echo "User is not logged in.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>
<body>
<header>
    <div class="header-container">
        <div class="right-box" onclick="window.location.href='?controller=home'">
            <img class="logo-image" src="assets/logo.png" alt="Logo" />
            <div class="title-container"> JustBFitness</div>
        </div>
        <div class="right-box">
            <label><a href="?controller=home">LOGIN</a></label>
            <label><a href="?controller=home&action=register">SIGN UP</a></label>

        </div>
    </div>
</header>

</body>
</html>
