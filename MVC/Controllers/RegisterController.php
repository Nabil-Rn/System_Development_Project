<?php

class RegisterController {
    private $model;
    private $conn; // Database connection

    public function __construct($model) {
        $this->model = $model;
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
        if($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function showRegisterForm() {
        include('../Views/Home/register.php'); // Include the HTML form for registration
    }

    public function registerUser() {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            
            $userGroup = 'Client'; // Set the user group as Client

            $hashed_password = md5($password);

            $success = $this->model->saveUser($fname, $lname, $email, $hashed_password, $phone, $userGroup);

            if ($success) {
                echo "Registration successful. User is now a Client!";
            } else {
                echo "Registration failed. Please try again.";
            }
        }
    }
}

?>
