<?php
    class Payments extends Controller {

        // Init model var
        private $invoiceModel;
        private $guestModel;
        private $categoryModel;
        private $roomModel;
        private $discountModel;


        public function __construct()
        {
            // Load models
            $this->invoiceModel = $this->model('Invoice');
            $this->guestModel = $this->model('Guest');
            $this->categoryModel = $this->model('Category');
            $this->roomModel = $this->model('Room');
            $this->discountModel = $this->model('Discount');
            
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
                    'status' => $invoice->status,
                    'room_number' => $guest->room_number
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

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Data values
                $data = [
                    'invoice' => $invoice,
                    'guest' => $guest,
                    'room' => $room,
                    'category' => $category,
                    'code' => trim($_POST['code']),
                    'code_err' => ''
                ];

                // Check if discount code field is empty
                if(empty($data['code'])) {
                    $data['code_err'] = 'Discount code can not be empty.';
                }

                // Check if discount code exists 
                if(!empty($data['code']) && (!$this->discountModel->findDiscountCode($data['code']))) {
                    $data['code_err'] = 'Discount code not found.';
                }

                // Make sure there are no errors
                if(empty($data['code_err'])) {
                    // Get discount details by code
                    $discount = $this->discountModel->getDiscountByCode($data['code']);
                    // Deduct discount amount to balance
                    $discountPercentage = $discount->discount / 100;
                    $newBalance = $data['invoice']->balance * $discountPercentage;

                    if($this->invoiceModel->updateBalance($data = [
                        'balance' => $newBalance,
                        'invoice_number' => $invoiceNumber,
                        'discounted' => 1,
                    ])) {
                        // Success, refresh page
                        redirect('payments/invoice/' . $invoiceNumber);
                    }
                } else {
                    // Load view with errors
                    $this->view('payments/invoice', $data, $invoiceNumber);
                }
            } else {
                // Init data values
                $data = [
                    'invoice' => $invoice,
                    'guest' => $guest,
                    'room' => $room,
                    'category' => $category,
                    'code' => '',
                    'code_err' => ''
                ];

                // Load view
                $this->view('payments/invoice', $data, $invoiceNumber);
            }
        }

        // Pay invoice
        // Refactor this later for a real payment gateway
        public function pay($invoiceNumber)
        {
            // Get invoice by number
            $invoice = $this->invoiceModel->getInvoiceByNumber($invoiceNumber);

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                // Init data values
                $data = [
                    'status' => 'paid',
                    'number' => $invoiceNumber
                ];

                if($this->invoiceModel->updateInvoiceStatus($data)) {
                    // Update invoice status to paid
                    flash('feedback', 'Invoice has been paid.');
                    redirect('payments/invoice/' . $invoiceNumber);
                }
            } else {
                // Init data values
                $data = [
                    'invoice' => $invoice
                ];

                // Load view
                $this->view('payments/pay', $data, $invoiceNumber);
            }
        }
    }