<?php
    class Rooms extends Controller {

        // Init model var
        private $roomModel;

        public function __construct()
        {
            // Load model
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
            $rooms = $this->roomModel->getAllRooms();

            $data = [
                'rooms' => $rooms
            ];

            // Load view
            $this->view('rooms/index', $data);
        }
    }