<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once '../Models/User.php';

class RegisterController {
    
    private $conn; // Database connection

    public function __construct() {
        $this->conn = $this->connectToDatabase(); // Establish the database connection
    }

    private function connectToDatabase() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "justbfitness";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function showRegisterForm() {
        include('../Views/Home/register.php'); // Include the HTML form for registration
    }

    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];

            $group = '1'; // Assuming '1' is a valid group ID (as an integer)

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            if ($hashedPassword === false) {
                // Password hashing failed
                $_SESSION['registration_error'] = "Password hashing failed";
                //header('Location: ../Views/Home/register.php');
                exit;
            }

            $query = "INSERT INTO USER (FNAME, LNAME, EMAIL, PASSWORD, PHONE, GROUP_ID) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssssi", $fname, $lname, $email, $hashedPassword, $phone, $group);

            if ($stmt->execute()) {
                $_SESSION['registration_success'] = "Registration successful!";
                header('Location: ../Views/Home/index.php');
                exit;
            } else {
                $_SESSION['registration_error'] = "Error: " . $stmt->error;
                //header('Location: ../Views/Home/register.php');
                exit;
            }

            $stmt->close();
        } else {
            //header('Location: ../Views/Home/register.php');
            exit;
        }
    }
}

 $controller = new RegisterController();
 $controller->registerUser();

?>
