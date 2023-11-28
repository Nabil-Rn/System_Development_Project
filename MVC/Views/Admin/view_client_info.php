<!--- VIEW DETAILS OF CLIENT INFO: This file name is intended to be renamed "view.php",  for href="index.php?controller=user&action=view&id=?" -->
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

            <div class="title-header">CLIENT#<?php echo $user->user_id; ?></div>

            <div class="grey-box">
                <div class="grey-label">First Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->fname; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Last Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->lname; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Age</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->age; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Gender</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->gender; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Weight</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->weight; ?> <!-- add weight unit --></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Height</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->height; ?> <!-- add height unit --></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Email</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->email; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Phone Number</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->phone; ?></div>
            </div>

            <div class="grey-box">
                <table>
                    <td><label class="grey-label">Additional Note</label></td>
                    <td><p class="subtext">[Share any relevant information about your medical conditions,
                            injuries, allergies, meds, past fitness, and goals]</p></td>
                </table>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo $user->additional_note; ?></div>
            </div>

            <table>
            <td>
            <form method="post" action="index.php?controller=client&action=delete">
                <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">
                <button type="submit" class="default-button" name="delete">Delete</button>
            </form>
            </td>
            </table>
     
        </div>
    </div>
     <footer>
        <?php include dirname(__FILE__) . "/../../footer.php"; ?>
    </footer>
</body>

</html>
