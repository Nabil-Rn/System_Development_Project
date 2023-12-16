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
            <li><a href="?controller=user">My Service</a></li>
            <li><a href="?controller=user&action=list">Client List</a></li> 
        </ul>
    </nav>

    <div class="center">
        <div class="profile">
            <table>
                <tr>
                    <td>
                        <div class="title-header">View Appointments</div>
                    </td>
                    <td>
                        <input type="search" placeholder="Search...">
                    </td>
                    <td>
                        <button type="submit" class="search-button" name="search">Search</button>
                    </td>
                </tr>
            </table>

            <?php
            if (isset($data) && is_array($data) && !empty($data)) {
                echo '<table>
                        <tr>
                            <th scope="col"><label>CLIENT ID</label></th>
                            <th scope="col"><label>FULL NAME</label></th>
                            <th scope="col"><label>BOOKING ID</label></th>
                            <th scope="col"><label>RESERVATION DATE</label></th>
                            <th scope="col"><label>APPOINTMENT DATE</label></th>
                            <th scope="col"><label>SESSION TIME</label></th>
                            <th scope="col"><label>OPERATIONS</label></th>
                        </tr>';

                foreach ($data as $booking) {
                    echo '
                        <tr>
                            <td class="table-content"><label>' . $booking['USER_ID'] . '</label></td>
                            <td class="table-content"><label>' . $booking['FULL_NAME'] . '</label></td>
                            <td class="table-content"><label>' . $booking['BOOKING_ID'] . '</label></td>
                            <td class="table-content"><label>' . $booking['BOOKING_DATE'] . '</label></td>
                            <td class="table-content"><label>' . $booking['APPOINTMENT_DATE'] . '</label></td>
                            <td class="table-content"><label>' . $booking['SESSION_TIME'] . '</label></td>
                            <td class="table-content">
                                <form method="post" action="?controller=booking&action=edit&id=' . $booking['BOOKING_ID'] . '">
                                    <input type="hidden" name="booking_id" value="' . $booking['BOOKING_ID'] . '">
                                    <button type="submit" class="update-button" name="update">Update</button>
                                </form>
                                <form method="post" action="?controller=booking&action=delete&id=' . $booking['BOOKING_ID'] . '">
                                    <input type="hidden" name="booking_id" value="' . $booking['BOOKING_ID'] . '">
                                    <button type="submit" class="delete-button" name="delete">Cancel</button>
                                </form>
                            </td>
                        </tr>';
                }

                echo '</table>';
            } else {
                echo '<div class="null-box"><div class="grey-label">No appointments have been made yet.</div></div>';
            }
            ?>

        </div>
    </div>

    <?php include "footer.php"; ?>

</body>
</html>
