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
            $this->db->query('INSERT INTO categories (name, rate, description, capacity, image) VALUES (:name, :rate, :description, :capacity, :image)');
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

        // Update existing category record
        public function updateCategory($data)
        {
            // Database query
            $this->db->query('UPDATE categories SET name = :name, rate = :rate, description = :description, capacity = :capacity, image = :image WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
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

        // Delete category record
        public function deleteCategory($categoryId)
        {
            // Database query
            $this->db->query('DELETE from categories WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $categoryId);
            
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
            $this->db->query('SELECT * FROM categories WHERE name = :name');
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

        // Get category by id
        public function getCategoryById($categoryId)
        {
            // Database query
            $this->db->query('SELECT * FROM categories WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $categoryId);
            // Get record
            $row = $this->db->single();

            return $row;
        }

        // Get category by name
        public function getCategoryByName($categoryName)
        {
            // Database query
            $this->db->query('SELECT * FROM categories WHERE name = :name');
            // Bind value
            $this->db->bind(':name', $categoryName);
            // Get record
            $row = $this->db->single();

            return $row;
        }

        // Get all categories
        public function getAllCategories()
        {
            // Database query
            $this->db->query('SELECT * FROM categories');
            // Return records 
            $results = $this->db->resultSet();

            return $results;
        }

        //

    }