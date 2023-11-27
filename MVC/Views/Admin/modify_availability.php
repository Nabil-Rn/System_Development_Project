<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - JUSTBFITNESS</title>
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <?php include_once "../../navbar.php"; ?>

    <div class="admin-container">
        <h1>Modify Availability</h1>
        <div id="availability-setting">
            <!-- Google Calendar API for setting availabilities -->
        </div>
        <div id="availability-calendar">
            <!-- Google Calendar API display the calendar -->
        </div>
    </div>


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

    <footer>
        <?php include '../../footer.php'; ?>
    </footer>

</body>