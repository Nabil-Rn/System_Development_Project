<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="stylesheet" href="../../CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="right-box">
                <img class="logo-image" src="../../assets/logo.png" alt="Logo" />
                <div class="title-container"> JustBFitness</div>
            </div>

            <div class="right-box">
                <table>
                    <tr>
                        <td class="dropdown">
                            <div class="icon-container"><img class="icon-image" src="../../assets/profile.png"
                                    alt="Icon" /></div>
                            <div class="dropdown-content">
                                <a href="read.php">My Profile</a>  <!-- index.php?controller=user&action=read&id=<?php //echo $user['user_id']; ?> -->
                                <a href="index.php?controller=client&action=exit">Logout</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </header>
    <nav class="nav-menu">
        <ul>
            <li><a href="index.php">My Service</a></li>
            <li><a href="client_list.php">Client List</a></li> <!-- fix: index.php?controller=user&action=list -->
        </ul>
    </nav>
</body>

</html>
