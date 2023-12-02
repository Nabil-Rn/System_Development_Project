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
            <div class= "title-header">MY PROFILE</div>

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

            <table>
                    <td>
                        <form method="post" action="index.php?controller=client&action=delete">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit" class="default-button" name="delete">Delete Account</button>
                        </form>
                    </td>
                    
                    <td>
                        <form method="post" action="index.php?controller=client&action=edit&id=<?php echo $user['user_id']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit" class="default-button" name="edit">Edit Profile</button>
                        </form>
                    </td>
            </table>
            
            </div>
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
                    <a href="https://facebook.com/JustBfitnessOfficial/"><img src="../../assets/facebook.png" ></a>
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