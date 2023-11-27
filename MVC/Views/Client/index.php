<?php
// List of Employees

//var_dump($data);
?>
<!---

<html>
    <head>
        <title>Employee List</title>
        <style>
            table{
                width:550px;
            }
            th:nth-child(1) {
                width: 30%;
            }
            </style>
    </head>
    <body>
        <table border=1>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            <?php
                /*
                foreach($data as $row) {
                    echo "<tr><td>" . $row->clientNumber. "</td><td>" 
                        . $row->lastName. ", " . $row->firstName. "</td>";

                        echo "<td><a href='/?controller=client&action=view&id=".$row->clientNumber."'>View</a></td>";
                        echo "<td><a href='/?controller=client&action=update&id=".$row->clientNumber."'>Edit</a></td>";

                    echo "</tr>";
                }
                */
            ?>
        </table>
    </body>
</html>

-->

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
                            <a href="index.php?controller=client&action=view">My Profile</a>
                            <a href="index.php?controller=client&action=exit">Logout</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</header>

<div class="center">
    <div class="profile">
        <table>
            <tr>
                <td><div class="title-header">MY BOOKINGS</div></td>
                <td>
                    <form method="post" action="index.php?controller=booking&action=create">
                        <button type="submit" class="default-button" name="book">Book Now</button>
                    </form>
                </td>
            </tr>
        </table>

       

        <?php
        if (isset($data) && is_array($data) && !empty($data)) {
            echo '<table>
                    <tr>
                        <th scope="col"><label>BOOKING ID</label></th>
                        <th scope="col"><label>APPOINTMENT DATE</label></th>
                        <th scope="col"><label>SESSION TIME</label></th>
                        <th scope="col"><label>RESERVATION DATE</label></th>
                        <th scope="col"><label>OPERATIONS</label></th>
                    </tr>';
            
            foreach ($data as $booking) {
                echo '
                    <tr>
                        <td class="table-content"><label>' . $booking['booking_id'] . '</label></td>
                        <td class="table-content"><label>' . $booking['appointment_date'] . '</label></td>
                        <td class="table-content"><label>' . $booking['session_time'] . '</label></td>
                        <td class="table-content"><label>' . $booking['booking_date'] . '</label></td>
                        <td>
                            <form method="post" action="index.php?controller=booking&action=delete">
                                <input type="hidden" name="booking_id" value="' . $booking['booking_id'] . '">
                                <button type="submit" class="delete-button" name="delete">Cancel Appointment</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo '<div class="null-box"><div class="grey-label">No bookings have been made yet. Please click \'Book Now\' to make a reservation.</div></div>';
        }
        ?>


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
