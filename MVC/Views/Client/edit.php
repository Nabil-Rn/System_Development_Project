<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include_once "dashboard.php"; ?>

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

                <!-- Age -->
                <div class="grey-box">
                    <div class="grey-label">Age</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="age" name="age" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->age); ?>">
                </div>

                <!-- Gender -->
                <div class="grey-box">
                    <div class="grey-label">Gender</div>
                </div>
                <div class="white-box">
                    <!-- NEED TO RETRIEVE CHECKED ANSWER TO UPDATE THIS VALUE -->
                    <table>
                        <td>
                            <label class="label-input">
                                <input type="radio" name="gender" value="male" <?php echo ($_SESSION['user']->gender === 'male') ? 'checked' : ''; ?>>Male
                            </label>
                        </td>
                        <td>
                            <label class="label-input">
                                <input type="radio" name="gender" value="female" <?php echo ($_SESSION['user']->gender === 'female') ? 'checked' : ''; ?>>Female
                            </label>
                        </td>
                        <td>
                            <label class="label-input">
                                <input type="radio" name="gender" value="other" <?php echo ($_SESSION['user']->gender === 'other') ? 'checked' : ''; ?>>Prefer to not say
                            </label>
                        </td>
                    </table>
                </div>

                <!-- Weight -->
                <div class="grey-box">
                    <div class="grey-label">Weight</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="weight" name="weight" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->weight); ?>">
                    <!-- NEED TO RETRIEVE WEIGHT UNIT -->
                    <select id="weightUnit" name="weightUnit">
                        <option value="" disabled selected>Weight Unit</option>
                        <option value="kg" <?php echo ($_SESSION['user']->weight_unit === 'kg') ? 'selected' : ''; ?>>Kilograms (kg)</option>
                        <option value="lbs" <?php echo ($_SESSION['user']->weight_unit === 'lbs') ? 'selected' : ''; ?>>Pounds (lbs)</option>
                        <option value="g" <?php echo ($_SESSION['user']->weight_unit === 'g') ? 'selected' : ''; ?>>Grams (g)</option>
                    </select>
                </div>

                <!-- Height -->
                <div class="grey-box">
                    <div class="grey-label">Height</div>
                </div>
                <div class="white-box">
                    <input type="text" class="form-control" id="height" name="height" autocomplete="off" value="<?php echo htmlspecialchars($_SESSION['user']->height); ?>">
                    <!-- NEED TO RETRIEVE HEIGHT UNIT -->
                    <select id="heightUnit" name="heightUnit">
                        <option value="" disabled selected>Height Unit</option>
                        <option value="cm" <?php echo ($_SESSION['user']->height_unit === 'cm') ? 'selected' : ''; ?>>Centimeters (cm)</option>
                        <option value="in" <?php echo ($_SESSION['user']->height_unit === 'in') ? 'selected' : ''; ?>>Inches (in)</option>
                        <option value="m" <?php echo ($_SESSION['user']->height_unit === 'm') ? 'selected' : ''; ?>>Meters (m)</option>
                    </select>
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

                <!-- Additional Note -->
                <div class="grey-box">
                    <table>
                        <td><label class="grey-label">Additional Note</label></td>
                        <td><p class="subtext">[Share any relevant information about your medical conditions, injuries, allergies, meds, past fitness, and goals]</p></td>
                    </table>
                </div>
                <div class="white-box">
                    <textarea class="form-control" id="note" name="note" autocomplete="off"><?php echo htmlspecialchars($_SESSION['user']->additional_note); ?></textarea>
                </div>

                <!-- Buttons -->
                <table>
                    <td>
                        <button type="submit" class="default-button" name="back" onclick="window.history.back();">Back</button>
                    </td>

                    <td>
                        <button type="submit" class="default-button" name="update">Save Changes</button>
                    </td>
                </table>
            </div>
        </div>
    </form>

    <?php include_once "footer.php"; ?>

</body>

</html>
