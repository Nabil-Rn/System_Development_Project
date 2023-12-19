<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - JUSTBFITNESS</title>
    <link rel="stylesheet" href="CSS/home.css">
</head>
<body>
<header>
    <?php include_once "dashboard.php"; ?>
</header>

    <div class="title">
        <div class="title-text">
            Forgot Password
        </div>
    </div>
    <div class="all-container">

        <div class="forgot-password-instructions">
            Please enter your new password with your account.
        </div>
        <div class="all-form">
            <div class="form-header">Create your new Password:</div>
            <form action='?controller=user&action=changepassword' method='post'>
                <div class="form-group">
                    <label for="password">New password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">submit</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <?php include_once 'footer.php' ?>
    </footer>
</body>
</html>


