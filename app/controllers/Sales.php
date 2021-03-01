<?php 
    class Sales extends Controller {

        // Init model var
        private $invoiceModel;

        public function __construct()
        {
            // Load models here
            $this->invoiceModel = $this->model('Invoice');

            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            } 
        }

        // Default method
        public function index()
        {
            // Fetch booked rooms
            $invoices = $this->invoiceModel->getAllInvoices();

            foreach($invoices as $invoice) {
                if($invoice->status == 'paid') {
                    // Init data values
                    $data = [
                        'date' => $invoice->created_at,
                        'number' => $invoice->number,
                        'balance' => $invoice->balance,
                        'status' => $invoice->status
                    ];

                    // Load view
                    $this->view('sales/index', $data);
                } else {
                    // Empty data
                    $data = [];
                    // Load view
                    $this->view('sales/index', $data);
                }  
            }    
            // Init empty data
            $data = [];
            // Load view
            $this->view('sales/index', $data);
        }

        // Sales for the day
        public function today()
        {
            // Fetch booked rooms
            $invoices = $this->invoiceModel->getAllInvoices();

            foreach($invoices as $invoice) {
                if($invoice->status == 'paid' && $this->invoiceModel->filterPaidInvoiceDay()) {
                    // Init data values
                    $data = [
                        'date' => $invoice->created_at,
                        'number' => $invoice->number,
                        'balance' => $invoice->balance,
                        'status' => $invoice->status
                    ];

                    // Load view
                    $this->view('sales/today', $data);
                } else {
                    // Empty data
                    $data = [];
                    // Load view
                    $this->view('sales/today', $data);
                }  
            }    
            // Init empty data
            $data = [];
            // Load view
            $this->view('sales/today', $data);
        }

        // Sales for the week
        public function week()
        {
            // Fetch booked rooms
            $invoices = $this->invoiceModel->getAllInvoices();

            foreach($invoices as $invoice) {
                if($invoice->status == 'paid' && $this->invoiceModel->filterPaidInvoiceWeek()) {
                    // Init data values
                    $data = [
                        'date' => $invoice->created_at,
                        'number' => $invoice->number,
                        'balance' => $invoice->balance,
                        'status' => $invoice->status
                    ];

                    // Load view
                    $this->view('sales/week', $data);
                } else {
                    // Empty data
                    $data = [];
                    // Load view
                    $this->view('sales/week', $data);
                }  
            }    
            // Init empty data
            $data = [];
            // Load view
            $this->view('sales/week', $data);
        }

        // Sales for the month
        public function month()
        {
            // Fetch booked rooms
            $invoices = $this->invoiceModel->getAllInvoices();

            foreach($invoices as $invoice) {
                if($invoice->status == 'paid' && $this->invoiceModel->filterPaidInvoiceMonth()) {
                    // Init data values
                    $data = [
                        'date' => $invoice->created_at,
                        'number' => $invoice->number,
                        'balance' => $invoice->balance,
                        'status' => $invoice->status
                    ];

                    // Load view
                    $this->view('sales/month', $data);
                } else {
                    // Empty data
                    $data = [];
                    // Load view
                    $this->view('sales/month', $data);
                }  
            }    
            // Init empty data
            $data = [];
            // Load view
            $this->view('sales/month', $data);
        }
    }