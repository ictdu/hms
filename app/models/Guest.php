<?php
    class Guest {
        
        // Init database
        private $db;

        public function __construct()
        {
            // Instantiate database
            $this->db = new Database;
        }

        // Check in guest
        public function checkInGuest($data)
        {
            // Database query
            $this->db->query('INSERT INTO guests (room_number, full_name, address, phone_number, email, check_in_date, check_out_date, notes, checked_in_by) VALUES (:room_number, :full_name, :address, :phone_number, :email, :check_in_date, :check_out_date, :notes, :checked_in_by)');
            // Bind values
            $this->db->bind(':room_number', $data['room_number']);
            $this->db->bind(':full_name', $data['full_name']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':phone_number', $data['phone_number']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':check_in_date', $data['check_in_date']);
            $this->db->bind(':check_out_date', $data['check_out_date']);
            $this->db->bind(':notes', $data['notes']);
            $this->db->bind(':checked_in_by', $data['checked_in_by']);

            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Get all bookings by room number
        public function getAllBookingDetails($roomNumber)
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE room_number = :room_number');
            // Bind value
            $this->db->bind(':room_number', $roomNumber);
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Get booking details of guest by room number
        public function getBookingDetails($roomNumber)
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE room_number = :room_number');
            // Bind value
            $this->db->bind(':room_number', $roomNumber);
            // Get record
            $row = $this->db->single();

            return $row;
        }

        // Get guest details by id
        public function getGuestDetailsById($guestId)
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $guestId);
            // Get record
            $row = $this->db->single();

            return $row;
        }

        // Get reservation by check in date, check out date and room number
        public function getGuestByBookingDates($checkInDate, $checkOutDate, $roomNumber)
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE DATE_FORMAT(check_in_date, "%Y-%m-%d") = :check_in_date AND DATE_FORMAT(check_out_date, "%Y-%m-%d") = :check_out_date AND room_number = :room_number');
            // Bind value
            $this->db->bind(':check_in_date', $checkInDate);
            $this->db->bind(':check_out_date', $checkOutDate);
            $this->db->bind(':room_number', $roomNumber);
            // Get records
            $row = $this->db->single();

            return $row;
        }

        // Get all guests
        public function getAllGuests()
        {
            // Database query
            $this->db->query('SELECT * FROM guests');

            // Get record
            $results = $this->db->resultSet();

            return $results;
        }

        // Get booking details of guest by room number
        public function getArrivals()
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE check_in_date >= NOW()');
            // Get record
            $results = $this->db->resultSet();

            return $results;
        }

        // Display guests with check out date today
        public function filterCheckOutDay()
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE DATE_FORMAT(check_out_date, "%Y-%m-%d") = CURDATE()');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Display guests with check out date within this week
        public function filterCheckOutWeek()
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE YEARWEEK(check_out_date) = YEARWEEK(CURDATE())');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Display guests with check out date within this month
        public function filterCheckOutMonth()
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE (YEAR(check_out_date) = YEAR(CURDATE()) AND MONTH(check_out_date) = MONTH(CURRENT_DATE()))');
            // Get records
            $results = $this->db->resultSet();

            return $results;
        }

        // Delete guest
        public function deleteGuest($guestId)
        {
            // Database query
            $this->db->query('DELETE from guests WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $guestId);
            // Execute query
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        // Get joined reservation information
        public function getJoinedGuestDetailsById($guestId)
        {
            // Database query
            $this->db->query('SELECT guests.check_in_date, guests.check_out_date, guests.room_number, guests.id AS guest_id, guests.full_name, guests.address, guests.phone_number, guests.email, guests.notes, invoices.number AS invoice_number, users.first_name AS employee_first_name, users.last_name AS employee_last_name FROM guests INNER JOIN invoices ON guests.id = invoices.guest_id INNER JOIN users ON guests.checked_in_by = users.id WHERE guest_id = :guestId');
            // Bind values
            $this->db->bind(':guestId', $guestId);
            // Return records 
            $row = $this->db->single();

            return $row;

        }

        // Get details of booked room_number
        public function getDetailsBookedRoom($roomNumber)
        {
            // Database query
            $this->db->query('SELECT * FROM guests WHERE room_number = :room_number AND ((CURDATE() >= check_in_date) AND (CURDATE() <= check_out_date))');
            // Bind values
            $this->db->bind(':room_number', $roomNumber);
            // Get record
            $row = $this->db->single();

            return $row;
        }

    }