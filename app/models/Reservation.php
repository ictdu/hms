<?php
    class Reservation {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Add new room
        public function createReservation($data)
        {
            // Database query
            $this->db->query('INSERT INTO reservations (number, category) VALUES (:number, :category)');
            // Bind values
            $this->db->bind(':number', $data['number']);
            $this->db->bind(':category', $data['category']);

            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Delete room record
        public function deleteReservation($reservationId)
        {
            // Database query
            $this->db->query('DELETE from reservations WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $reservationId);
            
            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Find room by room number
        public function findReservationById($id)
        {
            // Database query
            $this->db->query('SELECT * FROM reservations WHERE id = :id');
            // Bind values
            $this->db->bind(':number', $id);
            // Return record 
            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } 

        // Get room by status
        public function getReservationByStatus($status)
        {
            // Database query
            $this->db->query('SELECT * FROM reservations WHERE status = :status');
            // Bind values
            $this->db->bind(':status', $status);
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Get room by status
        public function updateReservationStatus($status, $id)
        {
            // Database query
            $this->db->query('UPDATE reservations SET status = :status WHERE id = :id');
            // Bind values
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $id);
            // Execute query
            $this->db->execute();
        }

        // Get all rooms
        public function getAllReservations()
        {
            // Database query
            $this->db->query('SELECT * FROM reservations');
            // Return records 
            $results = $this->db->resultSet();

            return $results;
        }
    }