<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="stylesheet" href="CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <?php include_once "dashboard.php"; ?>

    <div class="center">
        <div class="profile">
            <div class="title-header">CLIENT#<?php echo htmlspecialchars($user->user_id); ?></div>

            <!-- First Name  -->
            <div class="grey-box">
                <div class="grey-label">First Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user->fname); ?></div>
            </div>

            <!-- Last Name  -->
            <div class="grey-box">
                <div class="grey-label">Last Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user->lname); ?></div>
            </div>

            <!-- Age -->
            <div class="grey-box">
                <div class="grey-label">Age</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo isset($user->age) ? htmlspecialchars($user->age) : 'Not specified.'; ?></div>
            </div>

            <!-- Gender -->
            <div class="grey-box">
                <div class="grey-label">Gender</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo isset($user->gender) ? htmlspecialchars($user->gender) : 'Not specified.'; ?></div>
            </div>

            <!-- Weight -->
            <div class="grey-box">
                <div class="grey-label">Weight</div>
            </div>
            <div class="white-box">
                <div class="label-input">
                    <?php
                    echo isset($user->weight) ? htmlspecialchars($user->weight) : 'Not specified.';
                    echo isset($user->weight_unit) ? ' ' . htmlspecialchars($user->weight_unit) : '';
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
                    echo isset($user->height) ? htmlspecialchars($user->height) : 'Not specified.';
                    echo isset($user->height_unit) ? ' ' . htmlspecialchars($user->height_unit) : '';
                    ?>
                </div>
            </div>

            <!-- Email -->
            <div class="grey-box">
                <div class="grey-label">Email</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user->email); ?></div>
            </div>

            <!-- Phone Number -->
            <div class="grey-box">
                <div class="grey-label">Phone Number</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo isset($user->phone) ? htmlspecialchars($user->phone) : 'Not specified.'; ?></div>
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
                <div class="label-input"><?php echo isset($user->additional_note) ? htmlspecialchars($user->additional_note) : 'Not specified.'; ?></div>
            </div>

            <!-- Add the delete button at the end -->
            <table>
                <td>
                    <form method="post" action="?controller=client&action=delete">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user->user_id); ?>">
                        <button type="submit" class="default-button" name="delete">Delete</button>
                    </form>
                </td>
            </table>
        </div>
    </div>

    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>

</html>
