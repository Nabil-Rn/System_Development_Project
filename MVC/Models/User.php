<?php

    include_once "mysqldatabase.php";

class User {

    public $user_id;
    public $fname;
    public $lname;
    public $email;
    public $password; // This should be a hashed password
    public $phone;
    public $age;
    public $gender;
    public $weight;
    public $weight_unit;
    public $height;
    public $height_unit;
    public $additional_note;
    public $group_id;

    public function __construct($id = -1) {
        global $conn;

        // Initialize default values
        $this->user_id = -1;
        $this->fname = "";
        $this->lname = "";
        $this->email = "";
        $this->password = "";
        $this->phone = "";
        $this->age = -1;
        $this->gender = "";
        $this->weight = -1;
        $this->weight_unit = "";
        $this->height = -1;
        $this->height_unit = "";
        $this->additional_note = "";
        $this->group_id = -1;

        // Load user data if a valid ID is provided
        if ($id > 0) {
            // Fetch user details from the database
            $sql = "SELECT * FROM `user` WHERE user_id = ?";
            $stmt = $conn->prepare($sql);

            // Check if the prepared statement was successful
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }

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
                $this->phone = $assocUser['phone'];
                $this->age = $assocUser['age'];
                $this->gender = $assocUser['gender'];
                $this->weight = $assocUser['weight'];
                $this->weight_unit = $assocUser['weight_unit']; 
                $this->height = $assocUser['height'];
                $this->height_unit = $assocUser['height_unit']; 
                $this->additional_note = $assocUser['additional_note'];
                $this->group_id = $assocUser['group_id'];

                $stmt->close();
            }
        }
    }


    public static function login() {
        global $conn;
        $sql = "SELECT * FROM user WHERE email = '". $_POST['email'] . "' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        if(password_verify($_POST['password'], $row['password'])){ 
            $user = new User();
            $user->user_id = $row['user_id'];
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

  
    public function register($firstName, $lastName, $phone, $email, $password, $confirmPassword, $groupId = 1) {
        global $conn;
        // Validate input data
        if (empty($firstName) || empty($lastName) || empty($phone) || empty($email) || empty($password)) {
            $error_message ="All fields are required.";
            $this->render("Home", "register", array('error' => $error_message));
            
            exit();
            //"All fields are required.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message ="Invalid email format.";
            $this->render("Home", "register", array('error' => $error_message));
            
            exit();
            //"Invalid email format.";
        }

        if ($password !== $confirmPassword) {
            $error_message =  "Passwords do not match.";
            
            $this->render("Home", "register", array('error' => $error_message));
            
            exit();
            //return "Passwords do not match.";
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare database query
        $query = 'INSERT INTO user (fname, lname, phone, email, password, group_id) VALUES (?, ?, ?, ?, ?, ?)';
        try{
            if ($stmt = $conn->prepare($query)) {
            // Bind parameters
            $stmt->bind_param("sssssi", $firstName, $lastName, $phone, $email, $hashedPassword, $groupId);

                // Execute query and check for successful insertion
                if ($stmt->execute()) {
                    return true;
                } else {
                    // Handle errors, e.g., duplicate entry
                    $error_message =  "An error occurred: " . $stmt->error;
                    $this->render("Home", "register", array('error' => $error_message));
            
                     exit();
                    //"An error occurred: " . $stmt->error;
                }
            
            }
             else {
            // Handle preparation error
            $error_message =  "An error occurred during query preparation: " . $conn->error;
            $this->render("Home", "register", array('error' => $error_message));
            
            exit();
            //"An error occurred during query preparation: " . $conn->error;
            }
        }catch (mysqli_sql_exception $exception) {
            // Handle specific error (duplicate entry)
            if ($exception->getCode() == 1062) { // 1062 is the MySQL error code for duplicate entry
                $error_message = "Email address is already in use.";
                $this->render("Home", "register", ['error' => $error_message]);
                exit();
            } else {
                // Handle other exceptions
                $error_message = "An unexpected error occurred: " . $exception->getMessage();
                $this->render("Home", "register", ['error' => $error_message]);
                exit();
            }
        }
        
    }
    
    public static function list() {
        global $conn;
    
        $sql = 'SELECT 
                    USER.USER_ID,
                    USER.FNAME,
                    USER.LNAME,
                    USER.EMAIL,
                    USER.GROUP_ID,
                    `GROUP`.GROUP_NAME
                FROM 
                    USER
                INNER JOIN 
                    `GROUP` ON USER.GROUP_ID = `GROUP`.GROUP_ID';
    
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Fetch all rows into an associative array
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        // Close the statement
        $stmt->close();
    
        return $data;
    }
    

// For My Profile
public static function read() {
    global $conn;

    // Check if user ID is present in the session
    $userId = isset($_SESSION['user']) ? $_SESSION['user']->user_id : null;

    $sql = "SELECT * FROM `USER` WHERE USER_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);

    $stmt->execute();
    $result = $stmt->get_result();

    // Return the fetched result
    return $result->fetch_assoc();
}


    public static function view() {
        global $conn;
    
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    
        if (isset($_POST['view'])) {
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
    
            // Return the fetched data or false if no data is fetched
            return $data ? $data : false;
        }
    
        // Return false if no data is fetched
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

    public static function logout() {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Location: ?controller=home");
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
    function render($controller, $view, $data = []) {
        if($data != null){
            extract($data);
            include "Views/$controller/$view.php";
        }else{
            include "Views/$controller/$view.php";
        }
    }

}

?>


