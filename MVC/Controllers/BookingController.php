<?php

include_once "Models/Booking.php";
include_once "Models/User.php";

class BookingController {

    public function route() {
        $controller = $_GET['controller'];
        $action = isset($_GET['action']) ? $_GET['action'] : "list";
        $id = isset($_GET['id']) ? intval($_GET['id']) : -1;

        // Initialize the Booking model
        $bookingModel = new Booking();

        if ($this->userIsLoggedIn() && $action == "list") {
            $bookings = Booking::$action();
            $this->render($controller, $action, $bookings);
        }
    }

    public function render($controller, $view, $data = []) {
        extract($data);
        include "Views/$controller/$view.php";
    }

    protected function userIsLoggedIn() {
        return isset($_SESSION['user']) && is_object($_SESSION['user']);
    }
}
?>
