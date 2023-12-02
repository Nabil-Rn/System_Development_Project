<?php
include "../../Models/User.php";
$user = User::read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="stylesheet" href="../../CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <script>
        function showDeleteModal() {
            document.getElementById('deleteMessage').innerText = "Are you sure you want to delete your account?";
            document.getElementById('modalOverlay').style.display = 'flex';
        }
    </script>
</head>

<body>
    <?php include_once "dashboard.php"; ?>

    <div class="center">
        <div class="profile">
            <div class="title-header">MY PROFILE</div>

            <div class="grey-box">
                <div class="grey-label">First Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['FNAME']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Last Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['LNAME']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Age</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo isset($user['AGE']) ? htmlspecialchars($user['AGE']) : 'Not specified.'; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Gender</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo isset($user['GENDER']) ? htmlspecialchars($user['GENDER']) : 'Not specified.'; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Weight</div>
            </div>
            <div class="white-box">
                <div class="label-input">
                    <?php
                    echo isset($user['WEIGHT']) ? htmlspecialchars($user['WEIGHT']) : 'Not specified.';
                    echo isset($user['WEIGHT_UNIT']) ? ' ' . htmlspecialchars($user['WEIGHT_UNIT']) : '';
                    ?>
                </div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Height</div>
            </div>
            <div class="white-box">
                <div class="label-input">
                    <?php
                    echo isset($user['HEIGHT']) ? htmlspecialchars($user['HEIGHT']) : 'Not specified.';
                    echo isset($user['HEIGHT_UNIT']) ? ' ' . htmlspecialchars($user['HEIGHT_UNIT']) : '';
                    ?>
                </div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Email</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['EMAIL']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Phone Number</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo isset($user['PHONE']) ? htmlspecialchars($user['PHONE']) : 'Not specified.'; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Password</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo str_repeat('*', strlen($user['PASSWORD'])); ?></div>
            </div>

            <div class="grey-box">
                <table>
                    <td><label class="grey-label">Additional Note</label></td>
                    <td><p class="subtext">[Share any relevant information about your medical conditions, injuries, allergies, meds, past fitness, and goals]</p></td>
                </table>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo isset($user['ADDITIONAL_NOTE']) ? htmlspecialchars($user['ADDITIONAL_NOTE']) : 'Not specified.'; ?></div>
            </div>

            <table>
                <td>
                    <button class="default-button" onclick="showDeleteModal()">Delete Account</button>
                </td>

                <td>
                    <form method="post" action="edit.php">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <button type="submit" class="default-button" name="edit">Edit Profile</button>
                    </form>
                </td>
            </table>
        </div>
    </div>

    <div id="modalOverlay">
        <div id="deleteModal">
            <p id="deleteMessage">Are you sure you want to delete?</p>
            <form method="post" action="index.php?controller=client&action=delete">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <button type="submit" class="default-button" name="delete">Yes</button>
            </form>
            <button onclick="document.getElementById('modalOverlay').style.display = 'none'">No</button>
        </div>
    </div>
</body>

</html>
