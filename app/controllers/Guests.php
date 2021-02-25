<?php
    class Guests extends Controller {

        // Init model var
        private $guestModel;
        private $roomModel;

        public function __construct()
        {
            // Load models
            $this->guestModel = $this->model('Guest');
            $this->roomModel = $this->model('Room');
            $this->reservationModel = $this->model('Reservation');

            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            } 
        }

        // Default method
        public function index()
        {
            // Fetch booked rooms
            $rooms = $this->roomModel->getRoomByStatus('booked');

            // Init data
            $data = [
                'rooms' => $rooms
            ];

            // Load view
            $this->view('guests/index', $data);
        }

        // View booking details by room number
        public function room($roomNumber) 
        {
            // Get guest details
            $guest = $this->guestModel->getBookingDetails($roomNumber);

            // Fetch booked rooms
            $rooms = $this->roomModel->getRoomByStatus('booked');

            // Init data
            $data = [
                'guest' => $guest,
                'rooms' => $rooms
            ];

            // Load view
            $this->view('guests/room', $data, $roomNumber);
        }

        // Check in guest
        public function checkin()
        {
            // Date today
            $dateToday = date('Y-m-d');

            // Fetch available rooms
            $rooms = $this->roomModel->getRoomByStatus('available');

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Data values
                $data = [
                    'room_number' => trim($_POST['room_number']),
                    'full_name' => trim($_POST['full_name']),
                    'address' => trim($_POST['address']),
                    'phone_number' => trim($_POST['phone_number']),
                    'email' => trim($_POST['email']),
                    'check_in_date' => date('Y-m-d', strtotime(trim($_POST['check_in_date']))),
                    'check_out_date' => date('Y-m-d', strtotime(trim($_POST['check_out_date']))),
                    'notes' => trim($_POST['notes']),
                    'checked_in_by' => $_SESSION['user_id'],
                    'rooms' => $rooms,
                    'room_number_err' => '',
                    'full_name_err' => '',
                    'address_err' => '',
                    'phone_number_err' => '',
                    'email_err' => '',
                    'check_in_date_err' => '',
                    'check_out_date_err' => '',
                    'notes_err' => '',
                    'checked_in_by_err' => '',
                ];

                // Validate room number
                if(empty($data['room_number'])) {
                    $data['room_number_err'] = 'The room number field is required.';
                } 

                // Validate guest name
                if(empty($data['full_name'])) {
                    $data['full_name_err'] = 'The name field is required.';
                }

                // Validate guest address
                if(empty($data['address'])) {
                    $data['address_err'] = 'The address field is required.';
                }

                // Validate guest phone number
                if(empty($data['phone_number'])) {
                    $data['phone_number_err'] = 'The phone number field is required.';
                }

                // Validate guest email
                if(empty($data['email'])) {
                    $data['email_err'] = 'The email field is required.';
                }

                // Validate check in date
                if(empty($data['check_in_date'])) {
                    $data['check_in_date_err'] = 'The check in date is required.';
                } elseif(!empty($data['check_in_date'])) {
                    if(($data['check_in_date'] < $dateToday) || ($data['check_in_date'] >= $data['check_out_date'])) {
                        $data['check_in_date_err'] = 'Invalid check in date.';
                    } 
                }

                // Validate check out date
                if(empty($data['check_out_date'])) {
                    $data['check_out_date_err'] = 'The check out date is required.';
                } elseif(!empty($data['check_out_date'])) {
                    if(($data['check_out_date'] <= $data['check_in_date']) || ($data['check_out_date'] <= $dateToday)) {
                        $data['check_out_date_err'] = 'Invalid check out date.';
                    } 
                }

                // Validate check in notes
                if(empty($data['notes'])) {
                   $data['notes_err'] = 'The notes field is required.';
                }

                // Validate checked in by
                if(empty($data['checked_in_by'])) {
                    $data['checked_in_by_err'] = 'The checked in by field is required.';
                }
                
                // Make sure errors are empty
                if(empty($data['room_number_err']) && empty($data['full_name_err']) && empty($data['address_err']) && empty($data['phone_number_err']) && empty($data['email_err']) && empty($data['check_in_date_err']) && empty($data['check_out_date_err']) && empty($data['notes_err']) && empty($data['checked_in_by_err'])) {
                    if($this->guestModel->checkInGuest($data)) {
                        // If check in date is higher than date today insert as reservation
                        if($data['check_in_date'] > $dateToday) {
                                // Insert data as confirmed reservation
                                $guest = $this->guestModel->getBookingDetails($data['room_number']);

                                // Reservation details
                                $data = [
                                    'guest' => $guest->id,
                                    'status' => 'confirmed'
                                ];

                                // Create reservation
                                if($this->reservationModel->createReservation($data)) {
                                    // Inserted as reservations
                                    die('reservation created');
                                } else {
                                    // Something is wrong
                                }
                        } else {
                            // Change room status to booked
                            $this->roomModel->updateRoomStatus('booked', $data['room_number']);
                            // Success
                            flash('feedback', 'Guest has been checked in.');
                            redirect('guests/checkin');
                        }
                    }
                } else {
                    // Load view with errors
                    $this->view('guests/checkin', $data);
                }   
            } else {
                // Load form
                // Init data
                $data = [
                    'room_number' => '',
                    'full_name' => '',
                    'address' => '',
                    'phone_number' => '',
                    'email' => '',
                    'check_in_date' => '',
                    'check_out_date' => '',
                    'notes' => '',
                    'checked_in_by' => '',
                    'rooms' => $rooms,
                    'room_number_err' => '',
                    'full_name_err' => '',
                    'address_err' => '',
                    'phone_number_err' => '',
                    'email_err' => '',
                    'check_in_date_err' => '',
                    'check_out_date_err' => '',
                    'notes_err' => '',
                    'checked_in_by_err' => '',
                ];

                // Load view
                $this->view('guests/checkin', $data);
            }
            
        }

        // Guest arrivals
        public function arrivals()
        {
            // Join reservations and guests table
            $guests = $this->reservationModel->getGuestsWithConfirmedReservation();

            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/arrivals', $data);
        }

        // Guest arrivals today
        public function arrivals_today()
        {
            // Join reservations and guests table
            $guests = $this->reservationModel->sortCheckInDay();
            
            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/arrivals_today', $data);
        }

        // Guest arrivals today
        public function arrivals_week()
        {
            // Join reservations and guests table
            $guests = $this->reservationModel->sortCheckInWeek();
            
            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/arrivals_week', $data);
        }

        // Guest arrivals today
        public function arrivals_month()
        {
            // Join reservations and guests table
            $guests = $this->reservationModel->sortCheckInWeek();
            
            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/arrivals_month', $data);
        }

        // Guest departures
        public function departures()
        {

            // Join reservations and guests table
            $guests = $this->reservationModel->getGuestsWithConfirmedReservation();

            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/departures', $data);
        }

        // Guest departures today
        public function departures_today()
        {
            // Join reservations and guests table
            $guests = $this->reservationModel->sortCheckOutDay();
            
            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/departures_today', $data);
        }

        // Guest arrivals today
        public function departures_week()
        {
            // Join reservations and guests table
            $guests = $this->reservationModel->sortCheckOutWeek();
            
            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/departures_week', $data);
        }

        // Guest arrivals today
        public function departures_month()
        {
            // Join reservations and guests table
            $guests = $this->reservationModel->sortCheckOutWeek();
            
            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/departures_month', $data);
        }

    }