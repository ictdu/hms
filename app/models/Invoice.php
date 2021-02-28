<?php
    class Invoice {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Generate invoice
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


        // Get all invoices
        public function getAllInvoices()
        {
            // Database query
            $this->db->query('SELECT * FROM invoices');
            // Return records
            $results = $this->db->resultSet();

            return $results;
        }

        // Get invoice by guest id
        public function getInvoiceByGuestId($guestId)
        {
            // Database query
            $this->db->query('SELECT * FROM invoices WHERE guest_id = :guest_id');
            // Bind values
            $this->db->bind(':guest_id', $guestId);
            // Get recrod
            $row = $this->db->single();

            return $row;
        }

        // Get invoice by number
        public function getInvoiceByNumber($invoiceNumber)
        {
            // Database query
            $this->db->query('SELECT * FROM invoices WHERE number = :number');
            // Bind values
            $this->db->bind(':number', $invoiceNumber);
            // Get recrod
            $row = $this->db->single();

            return $row;
        }
    }