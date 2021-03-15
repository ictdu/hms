<?php
    class Reservation {

        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        
        // Create reservation
        public function createReservation($data)
        {
            // Database query
            $this->db->query('INSERT INTO reservations (status, guest) VALUES (:status, :guest)');
            // Bind values
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':guest', $data['guest']);

            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Get reservation by id
        public function getReservationDetailsById($reservationId)
        {
            // Database query
            $this->db->query('SELECT * FROM reservations WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $reservationId);
            // Get record
            $row = $this->db->single();

            return $row;
        }
        
        // Set reservations status
        public function setReservationStatus($status, $reservationId)
        {
            // Database qeury
            $this->db->query('UPDATE reservations SET status = :status WHERE :id = id');
            // Bind values
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $reservationId);

            // Execute query
            $this->db->execute();
            
        }

        // Delete reservation
        public function deleteReservation($reservationId)
        {
            // Database query
            $this->db->query('DELETE from reservations WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $reservationId);
            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Display confirmed reservations
        public function getGuestsWithConfirmedReservation()
        {
            // Database query
            $this->db->query('SELECT guests.id, guests.room_number, guests.full_name, guests.check_in_date, guests.check_out_date, guests.notes, reservations.status FROM guests INNER JOIN reservations ON guests.id = reservations.guest');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }


        // Display confirmed reservations check in date by today
        public function sortCheckInDay()
        {
            // Database query
            $this->db->query('SELECT guests.id, guests.room_number, guests.full_name, guests.check_in_date, guests.check_out_date, guests.notes, reservations.status FROM guests INNER JOIN reservations ON guests.id = reservations.guest WHERE DATE_FORMAT(check_in_date, "%Y-%m-%d") = CURDATE()');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Display confirmed reservations check in date by week
        public function sortCheckInWeek()
        {
            // Database query
            $this->db->query('SELECT guests.id, guests.room_number, guests.full_name, guests.check_in_date, guests.check_out_date, guests.notes, reservations.status FROM guests INNER JOIN reservations ON guests.id = reservations.guest WHERE YEARWEEK(check_in_date) = YEARWEEK(CURDATE())');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Display confirmed reservations check in date by month
        public function sortCheckInMonth()
        {
            // Database query
            $this->db->query('SELECT guests.id, guests.room_number, guests.full_name, guests.check_in_date, guests.check_out_date, guests.notes, reservations.status FROM guests INNER JOIN reservations ON guests.id = reservations.guest WHERE (YEAR(check_in_date) = YEAR(CURDATE()) AND MONTH(check_in_date) = MONTH(CURRENT_DATE()))');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Get reservations by guest id
        public function getReservationsByGuestId($guestId)
        {
            // Database query
            $this->db->query('SELECT * FROM reservations WHERE guest = :guest');
            // Bind values
            $this->db->bind(':guest', $guestId);
            // Get records
            $row = $this->db->single();

            return $row;
        }

        // Get all reservations
        public function getAllReservations()
        {
            // Database query
            $this->db->query('SELECT reservations.id, reservations.status, guests.check_in_date, guests.check_out_date, guests.room_number, guests.id AS guest_id, guests.full_name, guests.address, guests.phone_number, guests.email, guests.notes, invoices.number AS invoice_number, users.first_name AS employee_first_name, users.last_name AS employee_last_name FROM reservations INNER JOIN guests ON reservations.guest = guests.id INNER JOIN invoices ON invoices.guest_id = guests.id INNER JOIN users ON guests.checked_in_by = users.id');
            // Return records 
            $results = $this->db->resultSet();

            return $results;

        }

        // Get joined reservation information
        public function getJoinedReservationById($reservationId)
        {
            // Database query
            $this->db->query('SELECT reservations.id, reservations.status, guests.check_in_date, guests.check_out_date, guests.room_number, guests.id AS guest_id, guests.full_name, guests.address, guests.phone_number, guests.email, guests.notes, invoices.number AS invoice_number, users.first_name AS employee_first_name, users.last_name AS employee_last_name FROM reservations INNER JOIN guests ON reservations.guest = guests.id INNER JOIN invoices ON invoices.guest_id = guests.id INNER JOIN users ON guests.checked_in_by = users.id WHERE reservations.id = :reservation_id');
            // Bind values
            $this->db->bind(':reservation_id', $reservationId);
            // Return records 
            $row = $this->db->single();

            return $row;

        }
    }