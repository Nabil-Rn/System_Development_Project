<?php
$client = new Employee($_POST['ClientNumber']);

$client ->update(  $_POST['ClientNumber'],
                $_POST['lname'],
                $_POST['fname'],
                $_POST['email']
);

header('Location: /?controller=client&action=index');
?>