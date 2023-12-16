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

    <div class="center">
        <div class="profile">
            <div class="title-header">MY PROFILE</div>

            <div class="grey-box">
                <div class="grey-label">First Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($_SESSION['user']->fname); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Last Name</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($_SESSION['user']->lname); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Age</div>
            </div>
            <div class="white-box">
                <div class="label-input">
                <?php echo isset($_SESSION['user']->age) && $_SESSION['user']->age !== -1
                    ? htmlspecialchars($_SESSION['user']->age)
                    : "Not specified"; ?>
                </div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Gender</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo !empty($_SESSION['user']->gender) ? htmlspecialchars($_SESSION['user']->gender) : "Not specified"; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Weight</div>
            </div>
            <div class="white-box">
                <div class="label-input">
                    <?php
                    echo isset($_SESSION['user']->weight) && $_SESSION['user']->weight !== -1
                    ? htmlspecialchars($_SESSION['user']->weight)
                    : "Not specified";                
                    echo !empty($_SESSION['user']->weight_unit) ? htmlspecialchars($_SESSION['user']->weight_unit) : "";
                    ?>
                </div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Height</div>
            </div>
            <div class="white-box">
                <div class="label-input">
                    <?php
                     echo isset($_SESSION['user']->height) && $_SESSION['user']->height !== -1
                    ? htmlspecialchars($_SESSION['user']->height)
                    : "Not specified";
                    echo !empty($_SESSION['user']->height_unit) ? htmlspecialchars($_SESSION['user']->height_unit) : "";
                    ?>
                </div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Email</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo htmlspecialchars($_SESSION['user']->email); ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Phone Number</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo !empty($_SESSION['user']->phone) ? htmlspecialchars($_SESSION['user']->phone) : "Not specified"; ?></div>
            </div>

            <div class="grey-box">
                <div class="grey-label">Password</div>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo str_repeat('*', strlen($_SESSION['user']->password)); ?></div>
            </div>

            <div class="grey-box">
                <table>
                    <td><label class="grey-label">Additional Note</label></td>
                    <td><p class="subtext">[Share any relevant information about your medical conditions, injuries, allergies, meds, past fitness, and goals]</p></td>
                </table>
            </div>
            <div class="white-box">
                <div class="label-input"><?php echo !empty($_SESSION['user']->additional_note) ? htmlspecialchars($_SESSION['user']->additional_note) : "Not specified"; ?></div>
            </div>

            <table>
                <td>
                    <button class="default-button" name="confirm-delete" id="confirmDeleteButton">Delete Account</button>
                </td>

                <td>
                    <form method="post" action="?controller=user&action=edit">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']->user_id; ?>">
                        <button type="submit" class="default-button" name="edit">Edit Profile</button>
                    </form>
                </td>

            </table>
    
        </div>
    </div>
    <div class="pop-up"> <div class="blackbar"><p class="message">Your account has been successfully deleted.</p></div></div>
    <!-- Footer -->
    <?php include_once "footer.php"; ?>


<!-- Modal Structure -->
<div id="modalOverlay" style="display: none;" onclick="closeModal()">
    <div id="deleteModalContainer" onclick="event.stopPropagation();">
        <div id="deleteModal">
            <p id="deleteTitle">Confirm delete</p>
            <p id="deleteSubtitle">Are you sure you want to delete your account?</p>
            <p id="deleteText">This action is irreversible and cannot be undone.</p>
            <table>
                <tr>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                        <button type="submit" class="confirm-button" name="delete">Yes</button>
                    </td>
                    <td>
                        <button class="confirm-button" id="popupCloseButton">No</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('confirmDeleteButton').addEventListener('click', function () {
            showDeleteModal();
        });

        document.getElementById('popupCloseButton').addEventListener('click', function () {
            closeModal();
        });
    });

    function showDeleteModal() {
        document.getElementById('modalOverlay').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('modalOverlay').style.display = 'none';
    }
</script>

</body>
</html>
