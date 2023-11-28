<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="stylesheet" href="../../CSS/admin.css">
    <link rel="stylesheet" href="../../CSS/view.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <?php include_once "dashboard.php"; ?>
    <div class="center">
        <div class="profile">
            <h1 class="title-header">My Services</h1> <br />
            <div class="admin-buttons">
                <table>
                    <tr>
                        <td>
                            <form method="post" action="modify_availability.php">
                                <button type="submit" class="default-button" name="modify">Modify Availability</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="view_appointments.php">
                                <button type="submit" class="default-button" name="view">View Appointments</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        
            <div class="admin-calendar-placeholder">
                <!-- Placeholder for the Google Calendar API shown in Figma -->
                <p>Google Calendar will go here</p>

                <!-- Google Calendar API Library (Searched online from Google to attempt to set this up) -->
                <script src="https://apis.google.com/js/api.js"></script>

                <script>
                    // Load the Google APIs Client Library and initialize the Calendar API
                    gapi.load('client', function() {
                        gapi.client.init({
                            apiKey: 'YOUR_API_KEY',
                            discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest'],
                        }).then(function() {
                            // Google Calendar API is loaded and ready to be used
                            // You can call gapi.client.calendar.[API_METHODS] here
                        });
                    });
                </script>
            </div>
        </div>
    </div>
    <footer>
        <?php include dirname(__FILE__) . "/../../footer.php"; ?>
    </footer>

</body>

</html>
