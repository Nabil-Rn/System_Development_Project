<?php
session_start();
include_once __DIR__ . "/../Models/User.php";

class UserController {
    private $userModel;

    public function __construct() {
        global $conn;
        $this->userModel = new User($conn);
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['group_id'] = $user['group_id'];
                header('Location: ' . $this->getRedirectPage($_SESSION['group_id']));
                exit;
            } else {
                $_SESSION['login_error'] = "Invalid username or password";
                header('Location: ../Views/Home/index.php');
                exit;
            }
        }
    }
    
    
    private function connectToDatabase() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "justbfitness";

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    

    private function getRedirectPage($group_id) {
        switch ($group_id) {
            case 1:
                return '../Views/Client/index.php';
            case 2:
                return '../Views/Admin/index.php';
            default:
                return '../Views/Home/index.php';
        }
    }

    public function logout() {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        //change location to take you to the login page
        header('Location: login.php');
        exit;
    }

    public function register($fname, $lname, $email, $password, $group_id) {
        // Additional validation can be added here
        $userId = $this->model->register($fname, $lname, $email, $password, $group_id);

        if ($userId) {
            header("Location: index.php?controller=user&action=read&id=$userId");
            exit();
        } else {
            // Handle registration failure
        }
    }

    public function login($email, $password) {
        $user = $this->model->login($email, $password);
        if ($user) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            // Redirect to a different page or do something else upon successful login
            return true;
        } else {
            // Handle login failure
            return false;
        }
    }
}
/*

$controller->handleLogin();
*/
$controller = new UserController();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $controller->handleLogin();
}
?>
