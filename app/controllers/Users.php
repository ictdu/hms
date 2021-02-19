<?php
    class Users extends Controller {
        private $userModel;
        
        public function __construct()
        {

            $this->userModel = $this->model('User');
        }


        public function index()
        {
            if(!isLoggedIn()) {
                redirect('users/login');
            } elseif (!isAdmin()) {
                redirect('pages');
            }

            $employees = $this->userModel->getUserEmployees();

            $data = [
                'employees' => $employees
            ];
            
            $this->view('users/index', $data);
        }

        // User Login
        public function login() 
        {
            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Data values
                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'username_err' => '',
                    'password_err' => ''
                ];

                // Validate username
                if(empty($data['username'])) {
                    $data['username_err'] = 'The username field is required.';
                }

                // Validate password
                if(empty($data['password'])) {
                    $data['password_err'] = 'The password field is required.';
                } 

                // Check if user exists
                if(!empty($data['username'])) {
                    if($this->userModel->findUserByUsername($data['username'])) {
                        // User found, validate password
                        if(!$this->userModel->authenticateUser($data['username'], $data['password'])) {
                            $data['password_err'] = 'Incorrect password. Please try again.';
                        }
                    } else {
                        // User not found
                        $data['username_err'] = 'Username not found. Please try again.';
                    }
                }

                // Make sure errors are empty
                if(empty($data['username_err']) && empty($data['password_err'])) {
                    // Validated
                    // Create session
                    // Redirect to dashboard
                    $loggedInUser = $this->userModel->authenticateUser($data['username'], $data['password']);
                    $this->createUserSession($loggedInUser);
                } else {
                    // Load view with errors
                    $this->view('users/login', $data);
                }
            } else {
                // Load form
                // Init data
                $data = [
                    'username' => '',
                    'password' => '',
                    'username_err' => '',
                    'password_err' => ''
                ];
                // Load view
                $this->view('users/login', $data);
            }
        }
        
        // Add new employee
        public function add_employee() 
        {
            if(!isAdmin()) {
                redirect('pages/error_403');
            }

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

                    if($this->userModel->add_employee($data)) {
                        flash('Employee_Added', 'New employee successfully added.');
                        redirect('users/add_employee');
                    } else {
                        flash('Adding_Employee_Error', 'Adding new employee is unsuccessful.');
                        redirect('users/add_employee');
                    }
                } else {
                    // Load view with errors
                    $this->view('users/add_employee', $data);
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
                $this->view('users/add_employee', $data);
            }
        }

        // Create session
        public function createUserSession($user) 
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_username'] = $user->username;
            $_SESSION['user_name'] = $user->first_name . ' ' .$user->last_name;
            $_SESSION['user_gender'] = $user->gender;
            $_SESSION['user_role'] = $user->role;

            redirect('users');
        }

        // Logout user
        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_username']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_gender']);
            unset($_SESSION['user_role']);
            session_destroy();

            redirect('users/login');
        }
    }