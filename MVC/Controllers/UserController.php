<?php
session_start();
include_once __DIR__ . "/../Models/User.php";

class UserController {
    private $conn;

    public function __construct() {
        $this->conn = $this->connectToDatabase();
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

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User($this->conn);
            $isLoggedIn = $user->login($email, $password);

            if ($isLoggedIn) {
                header('Location: ' . $this->getRedirectPage($_SESSION['group_id']));
                exit;
            } else {
                $_SESSION['login_error'] = "Invalid username or password";
                header('Location: ../Views/Home/index.php');
                exit;
            }
        }
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
}

$controller = new UserController();
$controller->handleLogin();
?>
