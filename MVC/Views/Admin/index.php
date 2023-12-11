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
    <script src="https://schedule.nylas.com/schedule-editor/v1.0/schedule-editor.js" type="text/javascript"></script>
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
                            <button type="submit" class="default-button" name="modify" id="schedule-editor">Modify Schedule</button>

                            <script>
                                var btn = document.getElementById('schedule-editor');
                                btn.addEventListener('click', function() {
                                    nylas.scheduler.show({
                                        auth: {
                                            // Account <ACCESS_TOKEN> with active calendar scope
                                            accessToken: "PTcBVppDmBLQOqQxIGUFnWXwA4bcAb",
                                        },
                                        style: {
                                            // Style the schdule editor
                                            tintColor: '#32325d',
                                            backgroundColor: 'white',
                                        },
                                        defaults: {
                                            event: {
                                                title: '30-min Coffee Meeting',
                                                duration: 30,
                                            },
                                        },
                                    });
                                });
                            </script>
                        </td>
                        <td>
                            <form method="post" action="view_appointments.php">
                                <button type="submit" class="default-button" name="view">View Appointments</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>

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
    <footer>
        <?php include "footer.php"; ?>
    </footer>

</body>

</html>