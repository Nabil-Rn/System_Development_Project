<?php
include_once "Models/User.php";
include_once "Models/Booking.php";

class UserController {

    function route() {
        $controller = $_GET['controller'];
        $action = isset($_GET['action']) ? $_GET['action'] : "index";
        $id = isset($_GET['id']) ? intval($_GET['id']) : -1;

        // Initialize the User model
        $userModel = new User();

        // Initialize the Booking model (for Client index.php)
        $bookingModel = new Booking();

        if ($action == "login") {
            if (isset($_SESSION['user'])) {
                $this->loginCheck();
            } else {
                $users = User::login();
                $this->loginCheck();
            }
        } else if ($action == "register") {
            // Handle registration process
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Collect user input data
                $firstName = $_POST['fname'];
                $lastName = $_POST['lname'];
                $phoneNumber = $_POST['phone'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['re-password'];

                // Validate input data and register user
                $passwordValidationResult = $this->validatePassword($password);
                if ($passwordValidationResult === true) {
                    $result = $userModel->register($firstName, $lastName, $phoneNumber, $email, $password, $confirmPassword);
                    if ($result === true) {
                        // Registration successful
                        // Redirect to login page
                        header("Location: ?controller=home");
                    } else {
                        // Registration failed
                        $this->render("Home", "register");
                        // Show error
                    }
                } else {
                    // Password validation failed
                    $this->render("Home", "register", array('error' => $passwordValidationResult));
                }
            } else {
                // Show registration form
                $this->render("User", "register");
            }
        } else if ($action == "forgotpassword") {
                $email = $_POST['email'];
                $users = User::sendEmail( $email);
                $this->render("Home", "confirmCode");

        }else if ($action == "confirm") {
            $code = $_POST['code'];
            $confim = User::confirmCode( $code);
                $confirm = User::confirmCode($code);
                if ($confirm == true) {
                    $this->render("Home", "changePassword");
                }else{
                    $this->render("Home", "confirmCode");
                }
        }else if ($action == "changepassword") {
            $password = $_POST['password'];
            $users = User::changePassword( $password);
            header("Location: ?controller=home");

        }else if ($action == "list") {
            if ($_SESSION['user']->group_id == 2) {
                $users = User::$action();
                $this->render("Admin", $action, $users);
            }
        } else if ($action == "search") {
            $users = $userModel->$action();

            if (!empty($users)) {
                $users = User::listByQuery();
                $this->render("Admin", $action, $users);
            } else {
                $this->render("Admin", $action, array());
            }
        } else if ($action == "read") {
            $user = User::$action();
            if ($_SESSION['user']->group_id == 1) {
                $this->render("Client", $action, ['user' => $user]);
            } else if ($_SESSION['user']->group_id == 2) {
                $this->render("Admin", $action, ['user' => $user]);
            }
        } else if ($action == "update" || $action == "delete" || $action == "deleteClient") {
            $result = $userModel->$action($id);
        } else if ($action == "logout") {
            $users = User::$action();
        } else if ($action == "print"){
            $userModel->printTables();
        } else {
            $user = new User($id);
            if ($_SESSION['user']->group_id == 1) {
                $this->render("Client", $action, ['user' => $user]);
            } else if ($_SESSION['user']->group_id == 2) {
                $this->render("Admin", $action, ['user' => $user]);
            }else{
                header("Location: ?controller=home");
            }
        }
    }

     function render($controller, $view, $data = []) {
        extract($data);
        include "Views/$controller/$view.php";
    }


    function loginCheck() {
        if (isset($_SESSION['user'])) {
            // Check group ID
            if ($_SESSION['user']->group_id == 1) {
                //$booking= Booking::$list();
                $this->render("Client", "index");
            } else if ($_SESSION['user']->group_id == 2) {
                $this->render("Admin", "index");
            }
        } else {
            // Not logged in
            header("Location: ?controller=home");
        }
    }

    function validatePassword($password) {
        // Check if password is seven characters long with one capital letter and one number
        if (strlen($password) < 7) {
            return "Password must be at least seven characters long.";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            return "Password must contain at least one capital letter.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            return "Password must contain at least one number.";
        }

        return true; // Password is valid
    }
}
?>
