<!--- CLIENT LIST: This file name is intended to be renamed "list.php",  for href="index.php?controller=user&action=list" -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="stylesheet" href="../../CSS/admin.css">
    <link rel="stylesheet" href="../../CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    <?php include_once "dashboard.php"; ?>
    <div class="center">
        <div class="profile">
            <input type="search" placeholder="Search...">

            <?php
            $iteration = 0;

            if (isset($data) && is_array($data) && !empty($data)) {
                foreach ($data as $user) {
                    $iteration++;
                    $boxClass = $iteration % 2 === 1 ? 'grey-round-box1' : 'grey-round-box2';

                    echo '<div class="container ' . $boxClass . '">
                        <table>
                            <tr>
                                <td><label class="grey-label">' . $user['fname'] . '</label></td>
                                <td><label class="grey-label">' . $user['lname'] . '</label></td>
                                <td><label class="grey-label">' . $user['email'] . '</label></td>
                                <td><label class="grey-label">' . $user['phone'] . '</label></td>
                                <td>
                                    <form method="post" action="index.php?controller=client&action=list">
                                        <input type="hidden" name="user_id" value="' . $user['user_id'] . '">
                                        <input type="hidden" name="group_id" value="' . $user['group_id'] . '">
                                        <button type="submit" class="view-button" name="view">View</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>';
                }
            } else {
                echo '<div class="null-box"><div class="grey-label">No client records were found.</div></div>';
            }
            ?>

        </div>
    </div>
    <footer>
        <?php include dirname(__FILE__) . "/../../footer.php"; ?>
    </footer>
</body>

</html>
