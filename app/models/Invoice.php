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

        // Pay with cash
        public function payWithCash($newBalance, $invoiceNumber, $paid_amount) {
            // Database query
            $this->db->query('UPDATE invoices SET balance = :balance, paid_amount = :paid_amount WHERE number = :number');
            // Bind values
            $this->db->bind(':balance', $newBalance);
            $this->db->bind(':number', $invoiceNumber);
            $this->db->bind(':paid_amount', $paid_amount);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Update invoice balance
        public function updateBalance($data)
        {
            // Database query
            $this->db->query('UPDATE invoices SET balance = :balance, discounted = :discounted WHERE number = :number');
            // Bind values
            $this->db->bind(':balance', $data['balance']);
            $this->db->bind(':number', $data['invoice_number']);
            $this->db->bind(':discounted', $data['discounted']);

            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }

        }

        // Update invoice status
        public function updateInvoiceStatus($data)
        {
            // Database query
            $this->db->query('UPDATE invoices SET status = :status WHERE number = :number');
            // Bind values
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':number', $data['number']);
            // Execute
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Paid all paid invoices
        public function getAllPaidInvoices($status)
        {
            // Database query
            $this->db->query('SELECT * FROM invoices WHERE status = :status');
            // Bind value
            $this->db->bind(':status', $status);
            // Return records
            $results = $this->db->resultSet();

            return $results;
        }

        // Paid invoices for today
        public function filterPaidInvoiceDay($status)
        {
            // Database query
            $this->db->query('SELECT * FROM invoices WHERE DATE_FORMAT(created_at, "%Y-%m-%d") = CURDATE() AND status = :status');
            // Bind value
            $this->db->bind(':status', $status);
            // Return records
            $results = $this->db->resultSet();

            return $results;
        }

        // Paid invoices for the week
        public function filterPaidInvoiceWeek($status)
        {
            // Database query
            $this->db->query('SELECT * FROM invoices WHERE YEARWEEK(created_at) = YEARWEEK(CURDATE()) AND status = :status');
            // Bind value
            $this->db->bind(':status', $status);
            // Return records
            $results = $this->db->resultSet();

            return $results;
        }

        // Paid invoices for the month
        public function filterPaidInvoiceMonth($status)
        {
            // Database query
            $this->db->query('SELECT * FROM invoices WHERE (YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURRENT_DATE())) AND status = :status');
            // Bind value
            $this->db->bind(':status', $status);
            // Return records
            $results = $this->db->resultSet();

            return $results;
        }
    }