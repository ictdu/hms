<?php
    class Employees extends Controller {

        // Init model var
        private $employeeModel;
        private $userModel;

        public function __construct()
        {
            // Load models
            $this->employeeModel = $this->model('Employee');
            $this->userModel = $this->model('User');

            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            } 
            // Check if user have admin role
            elseif (!isAdmin()) {
                // If not, deny access
                redirect('pages/dashboard');
            }
        }

        // Default method
        public function index()
        {
            // Fetch all employees
            $employees = $this->employeeModel->getUserEmployees();

            // Set data values
            $data = [
                'employees' => $employees
            ];

            // Load view with data
            $this->view('employees/index', $data);
        }

        // Add new employee
        public function add() 
        {
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Data values
                $data = [
                    'first_name' => trim($_POST['first_name']),
                    'last_name' => trim($_POST['last_name']),
                    'gender' => trim($_POST['gender']),
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'password_confirmation' => trim($_POST['password_confirmation']),
                    'first_name_err' => '',
                    'last_name_err' => '',
                    'gender_err' => '',
                    'username_err' => '',
                    'password_err' => '',
                    'password_confirmation_err' => ''
                ];

                // Validate first name
                if(empty($data['first_name'])) {
                    $data['first_name_err'] = 'The first name field is required.';
                }

                // Validate last name
                if(empty($data['last_name'])) {
                    $data['last_name_err'] = 'The last name field is required.';
                }

                // Validate gender
                if(empty($data['gender'])) {
                    $data['gender_err'] = 'The gender field is required.';
                }

                // Validate username
                if(empty($data['username'])) {
                    $data['username_err'] = 'The username field is required.';
                } elseif (!empty($data['username']) && strlen($data['username']) < 6) {
                    $data['username_err'] = 'Username must be at least 6 characters.';
                }
                
                if (!empty($data['username'])) {
                    if($this->userModel->findUserByUsername($data['username'])) {
                        $data['username_err'] = 'Username already acquired.';
                    }
                }

                // Validate password
                if(empty($data['password'])) {
                    $data['password_err'] = 'The password field is required.';
                } elseif (!empty($data['password']) && strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 characters.';
                }

                // Validate password confirmation
                if(empty($data['password_confirmation']) || $data['password_confirmation'] != $data['password']) {
                    $data['password_confirmation_err'] = 'The password confirmation is wrong.';
                }

                // Make sure errors are empty
                if(empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['gender_err']) && empty($data['username_err']) && empty($data['password_err']) && empty($data['password_confirmation_err'])) {
                    // Validated
                    // Hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if($this->employeeModel->add($data)) {
                        flash('Employee_Added', 'New employee successfully added.');
                        redirect('employees/add');
                    } else {
                        flash('Adding_Employee_Error', 'Adding new employee is unsuccessful.');
                        redirect('employees/add');
                    }
                } else {
                    // Load view with errors
                    $this->view('employees/add', $data);
                }
            } else {
                // Load form
                // Init data
                $data = [
                    'first_name' => '',
                    'last_name' => '',
                    'gender' => '',
                    'username' => '',
                    'password' => '',
                    'password_confirmation' => '',
                    'first_name_err' => '',
                    'last_name_err' => '',
                    'gender_err' => '',
                    'username_err' => '',
                    'password_err' => '',
                    'password_confirmation_err' => ''
                ];

                // Load view
                $this->view('employees/add', $data);
            }
        }

    }