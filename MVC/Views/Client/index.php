<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <form method="post" action="?controller=booking&action=create">
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
                            <td class="table-content"><label>' . $booking->booking_id . '</label></td>
                            <td class="table-content"><label>' . $booking->appointment_date . '</label></td>
                            <td class="table-content"><label>' . $booking->session_time . '</label></td>
                            <td class="table-content"><label>' . $booking->booking_time . '</label></td>
                            <td class="table-content">
                                <form method="post" action="?controller=booking&action=cancel">
                                    <input type="hidden" name="booking_id" value="' . $booking->booking_id . '">
                                    <button type="submit" class="delete-button" name="cancel">Cancel Appointment</button>
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
    <?php include_once "footer.php"; ?>
</body>

</html>
