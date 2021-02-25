<?php
    class Reservations extends Controller {

        // Init models var
        private $reservationModel; 

        public function __construct()
        {
            // Load models
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
            // Fetch all reservations
            $reservations = $this->reservationModel->getAllReservations();

            // Init data values
            $data = [
                'reservations' => $reservations
            ];

            // Load view
            $this->view('reservations/index', $data);
        }


        // Delete reservation
        public function delete()
        {

        }

        // Update reservation status
        public function update()
        {

        }

    }