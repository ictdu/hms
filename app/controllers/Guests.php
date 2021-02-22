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

        // Check in guest
        public function checkin()
        {

            // Fetch available rooms
            $rooms = $this->roomModel->getRoomByStatus('available');

            // Init data
            $data = [
                'rooms' => $rooms
            ];

            // Load view
            $this->view('guests/checkin', $data);
        }

    }