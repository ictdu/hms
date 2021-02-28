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

            foreach($invoices as $invoice) {
                // Get guest details by id
                $guest = $this->guestModel->getGuestDetailsById($invoice->guest_id);

                $data = [
                    'date' => $invoice->created_at,
                    'number' => $invoice->number,
                    'guest' => $guest->full_name,
                    'balance' => $invoice->balance,
                    'status' => $invoice->status
                ];

                // Load view
                $this->view('payments/index', $data);
            }    
        }

        // Display invoice
        public function invoice($invoiceNumber)
        {
            // Get invoice details by number
            $invoice = $this->invoiceModel->getInvoiceByNumber($invoiceNumber);
            // Get guest ID from invoice details
            $guest = $this->guestModel->getGuestDetailsById($invoice->guest_id);
            // Get room details by room number
            $room = $this->roomModel->getRoomDetailsByNumber($guest->room_number);
            // Get category details by name
            $category = $this->categoryModel->getCategoryByName($room->category);
            // Get invoice number by guest id
            $number = $this->invoiceModel->getInvoiceByGuestId($guest->id);

            // Data values
            $data = [
                'invoice' => $invoice,
                'guest' => $guest,
                'room' => $room,
                'category' => $category
            ];

            // Load view
            $this->view('payments/invoice', $data, $invoiceNumber);


        }
    }