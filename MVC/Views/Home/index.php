<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>
<body>
    <header>
        <?php include_once "dashboard.php"; ?>
    </header>

    <div class="title">
        <div class="title-text">Login</div>
    </div>

    <?php
        if (isset($_SESSION['login_error'])) {
            echo "<p class='error'>" . $_SESSION['login_error'] . "</p>";
            unset($_SESSION['login_error']);
        }
    ?>

    <div class="all-container">
        <form action='Controllers/UserController.php' method='post'>
            <input type="hidden" name="action" value="login">
            <div class="all-form">
                <div class="title-large">Login to your Account:</div>
                <div class="form-group">
                    <label><span class="required">*</span>Email:</label>
                    <div class="input-box"><input type="email" name="email" id="email" required></div>

                    <label><span class="required">*</span>Password:</label>
                    <div class="input-box"><input type="password" name="password" id="password" required></div>

                    <div class="link"><a href="Views/Auth/forgotPassword.php">Forgot Password?</a></div>
                    <div class="button-container">
                        <div class="button"><button type="submit">Login</button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <footer>
        <?php include_once 'footer.php' ?>
    </footer>
</body>
</html>
