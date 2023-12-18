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
    <!-- Client Dashboard -->
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

                            <div class="icon-container"><img class="icon-image" src="assets/profile.png" alt="Icon" /> </div>

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
            <li><a href="?controller=user">My Bookings</a></li>
        </ul>
    </nav>

    <div class="center">
        <div class="profile">
            <table>
                <tr>
                    <td>
                        <div class="title-header">CREATE BOOKINGS</div>
                    </td>
                </tr>
            </table>

            <div id="target">

            </div>

            <script>
                // Get reference to the target div
                const targetDiv = document.getElementById('target');

                // Create an iframe element
                const iframe = document.createElement('iframe');

                // Set attributes for the iframe
                iframe.src = 'https://schedule.nylas.com/justbfitness-booking';
                iframe.width = '10000px'; // Set width as needed
                iframe.height = '1000px'; // Set height as needed
                iframe.frameBorder = '0'; // Optional: remove border

                // Append the iframe to the target div
                targetDiv.appendChild(iframe);
            </script>

        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>
