<?php 
    class Employee {

        // Init database
        private $db;

        public function __construct() 
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Add new employee
        public function add($data)
        {
            // Database query
            $this->db->query('INSERT INTO users (first_name, last_name, gender, username, password) VALUES (:first_name, :last_name, :gender, :username, :password)');
            // Bind values
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':gender', $data['gender']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);

            // Execute query
            if($this->db->execute()) {
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