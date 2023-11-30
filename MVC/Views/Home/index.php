<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">

</head>
<body>
<header>
    <?php include_once "dashboard.php"; ?>
    <!--
    <div class="header-container">
    <div class="right-box">
        <img class="logo-image" src="assets/logo.png" alt="Logo" />
        <div class="title-container"> JustBFitness</div>
    </div>
    
    
    <div class="right-box">
    <label><a href="Views/Home/register.php">SIGN UP</a></label> To Modify
    
    </div>
    
    <div class="icon-container"><img class="icon-image" src="../../assets/profile.png" alt="Icon" /></div>
    </div>
    -->
    
</header>

<div class="title">
    <div class="title-text">Login</div>
</div>

<div class="all-container">
    <form action='?controller=user&action=login' method='post' >
            <div class="all-form">
                <div class="title-large">Login to your Account:</div>
                <div class="form-group">
                    <div class="label">Email:</div>
                    <div class="input-box"><input type="email" name="email"></div>
                    <div class="label">Password:</div>
                    <div class="input-box"><input type="password" name="password"></div>
                    <div class="link"><a href="Views/Auth/forgotPassword.php">Forgot Password?</a></div>
                    <div class="button-container">
                        <div class="button"><button type="submit">Login</button></div>
                </div>
                </div>
            </div>
        </form>
</div>
<footer>
    <?php include_once 'footer.php' ?>
</footer>
</body>
</html>