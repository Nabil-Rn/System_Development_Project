<!---EDIT CURRENT USER IN SESSION PROFILE -> EDIT MY PROFILE for href="index.php?controller=user&action=edit&id=?" -->
<!---WILL HAVE TO ADD IF-ELSE STATEMENT FOR CLIENT/ADMIN interface -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUSTBFITNESS</title>
    <link rel="shortcut icon" href="assets/favicon.ico">
    <link rel="stylesheet" href="CSS/home.css">
    <link rel="stylesheet" href="CSS/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
</head>

<body>
    <?php include_once "dashboard.php"; ?>

    <form method="post" action="?controller=client&action=update">
        <input type="hidden" name="user_id" value="<?php echo "test" ?>">

        <div class="center">
            <div class="profile">
                <div class="title-header">MY PROFILE</div>

                <!-- First Name -->
                <div class="grey-box">
                    <div class="grey-label">First Name</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" value="<?php echo $user['FNAME']; ?>" required>
                </div>

                <!-- Last Name -->
                <div class="grey-box">
                    <div class="grey-label">Last Name</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="lname" name="lname" autocomplete="off" value="<?php echo $user['LNAME']; ?>" required>
                </div>

                <!-- Age -->
                <div class="grey-box">
                    <div class="grey-label">Age</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="age" name="age" autocomplete="off" value="<?php echo $user['AGE']; ?>">
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
                    <input type="text" class="form-control" id="weight" name="weight" autocomplete="off" value="<?php echo $user['WEIGHT']; ?>">
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
                    <input type="text" class="form-control" id="height" name="height" autocomplete="off" value="<?php echo $user['HEIGHT']; ?>">
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
                    <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="<?php echo $user['EMAIL']; ?>" required>
                </div>

                <!-- Phone Number -->
                <div class="grey-box">
                    <div class="grey-label">Phone Number</div> 
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" value="<?php echo $user['PHONE']; ?>">
                </div>

                <!-- Password -->
                <div class="grey-box">
                    <div class="grey-label">Password</div> 
                </div>
                <div class="white-box">
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" value="<?php echo $user['PASSWORD']; ?>" required>
                </div>

                <!-- Additional Note -->
                <div class="grey-box">
                    <table>
                        <td><label class="grey-label">Additional Note</label></td>
                        <td><p class="subtext">[Share any relevant information about your medical conditions, injuries, allergies, meds, past fitness, and goals]</p></td>
                    </table> 
                </div>
                <div class="white-box">
                    <textarea class="form-control" id="note" name="note" autocomplete="off"><?php echo $user['ADDITIONAL_NOTE']; ?></textarea>
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
        <?php include_once "footer.php"; ?>
    </footer>
</body>

</html>
