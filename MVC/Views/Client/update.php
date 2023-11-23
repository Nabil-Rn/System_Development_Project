<html>
    <head>
        <title>Profile</title>
    </head>
    <body>
        <form action="/?controller=client&action=updateSave&id=<?php echo $data[0]->employeeNumber?>" method="POST">
            <input name="user_id" type="hidden" value="<?php echo $data[0]->employeeNumber;?>" >
            <br><input name="fname" value="<?php echo $data[0]->firstName;?>">
            <br><input name="lname" value="<?php echo $data[0]->lastName;?>">
            <br><input name="email" value="<?php echo $data[0]->email;?>">

            <br><input type="submit" value="Save Update">
        </form>
    </body>
</html>