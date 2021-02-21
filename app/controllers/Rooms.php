<?php
    class Rooms extends Controller {

        // Init models var
        private $roomModel;
        private $categoryModel;

        public function __construct()
        {
            // Load models
            $this->roomModel = $this->model('Room');
            $this->categoryModel = $this->model('Category');

            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            }
        }

        // Default method
        public function index()
        {
            // Fetch all rooms
            $rooms = $this->roomModel->getAllRooms();

            // Fetch all categories
            $categories = $this->categoryModel->getAllCategories();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Data values
                $data = [
                    'number' => trim($_POST['number']),
                    'category' => trim($_POST['category']),
                    'rooms' => $rooms,
                    'categories' => $categories,
                    'number_err' => '',
                    'category_err' => ''
                ];

                // Validate room number
                if(empty($data['number'])) {
                    $data['number_err'] = 'The room number field is required.';
                } elseif(!empty($data['number']) && ($this->roomModel->findRoomByNumber($data['number']))) {
                    $data['number_err'] = 'Room number already exists.';
                }

                // Validate category name 
                if(empty($data['category'])) {
                    $data['category_err'] = 'The category field is required.';
                }

                // Make sure errors are empty
                if(empty($data['number_err']) && empty($data['category_err'])) {
                    if($this->roomModel->createRoom($data)) {
                        flash('feedback', 'New room successfully added.');
                        redirect('rooms/index');
                    } else {
                        flash('feedback', 'Adding new roomy failed.', 'alert alert-danger alert-dismissible fade show');
                        redirect('rooms/index');
                    }
                } else {
                    // Load view with errors
                    $this->view('rooms/index', $data);
                }
            } else {
                // Load form
                // Init data
                $data = [
                    'number' => '',
                    'category' => '',
                    'rooms' => $rooms,
                    'categories' => $categories,
                    'number_err' => '',
                    'category_err' => ''
                ];

                // Load view
                $this->view('rooms/index', $data);
            }
        }

        // Delete room record
        public function delete($roomId)
        {
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->roomModel->deleteRoom($roomId)) {
                    flash('feedback', 'Room deleted successfully.', 'alert alert-danger alert-dismissible fade show');
                    redirect('rooms/index');
                } else {
                    flash('feedback', 'Failed to delete room from record.', 'alert alert-danger alert-dismissible fade show');
                    redirect('rooms/index');
                }
            } else {
                die('Error.');
            }
        }

    }