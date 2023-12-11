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
            header("Location: ?controller=home");
        }
    }
}

?>