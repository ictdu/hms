<?php 
    class Discount {
        // Init db var
        private $db;

        public function __construct()
        {
            // Init database
            $this->db = new Database;
        }
        
        // Create discount
        public function createDiscount($data)
        {
            // Database query
            $this->db->query('INSERT INTO discounts (type, code, discount, number_of_usage) VALUES (:type, :code, :discount, :number_of_usage)');
            // Bind values
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':discount', $data['discount']);
            $this->db->bind(':code', $data['code']);
            $this->db->bind(':number_of_usage', $data['number_of_usage']);

            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Check if discount code exists
        public function findDiscountCode($code)
        {
            // Database query
            $this->db->query('SELECT * FROM discounts WHERE code = :code');
            // Bind values
            $this->db->bind(':code', $code);

            // Execute
            if($this->db->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }

        // Get discount by discount code
        public function getDiscountByCode($code)
        {
            // Database query 
            $this->db->query('SELECT * FROM discounts WHERE code = :code');
            // Bind values
            $this->db->bind(':code', $code);
            // Return row
            $row = $this->db->single();

            return $row;
        }

        // Get all discounts
        public function getAllDiscounts()
        {
            // Database query
            $this->db->query('SELECT * FROM discounts');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Update discount status
        public function updateStatus($status, $discountId)
        {
            // Database query
            $this->db->query('UPDATE discounts SET status = :status WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $discountId);
            $this->db->bind(':status', $status);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Update number of usage
        public function updateNumOfUsage($code)
        {
            // Database query
            $this->db->query('UPDATE discounts SET number_of_usage = (number_of_usage - 1) WHERE code = :code AND number_of_usage > 0');
            // Bind value
            $this->db->bind(':code', $code);
            // Execute
            $this->db->execute();
        }

        // Get discount details by ID
        public function getDiscountDetailsById($discountId)
        {
            // Database query
            $this->db->query('SELECT * FROM discounts WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $discountId);
            // Get record
            $row = $this->db->single();

            return $row;
        }

        public function deleteDiscount($discountId)
        {
            // Database query
            $this->db->query('DELETE from discounts WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $discountId);
            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }