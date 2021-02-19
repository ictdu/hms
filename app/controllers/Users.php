<?php
    class Users extends Controller {
        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

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

        // Create session
        public function createUserSession($user) 
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_username'] = $user->username;
            $_SESSION['user_name'] = $user->first_name . ' ' .$user->last_name;
            $_SESSION['user_isAdmin'] = $user->is_admin;

            redirect('dashboard');
        }

        // Logout user
        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_username']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_isAdmin']);
            session_destroy();

            redirect('users/login');
        }

        // Is user logged in?
        public function isLoggedIn()
        {
            if(isset($_SESSION['user_id'])) {
                return true;
            } else {
                return false;
            }
        }
    }