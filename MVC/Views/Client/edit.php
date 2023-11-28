<!---EDIT CURRENT USER IN SESSION PROFILE -> EDIT MY PROFILE for href="index.php?controller=user&action=edit&id=?" -->
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
    
    <form method="post" action="index.php?controller=client&action=update">
        <input type="hidden" name="user_id" value="<?php echo "test" ?>">

        <div class="center">
            <div class="profile">
                <div class="title-header">MY PROFILE</div>

                <!-- First Name -->
                <div class="grey-box">
                    <div class="grey-label">First Name</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" value="<?php echo $user->fname; ?>" required>
                </div>

                <!-- Last Name -->
                <div class="grey-box">
                    <div class="grey-label">Last Name</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="lname" name="lname" autocomplete="off" value="<?php echo $user->lname; ?>" required>
                </div>

                <!-- Age -->
                <div class="grey-box">
                    <div class="grey-label">Age</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="age" name="age" autocomplete="off" value="<?php echo $user->age; ?>">
                </div>

                <!-- Gender -->
                <div class="grey-box">
                    <div class="grey-label">Gender</div> 
                </div>
                <div class="white-box">
                    <!-- NEED TO RETRIEVE CHECKED ANSWER TO UPDATE THIS VALUE -->
                    <table>
                        <td> <label class="label-input"> <input type="radio" name="gender" value="male">Male</label></td> 
                        <td> <label class="label-input"> <input type="radio" name="gender" value="female">Female</label></td> 
                        <td> <label class="label-input"> <input type="radio" name="gender" value="other" checked>Prefer to not say</label></td> 
                    </table>
                </div>

                <!-- Weight -->
                <div class="grey-box">
                    <div class="grey-label">Weight</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="weight" name="weight" autocomplete="off" value="<?php echo $user->weight; ?>">
                    <!-- NEED TO RETRIEVE WEIGHT UNIT -->
                    <select id="weightUnit" name="weightUnit">
                        <option value="" disabled selected>Weight Unit</option>
                        <option value="kg">Kilograms (kg)</option>
                        <option value="lbs">Pounds (lbs)</option>
                        <option value="g">Grams (g)</option>
                    </select>
                </div>

                <!-- Height -->
                <div class="grey-box">
                    <div class="grey-label">Height</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="height" name="height" autocomplete="off" value="<?php echo $user->height; ?>">
                     <!-- NEED TO RETRIEVE HEIGHT UNIT -->
                    <select id="heightUnit" name="heightUnit">
                        <option value="" disabled selected>Height Unit</option>
                        <option value="cm">Centimeters (cm)</option>
                        <option value="in">Inches (in)</option>
                        <option value="m">Meters (m)</option>
                    </select>
                </div>

                <!-- Email -->
                <div class="grey-box">
                    <div class="grey-label">Email</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="<?php echo $user->email; ?>" required>
                </div>

                <!-- Phone Number -->
                <div class="grey-box">
                    <div class="grey-label">Phone Number</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" value="<?php echo $user->phone; ?>">
                </div>

                <!-- Password -->
                <div class="grey-box">
                    <div class="grey-label">Password</div> 
                </div>
                <div class="white-box">
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" value="<?php echo $user->password; ?>" required>
                </div>

                <!-- Additional Note -->
                <div class="grey-box">
                    <table>
                        <td><label class="grey-label">Additional Note</label></td>
                        <td><p class="subtext">[Share any relevant information about your medical conditions, injuries, allergies, meds, past fitness, and goals]</p></td>
                    </table> 
                </div>
                <div class="white-box">
                    <textarea class="form-control" id="note" name="note" autocomplete="off"><?php echo $user->additional_note; ?></textarea>
                </div>

                <!-- Buttons -->
                <table>
                    <td>
                        <button type="submit" class="default-button" onclick="window.history.back();">Back</button>
                    </td>
                    
                    <td>
                        <button type="submit" class="default-button" name="update">Save Changes</button>
                    </td>
                </table>
            </div>
        </div>
    </form>

    <!-- Footer -->
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
