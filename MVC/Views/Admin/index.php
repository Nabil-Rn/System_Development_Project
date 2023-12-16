<?php

//var_dump($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://schedule.nylas.com/schedule-editor/v1.0/schedule-editor.js" type="text/javascript"></script>
</head>

<body>
    <?php include "dashboard.php"; ?>

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

                                echo scheduler.id;

                            </script>
                        </td>
                        <td>
                            <form method="post" action="?controller=booking&action=list">
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

    <?php include "footer.php"; ?>

</body>

</html>