<?php

    include_once dirname(__DIR__) . "/mysqldatabase.php";

class User {

    public $user_id;
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $phone;
    public $age;
    public $gender;
    public $weight;
    public $height;
    public $additional_note;
    public $group_id;

    public function __construct($id = -1) {
        global $conn;
    
        if ($id > 0) {
            // Fetch user details from the database
            $sql = "SELECT * FROM `user` WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
    
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
    
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $res = $stmt->get_result();
    
            if (!$res) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
    
            if ($res->num_rows > 0) {
                $assocUser = $res->fetch_assoc();
    
                $this->user_id = $id;
                $this->fname = $assocUser['fname'];
                $this->lname = $assocUser['lname'];
                $this->email = $assocUser['email'];
                $this->password = $assocUser['password'];
                $this->phone = $assocUser['phone'] ?? "Not specified";
                $this->age = $assocUser['age'] ?? null;
                $this->gender = $assocUser['gender'] ?? "Not specified";
                $this->weight = $assocUser['weight'] ?? null;
                $this->height = $assocUser['height'] ?? null;
                $this->additional_note = $assocUser['additional_note'] ?? "Not specified";
                $this->group_id = $assocUser['group_id'];
    
                $stmt->close();
            } else {
                $this->initializeDefaultValues();
            }
        } else {
            $this->initializeDefaultValues();
        }
    }
    
    private function initializeDefaultValues() {
        $this->user_id = -1;
        $this->fname = "";
        $this->lname = "";
        $this->email = "";
        $this->password = "";
        $this->phone = "Not specified";
        $this->age = null;
        $this->gender = "Not specified";
        $this->weight = null;
        $this->height = null;
        $this->additional_note = "Not specified";
        $this->group_id = null;
    }

    public static function login() {
        global $conn;
        $sql = "SELECT * FROM user WHERE email = '". $_POST['email'] . "' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($row['password']==md5($_POST['password'])){
            $user = new User();
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->fname = $row['fname'];
            $user->lname = $row['lname'];
            $user->group_id = $row['group_id'];
            $_SESSION['user'] = $user;
        }else{
            $_SESSION['alert'] = "Login unsuccessful. Please try again.";
        }
    }

    public static function list() {
        global $conn;
        $sql = 'SELECT * FROM `user`';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function read() {
        global $conn;
    
        if (isset($_POST['read'])) {
            // Get user_id from the POST data
            $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    
            // Validate $userId (ensure it's a positive integer, for example)
    
            // Prepare and execute the SQL query
            $sql = 'SELECT * FROM USER 
                    WHERE USER_ID = ?';
    
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Fetch the result
            $data = $result->fetch_assoc();
    
            // Return the fetched data
            return $data;
        }
    
        // Return false if no data is fetched
        return false;
    }
    

    public static function view() {
        global $conn;
    
        if (isset($_POST['view'])) {
            // Get user_id from the POST data
            $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    
            // Validate $userId (ensure it's a positive integer, for example)
    
            // Prepare and execute the SQL query
            $sql = 'SELECT 
                FNAME,
                LNAME,
                EMAIL,
                PHONE,
                AGE,
                GENDER,
                WEIGHT,
                HEIGHT,
                ADDITIONAL_NOTE
            FROM 
                USER
            WHERE 
                USER_ID = ?';
    
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();
    
            // Fetch the result
            $data = $result->fetch_assoc();
    
            // Return the fetched data
            return $data;
        }
    
        // Return false if no data is fetched
        return false;
    }
    
    public static function create() {
        global $conn;

        if (isset($_POST['create'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $group_id = $_POST['group_id'];

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = 'INSERT INTO `user` (fname, lname, email, password, group_id) VALUES (?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                die('Error preparing statement: ' . $conn->error);
            }

            $stmt->bind_param('ssssi', $fname, $lname, $email, $hashed_password, $group_id);
            $stmt->execute();

            if ($stmt->error) {
                die('Error executing statement: ' . $stmt->error);
            }

            $insertedUserId = $stmt->insert_id;

            $stmt->close();

            header("Location: index.php?controller=user&action=read&id=$user_id");
            exit();
        }

        return false;
    }

    public static function update() {
        global $conn;

        if (isset($_POST['update'])) {
            if (isset($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
                $group_id = $_POST['group_id'];

                $sql = 'UPDATE `user` SET group_id = ? WHERE user_id = ?';
                $stmt = $conn->prepare($sql);

                if (!$stmt) {
                    return 0;
                }

                $stmt->bind_param('ii', $group_id, $user_id);
                $stmt->execute();

                if ($stmt->errno) {
                    $stmt->close();
                    return 0;
                }

                $stmt->close();

                header("Location: index.php?controller=user&action=read&id=$user_id");
                exit();
            }
        }
        return false;
    }

    public static function delete() {
        global $conn;

        if (isset($_POST['delete'])) {
            $user_id = $_POST['user_id'];

            $sql = 'DELETE FROM `user` WHERE user_id = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $user_id);
            $stmt->execute();

            if ($stmt->error) {
                die('Error executing statement: ' . $stmt->error);
            }

            $stmt->close();
            
            // Unset all session variables
            $_SESSION = array();

            // Destroy the session
            session_destroy();

            // Redirect to the login page
            header("Location: index.php?controller=home&action=login"); //TO MODIFY LATER
            exit();
        }

        return false;
    }

    //REVIEW LATER...NEED TO REVIEW/UPDATE DB DEPENDING ON OUR ACTION NAMES
    public static function hasRights($classname, $action) {
        global $conn;

        $sql = "SELECT rights.RIGHTS_ID, rights.ACTION_NAME, rights.CLASS_NAME FROM `user` 
        INNER JOIN `group` USING (`group_id`) 
        INNER JOIN group_rights ON (`group`.group_id = group_rights.group_id) 
        INNER JOIN rights ON (group_rights.rights_id = rights.rights_id) 
        WHERE rights.ACTION_NAME LIKE '$action' AND rights.CLASS_NAME LIKE '$classname' AND `user`.user_id=$this->user_id;";

        echo $sql;

        $res = $conn->query($sql);
        $r = $res->fetch_assoc();

        var_dump($r);

        if ($r != NULL) return true;
        else return false;
    }
}

?>
