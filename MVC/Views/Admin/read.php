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
            <div class="title-header" style="margin-top:100px;">MY PROFILE</div>

            <div class="grey-box">
                <div class="grey-label">First Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['fname']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Last Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['lname']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Email</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($user['email']); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Phone Number</div>
            </div>

            <div class="white-box">
                <div class="label-input"><?php echo !empty($user['phone']) ? htmlspecialchars($user['phone']) : "Not specified"; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Password</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo str_repeat('*', strlen($user['password'])); ?></div>
            </div>

            <form method="post" action="?controller=user&action=edit&id=<?php echo $user['user_id']; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <button type="submit" class="default-button" name="edit" style="padding:10px; margin:10px">Edit Profile</button>
            </form>


        </div>
    </div>
    <?php include_once "footer.php"; ?>
</body>

</html>
