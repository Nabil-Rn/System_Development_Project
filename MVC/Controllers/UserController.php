<?php

//*To modify: I'm starting to consider two different controllers for admin and client using the same User Model
//*Need consult team for this to make sure we're in the same page

include_once __DIR__ . "/../Models/User.php";

class UserController {

	function route(){

		$controller = $_GET['controller'];
		$action = (isset($_GET['action'])) ? $_GET['action'] : "index";
		$id = (isset($_GET['id'])) ? intval($_GET['id']) : -1;


        // Initialize the User model
        $userModel = new User();

        if ($action == "login") {
            $users = User::login();
            //check group ID!
            if($_SESSION['user']->group_id == 1){
                $this->render("Client", "index", $users);

            }else if($_SESSION['user']->group_id == 2){
                $this->render("Admin","index", $users);
            }
        } else if ($action == "list") {
            $users = User::$action();
            $this->render("User", $action, $users);
        } else if ($action == "create" || $action == "update" || $action == "delete") {
            $result = $userModel->$action();
        } else {
            $user = new User($id);
            $this->render("User", $action, array('user' => $user));
        }
    }

    function render($controller, $view, $data = []) {
        if($data != null){
            extract($data);
            include "Views/$controller/$view.php";
        }else{
            include "Views/$controller/$view.php";
        }
        /*
            include "Views/Client/$view.php"; // Client
            include "Views/Admin/$view.php"; //Admin
        */
    }
}

?>