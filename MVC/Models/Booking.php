<?php

include_once "mysqldatabase.php";

class Booking {
    // Set your Nylas Scheduler API credentials and endpoint
    //$accessToken = 'YOUR_ACCESS_TOKEN';
    //$schedulerId = 'YOUR_SCHEDULER_ID';
    //$apiUrl = "https://api.nylas.com/schedule/$schedulerId/bookings";

    public $booking_id;
    public $booking_date;
    public $appointment_date;
    public $timeslot_id;
    public $user_id;

    public function __construct($id = -1) {
        global $conn;

        // Initialize default values
        $this->booking_id = -1;
        $this->booking_date = null;
        $this->appointment_date = null;
        $this->timeslot_id = null;
        $this->user_id = null;

        // Load booking data if a valid ID is provided
        if ($id > 0) {
            // Fetch booking details from the database
            $sql = "SELECT * FROM `booking` WHERE booking_id = ?";
            $stmt = $conn->prepare($sql);

            // Check if the prepared statement was successful
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param('i', $id);
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
            }
        }
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

    public function getAPIjson(){
        // Set your Nylas Scheduler API credentials and endpoint
        $accessToken = 'PTcBVppDmBLQOqQxIGUFnWXwA4bcAb';
        $schedulerId = '';
        $apiUrl = "https://api.nylas.com/schedule/$schedulerId/bookings";
        // Set up cURL
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ]);

        // Make the API call to retrieve booking information
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            // Successfully fetched data
            $bookings = json_decode($response, true);

            // Process and work with the $bookings array
            global $conn;
            foreach ($bookings as $booking) {
                // Process $booking data and construct your SQL query for insertion
                $startTime = $booking['start_time'];
                $endTime = $booking['end_time'];
                $startTime = $booking['start_time'];
                $endTime = $booking['end_time'];
                $bookingId = $booking['id'];
                $status = $booking['status'];
                    // Access other fields as needed...
               
                // ... extract other necessary fields
                
                // Example SQL INSERT query
                $sql = "INSERT INTO bookings_table (start_time, end_time, other_field) VALUES ('$startTime', '$endTime', 'other_value')";
                
                // Execute the query
                if ($mysqli->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
            }
            
            $mysqli->close();
        } else {
            // Error handling if the API call fails
            echo "Failed to retrieve bookings. HTTP code: $httpCode";
        }

        // Close cURL session
        curl_close($ch);

    }

    // MOVED NYLAS STUFF HERE
    public function addNylasDataToDatabase($jsonData) {
        // Process $jsonData and insert into your database
        // Perform database operations (e.g., insert into a specific table)
        // $jsonData contains the JSON data retrieved from Nylas API

        // Example code for database insertion (using PDO)
        $db = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $stmt = $db->prepare("INSERT INTO your_table (json_data) VALUES (:json)");
        $stmt->bindParam(':json', $jsonData);
        $stmt->execute();
    }


}


?>



