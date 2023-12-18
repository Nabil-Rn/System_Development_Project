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
        } elseif ($action == "create") {
            $this->render("Booking", $action);
        }
    }

    public function render($controller, $view, $data = []) {
        extract($data);
        include "Views/$controller/$view.php";
    }

    protected function userIsLoggedIn() {
        return isset($_SESSION['user']) && is_object($_SESSION['user']);
    }

    // MOVED NYLAS STUFF HERE
    public function fetchNylasData()
    {
        $accessToken = 'PTcBVppDmBLQOqQxIGUFnWXwA4bcAb';
        $url = 'https://api.schedule.nylas.com/manage/pages';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer ' . $accessToken,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            // Successful request, $response contains the JSON data
            echo $response;
        } else {
            // Handle errors or non-200 HTTP status codes
            echo "Failed to retrieve data. HTTP code: $httpCode";
        }

        curl_close($ch);
    }
}
?>
