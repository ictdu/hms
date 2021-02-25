<?php
    class Reservations extends Controller {

        // Init models var
        private $reservationModel; 
        private $guestModel; 

        public function __construct()
        {
            // Load models
            $this->reservationModel = $this->model('Reservation');
            $this->guestModel = $this->model('Guest');

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

            // Init data values
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
            $reservations = $this->reservationModel->getAllReservations();
            // Get guest details
            $reservation = $this->reservationModel->getReservationDetailsById($reservationId);
            // Fetch guest id from reservation details
            $guestId = $reservation->guest;
            // Fetch guest details
            $guest = $this->guestModel->getGuestDetailsById($guestId);

            // Data values
            $data = [
                'reservations' => $reservations,
                'guest' => $guest
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
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->reservationModel->deleteReservation($reservationId)) {
                    flash('feedback', 'Reservation deleted successfully.', 'alert alert-danger alert-dismissible fade show');
                    redirect('reservations/index');
                } else {
                    flash('feedback', 'Failed to delete reservation record.', 'alert alert-danger alert-dismissible fade show');
                    redirect('reservations/index');
                }
            } else {
                die('error');
            }
        }

        // Update reservation status
        public function update()
        {

        }

    }