<?php

include "../../Models/User.php";
$user = User::read();
?>

<!---READ CURRENT USER IN SESSION PROFILE -> MY PROFILE for href="index.php?controller=user&action=read&id=?" -->
<!---WILL HAVE TO ADD IF-ELSE STATEMENT FOR CLIENT/ADMIN interface -->

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
                <div class="grey-label">Email</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['EMAIL']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Phone Number</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['PHONE']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Password</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo str_repeat('*', strlen($user['PASSWORD'])); ?></div>
            </div>

            <form method="post" action="edit.php"> <!--- "index.php?controller=user&action=edit&id=<?php //echo $user['user_id']; 
                                                                                                    ?>"-->
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <button type="submit" class="default-button" name="edit" style="padding:10px; margin:10px">Edit Profile</button>
            </form>

        </div>
    </div>
    <?php include_once "../../footer.php"; ?>
</body>

</html>