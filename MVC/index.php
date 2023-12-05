<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



// Start the session
// Uncomment the line below once you've confirmed where the issue lies
// session_start();



require_once 'mysqldatabase.php';
require_once 'Models/User.php';
require_once 'Controllers/UserController.php';



// Instantiate the main controller
$userController = new UserController();



// Handle login and logout directly
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    echo "<p>Handling login...</p>";
    $userController->handleLogin();
}

if (isset($_GET['logout'])) {
    echo "<p>Handling logout...</p>";
    $userController->logout();
    exit;
}



// Dynamic controller routing
$controller = (isset($_GET['controller'])) ? $_GET['controller'] : "Home";
$action = (isset($_GET['action'])) ? $_GET['action'] : "index";
$id = (isset($_GET['id'])) ? intval($_GET['id']) : -1;

$controllerClassName = ucfirst($controller) . "Controller";
$controllerFilePath = "Controllers/$controllerClassName.php";

if (file_exists($controllerFilePath)) {
    include_once $controllerFilePath;

    $ct = new $controllerClassName();
    if (method_exists($ct, $action)) {
        $ct->$action($id);
    } else {
        echo "<p>Action method $action does not exist in $controllerClassName...</p>";
        // Handle the case where the action method doesn't exist
    }
} else {
    echo "<p>Controller file $controllerFilePath does not exist...</p>";
    // Handle the case where the controller file doesn't exist
}
?>
