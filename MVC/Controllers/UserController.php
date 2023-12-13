<?php
include_once  "Models/User.php";

class UserController {

	function route(){

		$controller = $_GET['controller'];
		$action = (isset($_GET['action'])) ? $_GET['action'] : "index";
		$id = (isset($_GET['id'])) ? intval($_GET['id']) : -1;


        // Initialize the User model
        $userModel = new User();

        if ($action == "login") {
            if(isset($_SESSION['user'])){
                $this->loginCheck();
            }else{
                $users = User::login();
                $this->loginCheck();
            }

        } else if ($action == "register") {
            // testing
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
                $result = $userModel->register($firstName, $lastName, $phoneNumber, $email, $password, $confirmPassword);
                if ($result === true) {
                    // Registration successful
                    //$this->render("User", "index");
                    header("Location: ?controller=home");
                    //header("Location: ?controller=user&action=login"); // Redirect to login page
                } else {
                    // Registration failed, show error
                    $this->render("User", "register", array('error' => $result));
                }
            } else {
                // Show registration form
                $this->render("User", "register");
            }

        } else if ($action == "list") {
            $users = User::$action();
            $this->render("User", $action, $users);

        } else if ($action == "update" || $action == "delete") {
            $result = $userModel->$action($id);
        } else if ($action == "logout") {
            $users = User::$action();
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Location: ?controller=home");



        }  /*else {
            $user = new User($id);
            $this->render("User", $action, array('user' => $user));
        }*/
    }

    function render($controller, $view, $data = []) {
        if($data != null){
            extract($data);
            include "Views/$controller/$view.php";
        }else{
            include "Views/$controller/$view.php";
        }
    }

    function loginCheck() {
        if(isset($_SESSION['user'])){
            //check group ID!
            if($_SESSION['user']->group_id == 1){
                $this->render("Client", "index");

            }else if($_SESSION['user']->group_id == 2){
                $this->render("Admin","index");
            }
        }else{
            //not logged in
            header("Location: ?controller=home");
        }
    }
}

?>