<?php
    class Guest {
        
        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Check in guest
        public function checkInGuest($data)
        {
            // Database query
            $this->db->query('INSERT INTO guests (room_number, full_name, address, phone_number, email, check_in_date, check_out_date, notes, checked_in_by) VALUES (:room_number, :full_name, :address, :phone_number, :email, :check_in_date, :check_out_date, :notes, :checked_in_by)');
            // Bind values
            $this->db->bind(':room_number', $data['room_number']);
            $this->db->bind(':full_name', $data['full_name']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':phone_number', $data['phone_number']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':check_in_date', $data['check_in_date']);
            $this->db->bind(':check_out_date', $data['check_out_date']);
            $this->db->bind(':notes', $data['notes']);
            $this->db->bind(':checked_in_by', $data['checked_in_by']);

            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Get booking details of guest by room number
        public function getBookingDetails($roomNumber)
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE room_number = :room_number');
            // Bind value
            $this->db->bind(':room_number', $roomNumber);
            // Get record
            $row = $this->db->single();

            return $row;
        }

        // Get guest details by id
        public function getGuestDetailsById($guestId)
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $guestId);
            // Get record
            $row = $this->db->single();

            return $row;
        }

        // Get all guests
        public function getAllGuests()
        {
            // Database query
            $this->db->query('SELECT * FROM guests');

            // Get record
            $results = $this->db->resultSet();

            return $results;
        }

        // Get booking details of guest by room number
        public function getArrivals()
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE check_in_date >= NOW()');
            // Get record
            $results = $this->db->resultSet();

            return $results;
        }

        // Delete guest
        public function deleteGuest($guestId)
        {
            // Database query
            $this->db->query('DELETE from guests WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $guestId);
            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }