<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="../../CSS/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <header>
        <div class="header-container">
            <div class="right-box">
                <img class="logo-image" src="../../assets/logo.png" alt="Logo" />
                <div class="title-container"> JustBFitness</div>
            </div>
            <div class="right-box">
                <label><a href="javascript:window.history.back();">LOGIN</a></label>
            </div>
        </div>
    </header>

    <div class="title">
        <div class="title-text">Sign Up</div>
    </div>

    <div class="all-container">



        <div class="all-form">
            <form action="RegisterProcess.php" method="post">
                <div class="title-large">Create Your Account: </div>
                <div class="form-group">
                    <label><span class="required">*</span>First Name:</label>
                    <div class="input-box"><input type="text" id="fname" required></div>


                    <label><span class="required">*</span>Last Name:</label>
                    <div class="input-box"><input type="text" id="lname" required></div>


                    <label>Phone Number:</label>
                    <div class="input-box"><input type="phone" id="phone"></div>


                    <label><span class="required">*</span>Email:</label>
                    <div class="input-box"><input type="email" id="email" required></div>


                    <label><span class="required">*</span>Password:</label>
                    <div class="input-box"><input type="password" id="password" required></div>


                    <label><span class="required">*</span>Re-Enter Password:</label>
                    <div class="input-box"><input type="password" id="re-password" required></div>

                    <div class="button-container">
                    <input type="submit" class="button" value="Sign Up">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <div class="left-box">
            <div class="contact-item">
                <div class="contact-label">Contact Us | Contactez nous</div>
                <div class="contact-info">
                    <div class="contact-text"><a href="mailto:enquiries@justbfitness.ca">enquiries@justbfitness.ca</a></div>
                    <div class="contact-text"><a href="tel:+15148628093">(514) 862-8093</a></div>
                </div>
                <div class="social-icons">
                    <a href="https://facebook.com/JustBfitnessOfficial/"><img src="../../assets/facebook.png"></a>
                    <a href="https://www.instagram.com/JustBfitness.ca/"><img src="../../assets/instagram.png"></a>
                </div>
            </div>
        </div>
        <div class="right-box">
            <div class="contact-item">
                <img class="logo-image" src="../../assets/logo.png" alt="Logo">
                <div class="copy-rights-text"> &copy; JUST B FITNESS 2023. ALL RIGHTS RESERVED.</div>
            </div>
        </div>

    </footer>
</body>

</html>