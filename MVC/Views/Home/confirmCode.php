<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code - JUSTBFITNESS</title>
    <link rel="stylesheet" href="CSS/home.css">
</head>
<body>

    <?php include_once "dashboard.php"; ?>


    <div class="title">
        <div class="title-text">
            Forgot Password
        </div>
    </div>
    <div class="all-container">

        <div class="forgot-password-instructions">
            Please enter code!
        </div>
        <div class="all-form">
            <div class="form-header">Code:</div>
            <form action='?controller=user&action=confirm' method='post'>
                <div class="form-group">
                    <input type="text" id="code" name="code" required>
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

        <?php include_once 'footer.php' ?>

</body>
</html>


