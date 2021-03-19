<?php
    class Reservations extends Controller {

        // Init models var
        private $reservationModel; 
        private $guestModel; 
        private $roomModel;
        private $userModel;
        private $invoiceModel;

        public function __construct()
        {
            // Load models
            $this->reservationModel = $this->model('Reservation');
            $this->guestModel = $this->model('Guest');
            $this->roomModel = $this->model('Room');
            $this->userModel = $this->model('User');
            $this->invoiceModel = $this->model('Invoice');

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

            $data = [
                'reservations' => $reservations
            ];
            
            // Load view
            $this->view('reservations/index', $data);
        }

        // Guest reservation details
        public function details($reservationId)
        {
            // Fetch all reservations
            $reservation = $this->reservationModel->getJoinedReservationById($reservationId);

            // Fetch all reservations
            $reservations = $this->reservationModel->getAllReservations();

            $data = [
                'reservations' => $reservations,
                'reservation' => $reservation
            ];

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
            // Delete reservation after checking in
            $this->reservationModel->deleteReservation($reservationId);
            
            // Redirect
            flash('feedback', 'The room has been booked.');
            redirect('reservations/index');
        }

        // Check Status in Reservation
        // Change reservation status based on payment
        public function status($invoiceStatus)
        {
            if($invoiceStatus == 'paid') {
                return 'guaranteed';
            } elseif($invoiceStatus == 'partial') {
                return 'confirmed';
            } else {
                return 'on hold';
            }
        }

    }