<?php
    class Payments extends Controller {

        // Init model var
        private $invoiceModel;
        private $guestModel;
        private $categoryModel;
        private $roomModel;


        public function __construct()
        {
            // Load models
            $this->invoiceModel = $this->model('Invoice');
            $this->guestModel = $this->model('Guest');
            $this->categoryModel = $this->model('Category');
            $this->roomModel = $this->model('Room');
            
            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            } 
        }

        public function index()
        {
            // Fetch booked rooms
            $invoices = $this->invoiceModel->getAllInvoices();

            // Init data
            $data = [
                'invoices' => $invoices
            ];

            // Load view
            $this->view('payments/index', $data);
        }

        // Display invoice
        public function invoice($roomNumber)
        {
            // Get guest by room number
            $guest = $this->guestModel->getBookingDetails($roomNumber);
            // Fetch invoice details by guest id
            $invoice = $this->invoiceModel->getInvoiceByGuestId($guest->id);
            // Fetch room details by room number
            $room = $this->roomModel->getRoomDetailsByNumber($roomNumber);
            // Fetch room category details by room number
            $category = $this->categoryModel->getCategoryByName($room->category);


            // Data values
            $data = [
                'invoice' => $invoice,
                'guest' => $guest,
                'room' => $room,
                'category' => $category
            ];

            // Load view
            $this->view('payments/invoice', $data, $roomNumber);


        }
    }