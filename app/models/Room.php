<?php
    class Room {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Add new room
        public function createRoom($data)
        {
            // Database query
            $this->db->query('INSERT INTO rooms (number, category) VALUES (:number, :category)');
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
        public function deleteRoom($roomId)
        {
            // Database query
            $this->db->query('DELETE from rooms WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $roomId);
            
            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Find room by room number
        public function findRoomByNumber($number)
        {
            // Database query
            $this->db->query('SELECT * FROM rooms WHERE number = :number');
            // Bind values
            $this->db->bind(':number', $number);
            // Return record 
            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
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

        // Inner join room and category
        public function joinRoomAndCategory($roomId)
        {
            // Database query
            $this->db->query('SELECT rooms.id, rooms.number, rooms.category, rooms.status, room_categories.rate, room_categories.description, room_categories.capacity FROM rooms INNER JOIN room_categories ON rooms.category = room_categories.name WHERE rooms.id = :id');
            // Bind values
            $this->db->bind(':id', $roomId);
            // Return records 
            $row = $this->db->single();

            return $row;
        }


    }