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
                            <div class="icon-container"><img class="icon-image" src="assets/profile.png" alt="Icon" /></div>
                            <div class="dropdown-content">
                                <a href="?controller=user&action=read">My Profile</a> 
                                <a href="?controller=user&action=logout">Logout</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </header>
    <nav class="nav-menu">
        <ul>
            <li><a href="?controller=user">My Services</a></li>
            <li><a href="?controller=user&action=list">Client List</a></li> 
        </ul>
    </nav>
</body>

</html>