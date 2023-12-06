<?php
include "../../Models/User.php";
$user = User::view();

if ($user) {
?>
    <!-- VIEW DETAILS OF CLIENT INFO: This file name is intended to be renamed "view.php", for href="index.php?controller=user&action=view&id=?" -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/favicon.ico">
        <link rel="stylesheet" href="../../CSS/home.css">
        <link rel="stylesheet" href="../../CSS/view.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    </head>

    <body>
        <?php include_once "dashboard.php"; ?>

        <div class="center">
            <div class="profile">

                <div class="title-header">CLIENT#<?php echo htmlspecialchars($user['USER_ID']); ?></div>

                <!-- First Name  -->
                <div class="grey-box">
                    <div class="grey-label">First Name</div>
                </div>
                <div class="white-box">
                    <div class="label-input"><?php echo htmlspecialchars($user['FNAME']); ?></div>
                </div>

                <!-- Last Name  -->
                <div class="grey-box">
                    <div class="grey-label">Last Name</div>
                </div>
                <div class="white-box">
                    <div class="label-input"><?php echo htmlspecialchars($user['LNAME']); ?></div>
                </div>

                <!-- Age -->
                <div class="grey-box">
                    <div class="grey-label">Age</div>
                </div>
                <div class="white-box">
                    <div class="label-input"><?php echo isset($data['AGE']) ? htmlspecialchars($data['AGE']) : 'Not specified.'; ?></div>
                </div>

                <!-- Gender -->
                <div class="grey-box">
                    <div class="grey-label">Gender</div>
                </div>
                <div class="white-box">
                    <div class="label-input"><?php echo isset($data['GENDER']) ? htmlspecialchars($data['GENDER']) : 'Not specified.'; ?></div>
                </div>

                <!-- Weight -->
                <div class="grey-box">
                    <div class="grey-label">Weight</div>
                </div>
                <div class="white-box">
                    <div class="label-input">
                        <?php
                        echo isset($data['WEIGHT']) ? htmlspecialchars($data['WEIGHT']) : 'Not specified.';
                        echo isset($data['WEIGHT_UNIT']) ? ' ' . htmlspecialchars($data['WEIGHT_UNIT']) : '';
                        ?>
                    </div>
                </div>

                <!-- Height -->
                <div class="grey-box">
                    <div class="grey-label">Height</div>
                </div>
                <div class="white-box">
                    <div class="label-input">
                        <?php
                        echo isset($data['HEIGHT']) ? htmlspecialchars($data['HEIGHT']) : 'Not specified.';
                        echo isset($data['HEIGHT_UNIT']) ? ' ' . htmlspecialchars($data['HEIGHT_UNIT']) : '';
                        ?>
                    </div>
                </div>

                <!-- Email -->
                <div class="grey-box">
                    <div class="grey-label">Email</div>
                </div>
                <div class="white-box">
                    <div class="label-input"><?php echo htmlspecialchars($user['EMAIL']); ?></div>
                </div>

                <!-- Phone Number -->
                <div class="grey-box">
                    <div class="grey-label">Phone Number</div>
                </div>
                <div class="white-box">
                    <div class="label-input"><?php echo isset($data['PHONE']) ? htmlspecialchars($data['PHONE']) : 'Not specified.'; ?></div>
                </div>

                <!-- Additional Note -->
                <div class="grey-box">
                    <table>
                        <td><label class="grey-label">Additional Note</label></td>
                        <td>
                            <p class="subtext">
                                [Share any relevant information about your medical conditions,
                                injuries, allergies, meds, past fitness, and goals]
                            </p>
                        </td>
                    </table>
                </div>
                <div class="white-box">
                    <div class="label-input"><?php echo isset($data['ADDITIONAL_NOTE']) ? htmlspecialchars($data['ADDITIONAL_NOTE']) : 'Not specified.'; ?></div>
                </div>

                <!-- Add the delete button at the end -->
                <table>
                    <td>
                        <form method="post" action="index.php?controller=client&action=delete">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['USER_ID']); ?>">
                            <button type="submit" class="default-button" name="delete">Delete</button>
                        </form>
                    </td>
                </table>

            </div>
        </div>

        <footer>
            <?php include dirname(__FILE__) . "/../../footer.php"; ?>
        </footer>
    </body>

    </html>
<?php
} else {
    // Handle the case where no user data is fetched
    echo '<div class="null-box"><div class="grey-label">No user data found.</div></div>';
}
?>