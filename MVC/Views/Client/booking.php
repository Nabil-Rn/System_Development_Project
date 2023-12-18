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
    <?php include_once "footer.php"; ?>
</body>

</html>
