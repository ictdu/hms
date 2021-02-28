<?php
    class Guests extends Controller {

        // Init model var
        private $guestModel;
        private $roomModel;
        private $reservationModel;
        private $invoiceModel;
        private $categoryModel;
        private $checkoutModel;

        public function __construct()
        {
            // Load models
            $this->guestModel = $this->model('Guest');
            $this->roomModel = $this->model('Room');
            $this->reservationModel = $this->model('Reservation');
            $this->invoiceModel = $this->model('Invoice');
            $this->categoryModel = $this->model('Category');
            $this->checkoutModel = $this->model('Checkout');

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
            date_default_timezone_set('Asia/Hong_Kong');
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
                } elseif(!empty($data['room_number']) && !$this->roomModel->findRoomByNumber($data['room_number'])) {
                    $data['room_number_err'] = 'The room does not exists.';
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
                
                // Check if date is already booked
                $guests = $this->guestModel->getAllBookingDetails($data['room_number']);
                foreach($guests as $guest) {
                    if(($data['check_in_date'] >= $guest->check_in_date) && ($data['check_in_date'] <= $guest->check_out_date)) {
                        $data['check_in_date_err'] = 'The date is already booked.';
                        $data['check_out_date_err'] = 'The date is already booked.';
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
                        // Get guest details by ID
                        $guest = $this->guestModel->getBookingDetails($data['room_number']);
                        // Get room details by room number
                        $room = $this->roomModel->getRoomDetailsByNumber($data['room_number']);
                        // Get room category details by name
                        $category = $this->categoryModel->getCategoryByName($room->category);

                        // Calculate number of days guest have been checked in
                        $checkInDate = date_create($data['check_in_date']);
                        $checkOutDate = date_create($data['check_out_date']);
                        $difference = date_diff($checkInDate, $checkOutDate);
                        // Calculate payable amount
                        // Number Of Days X Room Category Rate
                        $balance = $difference->days * $category->rate;

                        // If check in date is higher than date today, insert record as a confirmed reservation
                        if($data['check_in_date'] > $dateToday) {
                            // Data values
                            $data = [
                                'guest' => $guest->id,
                                'status' => 'confirmed'
                            ];
                            
                            if($this->reservationModel->createReservation($data)) {
                                // Generate Invoice
                                $this->invoiceModel->generateInvoice($data = [
                                    'number' => rand(100000, 999999),
                                    'guest_id' => $guest->id,
                                    'balance' => $balance
                                ]);

                                // Record inserted as a reservation (Success)
                                flash('feedback', 'A reservation has been created.');
                                redirect('guests/checkin');
                            }
                        } else {
                            // Change room status to booked
                            $this->roomModel->updateRoomStatus('booked', $data['room_number']);
                            // Record inserted as a booking (Success)
                            flash('feedback', 'Guest has been booked successfully.');
                            redirect('guests/checkin');
                        }
                    } else {
                        // Something went wrong
                        die('Inserting record failed.');
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

        // Checkout guest
        public function checkout($roomNumber)
        {
            // Get guest details by room number
            $guest = $this->guestModel->getBookingDetails($roomNumber);

            // Check out guest
            if($this->checkoutModel->checkoutGuest($guest->id)) {
                // Delete guest details from guests table
                if($this->guestModel->deleteGuest($guest->id)) {
                    // Change room status to available upon checkout
                    $this->roomModel->updateRoomStatus('available', $roomNumber);
                }  
            }
            flash('feedback', 'Guest has been check out.');
            redirect('guests/index');
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
            $guests = $this->reservationModel->sortCheckInMonth();
            
            $data = [
                'guests' => $guests
            ];

            // Load view
            $this->view('guests/arrivals_month', $data);
        }

        // Guest departures
        public function departures()
        {
            //  Get details of all guests
            $guests = $this->guestModel->getAllGuests();
            
            foreach($guests as $guest) {
                // Get guest room details by room number
                $room = $this->roomModel->getRoomDetailsByNumber($guest->room_number);
                // if room status is booked, display guest in departure
                if($room->status == 'booked') {
                    // Data values
                    $data = [
                        'id' => $guest->id,
                        'full_name' => $guest->full_name,
                        'room_number' => $guest->room_number,
                        'check_in_date' => $guest->check_in_date,
                        'check_out_date' => $guest->check_out_date
                    ];

                    // Load view
                    $this->view('guests/departures', $data);
                }
            }
        }

        // Guest departures today
        public function departures_today()
        {
            //  Get details of all guests
            $guests = $this->guestModel->getAllGuests();
            
            foreach($guests as $guest) {
                // Get guest room details by room number
                $room = $this->roomModel->getRoomDetailsByNumber($guest->room_number);
                // if room status is booked, display guest in departure
                if($room->status == 'booked' && $this->guestModel->filterCheckOutDay()) {
                    // Data values
                    $data = [
                        'id' => $guest->id,
                        'full_name' => $guest->full_name,
                        'room_number' => $guest->room_number,
                        'check_in_date' => $guest->check_in_date,
                        'check_out_date' => $guest->check_out_date
                    ];

                    // Load view
                    $this->view('guests/departures', $data);
                }
            }
        }

        // Guest arrivals today
        public function departures_week()
        {
            //  Get details of all guests
            $guests = $this->guestModel->getAllGuests();
            
            foreach($guests as $guest) {
                // Get guest room details by room number
                $room = $this->roomModel->getRoomDetailsByNumber($guest->room_number);
                // if room status is booked, display guest in departure
                if($room->status == 'booked' && $this->guestModel->filterCheckOutWeek()) {
                    // Data values
                    $data = [
                        'id' => $guest->id,
                        'full_name' => $guest->full_name,
                        'room_number' => $guest->room_number,
                        'check_in_date' => $guest->check_in_date,
                        'check_out_date' => $guest->check_out_date
                    ];

                    // Load view
                    $this->view('guests/departures', $data);
                }
            }
        }

        // Guest arrivals today
        public function departures_month()
        {
            //  Get details of all guests
            $guests = $this->guestModel->getAllGuests();
            
            foreach($guests as $guest) {
                // Get guest room details by room number
                $room = $this->roomModel->getRoomDetailsByNumber($guest->room_number);
                // if room status is booked, display guest in departure
                if($room->status == 'booked' && $this->guestModel->filterCheckOutMonth()) {
                    // Data values
                    $data = [
                        'id' => $guest->id,
                        'full_name' => $guest->full_name,
                        'room_number' => $guest->room_number,
                        'check_in_date' => $guest->check_in_date,
                        'check_out_date' => $guest->check_out_date
                    ];

                    // Load view
                    $this->view('guests/departures', $data);
                }
            }
        }
    }