<?php 
    class Discount {
        // Init db var
        private $db;

        public function __construct()
        {
            // Init database
            $this->db = new Database;
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

        // Apply discount 
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
    }