<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include "dashboard.php"; ?>
    
    <form method="post" action="?controller=user&action=update">
        <div class="center">
            <div class="profile">
                <div class="title-header">MY PROFILE</div>

                <!-- First Name -->
                <div class="grey-box">
                    <div class="grey-label">First Name</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->fname); ?>" required>
                </div>

                <!-- Last Name -->
                <div class="grey-box">
                    <div class="grey-label">Last Name</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="lname" name="lname" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->lname); ?>" required>
                </div>

                <!-- Email -->
                <div class="grey-box">
                    <div class="grey-label">Email</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->email); ?>" required>
                </div>

                <!-- Phone Number -->
                <div class="grey-box">
                    <div class="grey-label">Phone Number</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->phone); ?>">
                </div>

                <!-- Password -->
                <div class="grey-box">
                    <div class="grey-label">Password</div>
                </div>
                <div class="white-box">
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->password); ?>" required>
                </div>

                <!-- Buttons -->
                <table>
                    <td>
                        <button type="submit" class="default-button"  name="back" onclick="window.history.back();">Back</button>
                    </td>

                    <td>
                        <button type="submit" class="default-button" name="update">Save Changes</button>
                    </td>
                </table>
            </div>
        </div>
    </form>

    <?php include "footer.php"; ?>
    
</body>

</html>
