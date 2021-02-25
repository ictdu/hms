<?php
    class Invoice {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        public function generateInvoice($data)
        {
            // Database query
            $this->db->query('INSERT INTO invoices (number, guest_id, balance) VALUES (:number, :guest_id, :balance)');
            // Bind values
            $this->db->bind(':number', $data['number']);
            $this->db->bind(':guest_id', $data['guest_id']);
            $this->db->bind(':balance', $data['balance']);
            // Execute query
            $this->db->execute();
        }
    }