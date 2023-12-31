<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - JUSTBFITNESS</title>
    <link rel="stylesheet" href="CSS/home.css">
</head>
<body>

    <?php include_once "dashboard.php"; ?>


    <div class="title">
        <div class="title-text">
            Forgot Password
        </div>
    </div>
    <div class="all-container">

        <div class="forgot-password-instructions">
            Please enter the email address associated with your account.<br>
            You will receive an email message with a code to enter here.
        </div>
        <div class="all-form">
            <div class="form-header">Reset Password:</div>
            <form action='?controller=user&action=forgotpassword' method='post'>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <button type="submit">Get Code</button>
                </div>
            </form>
        </div>
    </div>


        <?php include_once 'footer.php' ?>

</body>
</html>


