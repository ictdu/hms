<?php
    class Reservations extends Controller {

        // Init models var
        private $reservationModel; 
        private $guestModel; 
        private $roomModel;
        private $userModel;

        public function __construct()
        {
            // Load models
            $this->reservationModel = $this->model('Reservation');
            $this->guestModel = $this->model('Guest');
            $this->roomModel = $this->model('Room');
            $this->userModel = $this->model('User');

            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            }
        }

        // Default method
        public function index()
        {
            // Fetch all reservations
            $reservations = $this->reservationModel->getAllReservations();

            foreach($reservations as $reservation) {
                // Get guest details by ID
                $guest = $this->guestModel->getGuestDetailsById($reservation->guest);
                // Get room details by guest number
                $room = $this->roomModel->getRoomDetailsByNumber($guest->room_number);

                $data = [
                    'room' => $room,
                    'reservation_id' => $reservation->id,
                    'guest_name' => $guest->full_name,
                    'guest_check_in_date' => $guest->check_in_date,
                    'guest_check_out_date' => $guest->check_out_date,
                    'reservation_status' => $reservation->status
                ];

                // Load view
                $this->view('reservations/index', $data);
            }

            // Init empty data
            $data = [];
            // Load view
            $this->view('reservations/index', $data);  
        }

        // Guest reservation details
        public function details($reservationId)
        {
            // Fetch all reservations
            $reservations = $this->reservationModel->getAllReservations();
            // Get guest details
            $reservation = $this->reservationModel->getReservationDetailsById($reservationId);
            // Fetch guest id from reservation details
            $guestId = $reservation->guest;
            // Fetch guest details
            $guest = $this->guestModel->getGuestDetailsById($guestId);
            // Get room details by guest number
            $room = $this->roomModel->getRoomDetailsByNumber($guest->room_number);

            foreach($reservations as $reservation) {
                // Get guest details by ID
                $guest = $this->guestModel->getGuestDetailsById($reservation->guest);
                // Get employee details by ID
                $employee = $this->userModel->getEmployeeById($guest->checked_in_by);

                $data = [
                    'reservations' => $reservations,
                    'guest' => $guest,
                    'room' => $room,
                    'employee' => $employee,
                    'reservation_id' => $reservation->id,
                    'guest_name' => $guest->full_name,
                    'guest_check_in_date' => $guest->check_in_date,
                    'guest_check_out_date' => $guest->check_out_date,
                    'reservation_status' => $reservation->status
                ];

                // Load view
                $this->view('reservations/details', $data, $reservationId);
            }

            // Init emtpy data
            $data = [];
            // Load view
            $this->view('reservations/details', $data, $reservationId);
        }

        // Confirm reservation
        public function confirm($reservationId)
        {
            // Change reservation status
            $this->reservationModel->setReservationStatus('confirmed', $reservationId);

            // Redirect
            flash('feedback', 'Reservation confirmed.');
            redirect('reservations/index');
        }

        // Delete reservation record
        public function delete($reservationId)
        {
            // Get reservation by id
            $reservation = $this->reservationModel->getReservationDetailsById($reservationId);

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get guest id
                $guestId = $reservation->guest;

                // Delete reservation details
                if($this->reservationModel->deleteReservation($reservationId)) {
                    if($this->guestModel->deleteGuest($guestId)) {
                        flash('feedback', 'Reservation deleted successfully.', 'alert alert-danger alert-dismissible fade show');
                        redirect('reservations/index');
                    }  else {
                        // something is wrong
                        die('Something is wrong');
                    }
                } else {
                    flash('feedback', 'Failed to delete reservation record.', 'alert alert-danger alert-dismissible fade show');
                    redirect('reservations/index');
                }
            } else {
                die('error');
            }
        }

        // Update reservation status
        public function update($reservationId)
        {
            // Get reservation by id
            $reservation = $this->reservationModel->getReservationDetailsById($reservationId);
            // Get guest details by ID
            $guest = $this->guestModel->getGuestDetailsById($reservation->guest);

            $this->roomModel->updateRoomStatus('booked', $guest->room_number);

            // Redirect
            flash('feedback', 'The room has been booked.');
            redirect('reservations/index');
        }

    }