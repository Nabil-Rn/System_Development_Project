<!--- TEMPLATE FOR A CONFIRM DELETION PAGE. MIGHT BE UNNECESSARY DUE TO BOOKING API BUT WE CAN STILL USE IT FOR OTHER PAGES  -->

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
                        <div class="icon-container"><img class="icon-image" src="../../assets/profile.png" alt="Icon" /></div>
                        <div class="dropdown-content">
                            <a href="index.php?controller=user&action=read&id=<?php echo $user['user_id']; ?>">My Profile</a>
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
        <li><a href="index.php?controller=booking&action=list">My Bookings</a></li>
    </ul>
</nav>

<div class="center">
    <div class="profile">

        <div class= "title-header">CANCEL APPOINTMENT</div>


        <div class="null-box">
            
            <table>
                <tr>
                    <td><div class="label-underline-h2">Appointment Details</div></td>
                </tr>
                <tr>
                    <td><div class="label-h2">Booking ID:</div></td>
                    <td><div class="label-h3">1012</div></td>
                </tr>
                <tr>
                    <td><div class="label-h2">Date:</div></td>
                    <td><div class="label-h3">2023-11-20</div></td>
                </tr>
                <tr>
                    <td><div class="label-h2">Time:</div></td>
                    <td><div class="label-h3">12:30 PM - 1:30PM</div></td>
                </tr>
                <tr>
                    <td><div class="label-h2">Location:</div></td>
                    <td><div class="label-h3">JUSTBFITNESS Center</div></td>
                </tr>
                
            </table>
        </div>
    

        <table>
            <td>
                <button type="submit" class="default-button" onclick="window.history.back();">Back</button>
            </td>
            <td>
                <button type="submit" class="default-button" name="delete">Confirm</button>
            </td>
        </table>
    </div>
</div>
<footer>
    <div class="left-box">
        <div class="contact-item">
            <div class="contact-label">Contact Us | Contactez nous</div>
            <div class="contact-info">
                <div class="contact-text"><a href="mailto:enquiries@justbfitness.ca">enquiries@justbfitness.ca</a></div>
                <div class="contact-text"><a href="tel:+15148628093">(514) 862-8093</a></div>
            </div>
            <div class="social-icons">
                <a href="https://facebook.com/JustBfitnessOfficial/"><img src="../../assets/facebook.png" ></a>
                <a href="https://www.instagram.com/JustBfitness.ca/"><img src="../../assets/instagram.png"></a>
            </div>
        </div>
    </div>
    <div class="right-box">
        <div class="contact-item">
            <img class="logo-image" src="../../assets/logo.png" alt="Logo">
            <div class="copy-rights-text"> &copy; JUST B FITNESS 2023. ALL RIGHTS RESERVED.</div>
        </div>
    </div>
</footer>
</body>

</html>

