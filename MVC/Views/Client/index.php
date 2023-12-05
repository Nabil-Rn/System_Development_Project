<?php
include "../../Models/Booking.php";
$data = Booking::list();

session_start();
if (!isset($_SESSION['user_id'])) {
    // Not logged in, redirect to login page
    //change to controller
    header('Location: ../Home/index.php');
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="../../assets/favicon.ico">
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="stylesheet" href="../../CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <?php include_once "dashboard.php"; ?>
    <div class="center">
        <div class="profile">
            <table>
                <tr>
                    <td>
                        <div class="title-header">MY BOOKINGS</div>
                    </td>
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
                <td class="table-content"><label>' . $booking['BOOKING_ID'] . '</label></td>
                <td class="table-content"><label>' . $booking['APPOINTMENT_DATE'] . '</label></td>
                <td class="table-content"><label>' . $booking['SESSION_TIME'] . '</label></td>
                <td class="table-content"><label>' . $booking['BOOKING_DATE'] . '</label></td>
                <td class="table-content">
                    <form method="post" action="index.php?controller=booking&action=delete&id=' . $booking['BOOKING_ID'] . '">
                        <input type="hidden" name="booking_id" value="' . $booking['BOOKING_ID'] . '">
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
    <?php include_once "../../footer.php"; ?>
</body>

</html>
