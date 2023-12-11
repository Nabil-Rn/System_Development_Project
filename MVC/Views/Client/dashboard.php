<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="stylesheet" href="CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="right-box">
                <img class="logo-image" src="assets/logo.png" alt="Logo" />
                <div class="title-container"> JustBFitness</div>
            </div>

            <div class="right-box">
                <table>
                    <tr>
                        <td class="dropdown">

                            <div class="icon-container"><img class="icon-image" src="assets/profile.png"
                                    alt="Icon" /> </div>

                            <div class="dropdown-content">
                                <a href="read.php">My Profile</a> <!--- index.php?controller=user&action=read&id=<?php //echo $_SESSION['user_id']; ?> -->
                                <a href="?controller=user&action=logout">Logout</a> <!-- will change later according to our MVC: index.php?controller=home&action=exit -->
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </header>
    <nav class="nav-menu">
        <ul>
            <li><a href="?controller=booking&action=list">My Bookings</a></li> <!--- BOOKING MODEL AND CONTROLLER IMPLIED HERE -->
        </ul>
    </nav>
</body>

</html>
