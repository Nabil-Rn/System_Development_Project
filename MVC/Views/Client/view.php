<html>
    <head>
        <title>Profile</title>
    </head>
    <body>
        <form action="/?controller=client&action=updateSave&id=<?php echo $data[0]->clientNumber?>" method="POST">
            <input name="clientNumber" type="hidden" value="<?php echo $data[0]->clientNumber;?>" disabled>
            <br><input name="fname" value="<?php echo $data[0]->firstName;?>" disabled>
            <br><input name="lname" value="<?php echo $data[0]->lastName;?>" disabled>
            <br><input name="email" value="<?php echo $data[0]->email;?>" disabled>

            <br><a href="/?controller=client&action=index"><input type="button" value="Go to client list"></a>
        </form>
    </body>
</html>