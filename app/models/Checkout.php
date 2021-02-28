<?php 
    class Checkout {

        // Init db
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Create new check out record
        public function checkoutGuest($guestId)
        {
            // Database query
            $this->db->query('INSERT INTO checkouts SELECT * FROM guests WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $guestId);
            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }