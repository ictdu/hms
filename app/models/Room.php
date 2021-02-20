<?php
    class Room {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }


        // Get all rooms
        public function getAllRooms()
        {
            // Database query
            $this->db->query('SELECT * FROM rooms');
            // Return records 
            $results = $this->db->resultSet();

            return $results;
        }


    }