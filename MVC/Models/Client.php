<?php
    include_once  "mysqldatabase.php";

class Client{

    public $ClientNumber;
    public $lastName;
    public $firstName;
    public $email;


    function __construct($id = -1){
        global $conn;

        $this->ClientNumber = $id;
        if($id < 0){
            $this->lastName = "";
            $this->firstName = "";
            $this->email = "";
        }
        else{
            $sql = "SELECT * from `user` WHERE `ClientNumber`=" . $id;
            $result = $conn->query($sql);

            $data = $result->fetch_assoc();

            $this->ClientNumber = $id;
            $this->lastName = $data['lname'];
            $this->firstName = $data['fname'];
            $this->email = $data['email'];
        }
    }


    public static function listClientes(){
        global $conn;
        $list = array();

        $sql = "SELECT * from `user`";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $emp = new Client();
            $emp->ClientNumber = $row['user_id'];
            $emp->lastName = $row['lname'];
            $emp->firstName = $row['fname'];
            $emp->email = $row['email'];

            array_push($list, $emp);
        }

        return $list;
    }

    function update($id, $lastName, $firstName, $email){
        global $conn;

        $sql = "UPDATE `user` SET `lname` = '$lastName', `fname` = '$firstName', `email` = '$email' WHERE `user`.`user_id` = $id;";
        $conn->query($sql);

    }
}

?>