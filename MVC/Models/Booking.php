<?php

include_once "mysqldatabase.php";

class Booking {

    public $booking_id;
    public $booking_date;
    public $appointment_date;
    public $timeslot_id;
    public $user_id;

    private $conn;

    public function __construct($conn, $booking_id = -1) {
        $this->conn = $conn;

        if ($booking_id > 0) {
            $this->loadBookingData($booking_id);
        } else {
            $this->initializeDefaultValues();
        }
    }

    private function loadBookingData($booking_id) {
        // Prepare the SQL statement to fetch booking data
        $stmt = $this->conn->prepare("SELECT * FROM `booking` WHERE booking_id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->conn->error);
        }

        // Bind the booking ID parameter and execute the query
        $stmt->bind_param('i', $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a booking was found
        if ($result->num_rows > 0) {
            $assocBooking = $result->fetch_assoc();

            // Populate the object's properties with the fetched data
            $this->booking_id = $assocBooking['booking_id'];
            $this->booking_date = $assocBooking['booking_date'];
            $this->appointment_date = $assocBooking['appointment_date'];
            $this->timeslot_id = $assocBooking['timeslot_id'];
            $this->user_id = $assocBooking['user_id'];

            $stmt->close();
        } else {
            // If no booking is found
            $this->initializeDefaultValues();
        }
    }

    private function initializeDefaultValues() {
        $this->booking_id = -1;
        $this->booking_date = null;
        $this->appointment_date = null;
        $this->timeslot_id = null;
        $this->user_id = null;
    }

    public static function list() {
        global $conn;

        $groupId = isset($_SESSION['group_id']) ? $_SESSION['group_id'] : null;
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if ($groupId == 1) {
            // For Client View For Bookings (group_id = 1)

            $sql = 'SELECT
                b.BOOKING_ID,
                b.BOOKING_DATE,
                b.APPOINTMENT_DATE,
                CONCAT(t.TIMESLOT_START, " - ", t.TIMESLOT_END) AS SESSION_TIME
            FROM
                BOOKING b
            JOIN TIMESLOTS t ON b.TIMESLOT_ID = t.TIMESLOT_ID
            JOIN USER u ON b.USER_ID = u.USER_ID
            WHERE
                b.USER_ID = ?';

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $_SESSION['user_id']);
        } else {
             // For Admin View For Bookings (group_id = 2)
            $sql = 'SELECT
                b.USER_ID,
                b.BOOKING_ID,
                b.BOOKING_DATE,
                b.APPOINTMENT_DATE,
                CONCAT(u.FNAME, " ", u.LNAME) AS FULL_NAME,
                CONCAT(t.TIMESLOT_START, " - ", t.TIMESLOT_END) AS SESSION_TIME
            FROM
                BOOKING b
            JOIN TIMESLOTS t ON b.TIMESLOT_ID = t.TIMESLOT_ID
            JOIN USER u ON b.USER_ID = u.USER_ID';

            $stmt = $conn->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        // Check if fetch_all is available
        if (method_exists($result, 'fetch_all')) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // If fetch_all is not available, fetch row by row
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        // Close the statement
        $stmt->close();

        return $data;
    }


    // Additional methods related to booking operations can be added here

}

?>
