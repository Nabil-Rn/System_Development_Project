<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    include_once "mysqldatabase.php";

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
    public $database;

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
        $this->database = "justbfitness";

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
                $this->database = "justbfitness";

                $stmt->close();
            }
        }
    }

    public static function login() {
        global $conn;
        $sql = "SELECT * FROM user WHERE email = '". $_POST['email'] . "' ";
        //var_dump($sql);
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
            /*
            $group_id = $_SESSION['user']->group_id; 
            if ($group_id === 1) {
                header("Location: ?controller=user&action=index"); 
            } else if ($group_id === 2) {
                header("Location: ?controller=user"); 
            }
            */
            
            header("Location: ?controller=user"); // ADDED
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

    public static function generateRandomCode($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }

    public static function sendEmail( $email){
        $mail = new PHPMailer(true);
        $_SESSION['randomCode'] = self::generateRandomCode();
        $_SESSION['email'] = $email;
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'duckdolphin1@gmail.com';
            $mail->Password   = 'nxdwnindksrmhdiq';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipient
            $mail->setFrom('JUSTBFITNESS@gmail.com', 'JUSTBFITNESS');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation Code!';
            $mail->Body    = 'Your confirmation code is: ' . $_SESSION['randomCode'];

            $mail->send();
            echo "<script> alert('Email sent successfully'); </script>";
        } catch (Exception $e) {
            echo "Error: {$mail->ErrorInfo}";
        }


    }

    public static function confirmCode(){
        $enteredCode = $_POST['code'];

        if ($enteredCode == $_SESSION['randomCode']) {
            echo "<script>alert('Code is valid. Email confirmed!');</script>";
            return true;
        } else {
            // Code is incorrect
            return false;
        }
    }

    public static function changePassword($password){
        global $conn;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION['email'];

        $sql = 'UPDATE `user` SET password = ? WHERE email = ?';
        $stmt = $conn->prepare($sql);

        // Check if the prepared statement was successful
        if (!$stmt) {
            return 0;
        }

        $stmt->bind_param('ss',$hashedPassword, $email);
        $stmt->execute();

        if ($stmt->errno) {
            $stmt->close();
            return 0;
        }

        $stmt->close();
    }
    
    public static function search(){
        global $conn;

        $lookupTerm = isset($_POST['query']) ? $_POST['query'] : '';
        if (!empty($lookupTerm)) {
            $sql = "SELECT * FROM `user` WHERE (`fname` LIKE ? OR `lname` LIKE ?) AND `group_id` = 1";
            $stmt = $conn->prepare($sql);
            $lookupTerm = "%$lookupTerm%";
            $stmt->bind_param('ss', $lookupTerm, $lookupTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result->num_rows > 0) {
                $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }

                return $rows;
            }
        }

        return null;
    }

    public static function listByQuery() {
        global $conn;
    
        $lookupTerm = isset($_POST['query']) ? $_POST['query'] : '';
    
        // Use a placeholder for the condition in the WHERE clause
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
                    `GROUP` ON USER.GROUP_ID = `GROUP`.GROUP_ID
                WHERE
                    USER.FNAME LIKE ? OR
                    USER.LNAME LIKE ? OR
                    USER.EMAIL LIKE ?';
    
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }
    
        // Bind the parameters to the placeholders
        $searchTerm = "%$lookupTerm%";
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Fetch all rows into an associative array
        $data = $result->fetch_all(MYSQLI_ASSOC);
    
        // Close the statement
        $stmt->close();
    
        return $data;
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
                    `GROUP` ON USER.GROUP_ID = `GROUP`.GROUP_ID
                WHERE
                    USER.GROUP_ID = 1';
    
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
    
    
    public static function read() {
        global $conn;
    
        // Check if user ID is present in the session
        $userId = isset($_SESSION['user']) ? $_SESSION['user']->user_id : null;
    
        $sql = "SELECT * FROM `USER` WHERE USER_ID = ?";
        $stmt = $conn->prepare($sql);
    
        // Check if the prepared statement was successful
        if (!$stmt) {
            return null; // or handle the error as needed
        }
    
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Fetch the result and store it in a variable
        $user = $result->fetch_assoc();
    
        // Close the statement
        $stmt->close();
    
        // Store user data in the session
        $_SESSION['user']->fname = $user['fname'];
        $_SESSION['user']->lname = $user['lname'];
        $_SESSION['user']->age = $user['age'];
        $_SESSION['user']->gender = $user['gender'];
        $_SESSION['user']->weight = $user['weight'];
        $_SESSION['user']->weight_unit = $user['weight_unit'];
        $_SESSION['user']->height = $user['height'];
        $_SESSION['user']->height_unit = $user['height_unit'];
        $_SESSION['user']->email = $user['email'];
        $_SESSION['user']->phone = $user['phone'];
        $_SESSION['user']->password = $user['password'];
        $_SESSION['user']->additional_note = $user['additional_note'];
    
        // Return the fetched result
        return $user;
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
    

    public static function logout() {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Set additional headers to prevent caching
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');

        header("Location: index.php?controller=home");
        exit();
    }


public static function update() {
    global $conn;

    if (isset($_POST['update'])) {
        $userId = isset($_SESSION['user']) ? $_SESSION['user']->user_id : null;

        // Check if the user ID is set
        if ($userId === null) {
            return 0;
        }

        // Retrieve updated user information from the POST data
        $fname = isset($_POST['fname']) ? $_POST['fname'] : null;
        $lname = isset($_POST['lname']) ? $_POST['lname'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        $age = isset($_POST['age']) ? $_POST['age'] : null;
        $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
        $weight = isset($_POST['weight']) ? $_POST['weight'] : null;
        $weightUnit = isset($_POST['weightUnit']) ? $_POST['weightUnit'] : null;
        $height = isset($_POST['height']) ? $_POST['height'] : null;
        $heightUnit = isset($_POST['heightUnit']) ? $_POST['heightUnit'] : null;
        $additionalNote = isset($_POST['note']) ? $_POST['note'] : null;

        // Check if required fields are set
        if ($fname === null || $lname === null || $email === null || $password === null) {
            return 0;
        }

        // Hash the password before updating (consider using a proper password hashing function)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update user information in the database
        $sql = 'UPDATE `user` SET fname = ?, lname = ?, email = ?, password = ?, phone = ?, age = ?, gender = ?, weight = ?, weight_unit = ?, height = ?, height_unit = ?, additional_note = ? WHERE user_id = ?';
        $stmt = $conn->prepare($sql);

        // Check if the prepared statement was successful
        if (!$stmt) {
            return 0;
        }

        $stmt->bind_param('ssssssssssssi', $fname, $lname, $email, $hashedPassword, $phone, $age, $gender, $weight, $weightUnit, $height, $heightUnit, $additionalNote, $userId);
        $stmt->execute();

        if ($stmt->errno) {
            $stmt->close();
            return 0;
        }

        $stmt->close();

        // Redirect to the user profile page after successful update
        header("Location: ?controller=user&action=read");
        exit();
    }

    return false;
}

public static function delete() {
    global $conn;

    // Check if user ID is present in the session
    $userId = isset($_SESSION['user']) ? $_SESSION['user']->user_id : null;

    // Check if the 'deleteAccount' key is present in the $_POST array
    if (isset($_POST['delete'])) {
        // Validate user ID
        if (!$userId) {
            die('Error: User ID not available. Please log in.');
        }

        // Prepare and execute the SQL query to delete the user account
        $sql = 'DELETE FROM USER WHERE USER_ID = ?';
        $stmt = $conn->prepare($sql);

        // Check for errors in preparing the statement
        if (!$stmt) {
            die('Error preparing statement: ' . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        // Check for errors in executing the statement
        if ($stmt->error) {
            // Handle the error (e.g., display an error message or redirect to an error page)
            die('Error executing statement: ' . $stmt->error);
        }

        // Close the statement
        $stmt->close();

        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        // Empty cache
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Set additional headers to prevent caching
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');

        // Redirect to the home page after successful account deletion
        header('Location: ?controller=home');
        exit();
    }

    // Return false if the 'deleteAccount' key is not present in the $_POST array
    return false;
}

public static function deleteClient() {
    global $conn;

    $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;

    // Check if the 'delete' key is present in the $_POST array
    if (isset($_POST['deleteClient'])) {
        // Validate user ID
        if (!$userId) {
            die('Error: User ID not available. Please log in.');
        }

        // Prepare and execute the SQL query to delete the user account
        $sql = 'DELETE FROM `user` WHERE `user_id` = ?';
        $stmt = $conn->prepare($sql);

        // Check for errors in preparing the statement
        if (!$stmt) {
            die('Error preparing statement: ' . $conn->error);
        }

        // Bind parameters and execute the statement
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        // Check for errors in executing the statement
        if ($stmt->error) {
            // Handle the error (e.g., display an error message or redirect to an error page)
            die('Error executing statement: ' . $stmt->error);
        }

        // Redirect to the home page after successful account deletion
        header('Location: ?controller=user&action=list');
        exit();
    }

    // Return false if the 'delete' key is not present in the $_POST array
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
    
    public function printTables() {
        global $conn;
    
        // Validate the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $sql = "SHOW TABLES FROM " . $this->database;
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tableName = $row["Tables_in_" . $this->database];
                $tableData = $this->getTableData($tableName);
    
                echo "<h3>Table: $tableName</h3>";
    
                if (empty($tableData)) {
                    echo "<p>No data available</p>";
                } else {
                    echo "<table border='1'>";
                    echo "<tr>";
                    // Display table headers
                    foreach (array_keys($tableData[0]) as $column) {
                        echo "<th>$column</th>";
                    }
                    echo "</tr>";
    
                    // Display table data
                    foreach ($tableData as $rowData) {
                        echo "<tr>";
                        foreach ($rowData as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
    
                    echo "</table>";
                }
    
                echo "<br>";
            }
        } else {
            echo "<p>No tables found in the database</p>";
        }
    
        $conn->close();
    }
    
    // Move getTableData outside printTables
    private function getTableData($tableName) {
        global $conn;
    
        // Validate the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Wrap the table name with backticks to handle reserved keywords
        $sql = "SELECT * FROM `" . $tableName . "`";
        $result = $conn->query($sql);
        $tableData = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tableData[] = $row;
            }
        }
    
        return $tableData;
    }
    

}
    

?>


