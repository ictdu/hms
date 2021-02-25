<?php
    class Reservation {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        
        // Create reservation
        public function createReservation($data)
        {
            // Database query
            $this->db->query('INSERT INTO reservations (status, guest) VALUES (:status, :guest)');
            // Bind values
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':guest', $data['guest']);

            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Get all reservations
        public function getAllReservations()
        {
            // Database query
            $this->db->query('SELECT * FROM reservations');
            // Return records 
            $results = $this->db->resultSet();

            return $results;

        }
    }