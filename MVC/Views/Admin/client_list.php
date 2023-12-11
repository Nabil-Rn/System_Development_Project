<?php
// To remove once we fix the User Controller
include "Models/User.php";
$data = User::list();
?>

<!--- CLIENT LIST: This file name is intended to be renamed "list.php", for href="index.php?controller=user&action=list" -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
</head>

<body>
    </head>

    <body>
        <?php include_once "dashboard.php"; ?>
        <div class="center">
            <div class="profile">
                <table>
                    <tr>
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
                ?>
                    <div class="container1">
                        <table>
                            <tr>
                                <?php
                                foreach ($data as $iteration => $user) {
                                    $boxClass = $iteration % 2 === 1 ? 'grey-round-box1' : 'grey-round-box2';
                                ?>
                            <tr class="<?php echo $boxClass; ?>">
                                <td><?php echo htmlspecialchars($user['FNAME']); ?></td>
                                <td><?php echo htmlspecialchars($user['LNAME']); ?></td>
                                <td><?php echo htmlspecialchars($user['EMAIL']); ?></td>
                                <td><?php echo htmlspecialchars($user['PHONE']); ?></td>
                                <td>
                                    <form method="post" action="view_client_info.php"> <!-- index.php?controller=client&action=view -->
                                        <input type="hidden" name="user_id" value="<?php echo $user['USER_ID']; ?>">
                                        <input type="hidden" name="group_id" value="<?php echo $user['GROUP_ID']; ?>">
                                        <button type="submit" class="view-button" name="view">View</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                                }
                        ?>

                        </table>
                    </div>
                <?php
                } else {
                    echo '<div class="null-box"><div class="grey-label">No client records were found.</div></div>';
                }
                ?>
            </div>
        </div>
        <footer>
            <?php include "footer.php"; ?>
        </footer>
    </body>

</html>