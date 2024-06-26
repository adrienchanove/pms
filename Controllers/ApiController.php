<?php

/**
 * Api Controller
 * ApiController
 * 
 */
class ApiController
{



    /**
     * Authentification
     */
    public function Auth_login()
    {
        if (Auth::isLogged()) {
            echo json_encode(['error' => false, 'errorMessages' => ['User already logged']]);
            return;
        }
        // get POST data
        $error = [
            'errorMessages' => [],
            'error' => false
        ];

        // check if data is posted
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // get data
            $username = $_POST['username'];
            $password = $_POST['password'];

            // sanitize data
            $username = htmlspecialchars(strip_tags($username));
            $password = htmlspecialchars(strip_tags($password));

            // check if data is valid
            if (empty($username)) {
                $error['error'] = true;
                $error['errorMessages'][] = 'Username is required';
            }

            if (empty($password)) {
                $error['error'] = true;
                $error['errorMessages'][] = 'Password is required';
            }

            // check if no error
            if (!$error['error']) {
                // check if user exists


                // check if user exists
                if (Auth::login($username, $password)) {

                    // No error
                    $error['error'] = false;
                    $error['errorMessages'][] = 'Login success';
                } else {
                    // Error message User not found
                    $error['error'] = true;
                    $error['errorMessages'][] = 'Login failed';
                }
            }
        } else {
            // Error message Invalid request
            $error['error'] = true;
            $error['errorMessages'][] = 'Invalid request';
            $error['receivedPost'] = $_POST;
        }
        echo json_encode($error);
    }

    /**
     * Logout
     */
    public function Auth_logout()
    {
        // destroy session
        $_SESSION = [];
        session_destroy();
        echo json_encode(['error' => false, 'errorMessages' => ['Logout success']]);
    }
    /**
     * Get user
     */
    public function Auth_getUser()
    {
        // check if user is logged
        if (Auth::isLogged()) {
            // get user
            $user = User::getById($_SESSION['user_id']);
            echo json_encode($user);
        } else {
            echo json_encode(['error' => true, 'errorMessages' => ['User not logged']]);
        }
    }

    /**
     * Get all users
     */
    public function Auth_getAllUsers()
    {
        // check if user is logged
        if (Auth::isLogged()) {
            // get all users
            $users = User::getAll();
            echo json_encode($users);
        } else {
            echo json_encode(['error' => true, 'errorMessages' => ['User not logged']]);
        }
    }

    // Bookings
    /**
     * Get all Bookings who are now
     */
    public function bookings_get_now()
    {
        // get all bookings
        $bookings = Booking::getAll();
        $filteredBookings = [];
        foreach ($bookings as $booking) {
            if ($booking->startDate == date('Y-m-d') || $booking->endDate == date('Y-m-d')) {
                $filteredBookings[] = $booking;
            }
        }
        // get house for each booking
        foreach ($filteredBookings as $booking) {
            $house = Housing::getById($booking->idHousing);
            $booking->house = $house;
        }
        echo json_encode($filteredBookings);
    }

    /**
     * Get booking by id
     */
    public function booking_get($params)
    {
        // get booking
        $booking = Booking::getById($params['id']);
        // get house
        $house = Housing::getById($booking->idHousing);
        $booking->house = $house;
        echo json_encode($booking);
    }

    /**
     * Get all bookings
     */
    public function bookings_get_all()
    {
        // get all bookings
        $bookings = Booking::getAll();
        // get house for each booking
        foreach ($bookings as $booking) {
            $house = Housing::getById($booking->idHousing);
            $booking->house = $house;
        }
        echo json_encode($bookings);
    }
}
