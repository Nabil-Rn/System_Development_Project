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

<header>
    <div class="header-container">
    <div class="right-box">
        <img class="logo-image" src="../../assets/logo.png" alt="Logo" />
        <div class="title-container"> JustBFitness</div>
    </div>
    <div class="right-box">
    <table>
        <tr>
            <td class="dropdown">
                <div class="icon-container"><img class="icon-image" src="../../assets/profile.png" alt="Icon" /></div>
                    <div class="dropdown-content">
                        <a href="index.php?controller=client&action=view">My Profile</a>
                        <a href="index.php?controller=client&action=exit">Logout</a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</header>

<body>

    <form method="post" action="index.php?controller=client&action=update">
    <input type="hidden" name="user_id" value="<?php echo "test" ?>">

    <div class="center">
        <div class="profile">
            <div class= "title-header">MY PROFILE</div>
            
    

            <div class="grey-box">
                <div class="grey-label">First Name</div> 
            </div>
            <div class="white-box">
                <input type="text" class="form-control" id="fname" name="fname" autocomplete="off" value="<?php echo "John" ?>" required>
            </div>

            <div class="grey-box">
                <div class="grey-label">Last Name</div> 
            </div>
            <div class="white-box">
                <input type="text" class="form-control" id="lname" name="lname" autocomplete="off" value="<?php echo "Doe" ?>" required>
            </div>

            <div class="grey-box">
                <div class="grey-label">Age</div> 
            </div>
            <div class="white-box">
                <input type="text" class="form-control" id="age" name="age" autocomplete="off" value="<?php echo "Not specified" ?>">
            </div>

            <div class="grey-box">
                <div class="grey-label">Gender</div> 
            </div>
            <div class="white-box">
                <table>
                    <td> <label class="label-input"> <input type="radio" name="gender" value="male">Male</label></td> 
                    <td> <label class="label-input"> <input type="radio" name="gender" value="female">Female</label></td> 
                    <td> <label class="label-input"> <input type="radio" name="gender" value="other" checked>Prefer to not say</label></td> 
                </table>
            </div>

            <div class="grey-box">
                <div class="grey-label">Weight</div> 
            </div>
            <div class="white-box">
                <input type="text" class="form-control" id="weight" name="weight" autocomplete="off" value="<?php echo "Not specified" ?>">
                <select id="weightUnit" name="weightUnit">
                    <option value="" disabled selected>Weight Unit</option>
                    <option value="kg">Kilograms (kg)</option>
                    <option value="lbs">Pounds (lbs)</option>
                    <option value="g">Grams (g)</option>
                </select>
            </div>

            <div class="grey-box">
                <div class="grey-label">Height</div> 
            </div>
            <div class="white-box">
            <input type="text" class="form-control" id="height" name="height" autocomplete="off" value="<?php echo "Not specified" ?>">
                <select id="heightUnit" name="heightUnit">
                    <option value="" disabled selected>Height Unit</option>
                    <option value="cm">Centimeters (cm)</option>
                    <option value="in">Inches (in)</option>
                    <option value="m">Meters (m)</option>
                </select>
            </div>

            <div class="grey-box">
                <div class="grey-label">Email</div> 
            </div>
            <div class="white-box">
                <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="<?php echo "john.doe@gmail.com" ?>" required>
            </div>

            <div class="grey-box">
                <div class="grey-label">Phone Number</div> 
            </div>
            <div class="white-box">
                <input type="text" class="form-control" id="phone" name="phone" autocomplete="off" value="<?php echo "124-356-7890" ?>">
            </div>

            
            <div class="grey-box">
                <div class="grey-label">Password</div> 
            </div>
            <div class="white-box">
                <input type="password" class="form-control" id="password" name="password" autocomplete="off" value="<?php echo "********" ?>" required>
            </div>


            <div class="grey-box">
                <table>
                    <td><label class="grey-label">Additional Note</label></td>
                    <td><p class="subtext">[Share any relevant information about your medical conditions, injuries, allergies, meds, past fitness, and goals]</p></td>
                </table> 
            </div>
            <div class="white-box">
                <textarea class="form-control" id="note" name="note" autocomplete="off"><?php echo "Not specified"; ?></textarea>
            </div>

             
            <table>
        
                <td>
                    <button type="submit" class="default-button" onclick="window.history.back();">Back</button>
                </td>
                
                <td>
                    <button type="submit" class="default-button" name="save">Save Changes</button>
                </td>
            </table>
        </div>
        </div>
     
    </div>
    </form>
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
