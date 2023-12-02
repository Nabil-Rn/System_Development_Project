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
    public $weight_unit;
    public $height;
    public $height_unit;
    public $additional_note;
    public $group_id;

    private $conn;

    public function __construct($conn, $id = -1) {
        $this->conn = $conn;

        if ($id > 0) {
            $this->loadUserData($id);
        } else {
            $this->initializeDefaultValues();
        }
    }

    private function loadUserData($id) {
    // Prepare the SQL statement to fetch user data
    $stmt = $this->conn->prepare("SELECT * FROM `user` WHERE user_id = ?");
    if (!$stmt) {
        throw new Exception("Error preparing statement: " . $this->conn->error);
    }

    // Bind the user ID parameter and execute the query
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows > 0) {
        $assocUser = $result->fetch_assoc();

        // Populate the object's properties with the fetched data
        $this->user_id = $assocUser['user_id'];
        $this->fname = $assocUser['fname'];
        $this->lname = $assocUser['lname'];
        $this->email = $assocUser['email'];
        $this->password = $assocUser['password']; // This should be a hashed password
        $this->phone = $assocUser['phone'] ?? "Not specified";
        $this->age = $assocUser['age'] ?? null;
        $this->gender = $assocUser['gender'] ?? "Not specified";
        $this->weight = $assocUser['weight'] ?? null;
        $this->weight_unit = $assocUser['weight_unit'] ?? "Not specified"; 
        $this->height = $assocUser['height'] ?? null;
        $this->height_unit = $assocUser['height_unit'] ?? "Not specified"; 
        $this->additional_note = $assocUser['additional_note'] ?? "Not specified";
        $this->group_id = $assocUser['group_id'];

        $stmt->close();
    } else {
        // If no user is found
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
        $this->weight_unit = "Not specified";
        $this->height = null;
        $this->height_unit = "Not specified";
        $this->additional_note = "Not specified";
        $this->group_id = null;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT user_id, fname, lname, group_id, password FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['fname'] = $user['fname'];
                $_SESSION['lname'] = $user['lname'];
                $_SESSION['email'] = $email;
                $_SESSION['group_id'] = $user['group_id'];

                return true;
            }
        }
        return false;
    }

    // This is for Client List
    public static function list() {
        global $conn;

        $sql = $sql = 'SELECT 
        USER_ID,
        GROUP_ID,
        FNAME,
        LNAME,
        EMAIL,
        PHONE
    FROM 
        USER
    WHERE 
        GROUP_ID <> 2';
    

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if fetch_all is available
        if (method_exists($result, 'fetch_all')) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
        } else {
        // If fetch_all is not available, fetch row by row
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        // Close the statement
        $stmt->close();

        return $data;
    }


    // For My Profile 
    public static function read() {
        global $conn;
    
        // Check if user ID is present in the session
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
        $sql = "SELECT * FROM `USER` WHERE USER_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $userId);
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Return the fetched result
        return $result->fetch_assoc();
    }

    // View Client Details as an Admin
    public static function view() {
        global $conn;

        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;

        if (isset($_POST['view']) && isset($_POST['user_id']) && is_numeric($_POST['user_id']) && $_POST['user_id'] > 0) {
            // Prepare and execute the SQL query
            $sql = 'SELECT 
                USER_ID,
                FNAME,
                LNAME,
                EMAIL,
                PHONE,
                AGE,
                GENDER,
                WEIGHT,
                WEIGHT_UNIT, 
                HEIGHT,
                HEIGHT_UNIT, 
                ADDITIONAL_NOTE
            FROM 
                USER
            WHERE 
                USER_ID = ? AND
                GROUP_ID <> 2';  // Exclude admins

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

    
    // To modify later
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

    // To modify later
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

    // To modify later
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

    // Save a new user
    public function saveUser($fname, $lname, $email, $hashed_password, $phone, $userGroup) {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $this->conn->prepare("INSERT INTO user (first_name, last_name, email, password, phone, user_group) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fname, $lname, $email, $hashed_password, $phone, $userGroup);
        
        // Execute the statement
        $result = $stmt->execute();
        if (!$result) {
        // Handle error appropriately
        die('Execute failed: ' . $stmt->error);
    }

        // Close the statement
        $stmt->close();

        return $result;
    }

}

?>
