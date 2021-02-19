<?php
    class User {
        private $db;

        public function __construct() 
        {
            $this->db = new Database;
        }

        // Authenticate user
        public function authenticateUser($username, $password)
        {
            // Database query
            $this->db->query('SELECT * FROM users WHERE username = :username');
            // Bind values
            $this->db->bind(':username', $username);
            // Get record
            $row =  $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        }

        // Find user by username
        public function findUserByUsername($username)
        {
            // Database query
            $this->db->query('SELECT * FROM users WHERE username = :username');
            // Bind values
            $this->db->bind(':username', $username);
            // Return record 
            $row = $this->db->single();
            // Check row
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } 

        // Get users with employee role
        public function getUserEmployees()
        {
            // Database query
            $this->db->query('SELECT * FROM users WHERE role = "employee"');
            // Return records 
            $results = $this->db->resultSet();

            return $results;
        }
    }