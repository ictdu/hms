<?php
    class Category {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Add new employee
        public function createRoomCategory($data)
        {
            // Database query
            $this->db->query('INSERT INTO room_categories (name, rate, description, capacity, image) VALUES (:name, :rate, :description, :capacity, :image)');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':rate', $data['rate']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':capacity', $data['capacity']);
            $this->db->bind(':image', $data['image']);

            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Find category by name
        public function findCategoryByName($categoryName)
        {
            // Database query
            $this->db->query('SELECT * FROM room_categories WHERE name = :name');
            // Bind values
            $this->db->bind(':name', $categoryName);
            // Return record 
            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } 

        // Get all categories
        public function getAllCategories()
        {
            // Database query
            $this->db->query('SELECT * FROM room_categories');
            // Return records 
            $results = $this->db->resultSet();

            return $results;
        }

    }