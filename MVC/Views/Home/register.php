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
        <div class="title-text">Sign Up</div>
    </div>

    <div class="all-container">

        <div class="all-form">
            <form action="?controller=user&action=register" method="post"> 
                <div class="title-large">Create Your Account: </div>
                <div class="form-group">
                    <label><span class="required">*</span>First Name:</label>
                    <div class="input-box"><input type="text" name="fname" id="fname" required></div>


                    <label><span class="required">*</span>Last Name:</label>
                    <div class="input-box"><input type="text" name="lname" id="lname" required></div>


                    <label>Phone Number:</label>
                    <div class="input-box"><input type="phone" name="phone" id="phone"></div>


                    <label><span class="required">*</span>Email:</label>
                    <div class="input-box"><input type="email" name="email" id="email" required></div>


                    <label><span class="required">*</span>Password:</label>
                    <div class="input-box"><input type="password" name="password" id="password" required></div>


                    <label><span class="required">*</span>Re-Enter Password:</label>
                    <div class="input-box"><input type="password" name="re-password" id="re-password" required></div>

                    <div class="button-container">
                    <input type="submit" class="button" value="Sign Up">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <?php include_once 'footer.php' ?>
    </footer>
</body>

</html>