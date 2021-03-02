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
            // Fetch paid invoices
            $invoices = $this->invoiceModel->getAllPaidInvoices('paid');

            // Init data values
            $data = [
                'invoices' => $invoices
            ];

            // Load view
            $this->view('sales/index', $data);
        }

        // Sales for the day
        public function today()
        {
            // Fetch paid invoices
            $invoices = $this->invoiceModel->filterPaidInvoiceDay('paid');

            // Init data values
            $data = [
                'invoices' => $invoices
            ];

            // Load view
            $this->view('sales/today', $data);  
        }

        // Sales for the week
        public function week()
        {
            // Fetch paid invoices
            $invoices = $this->invoiceModel->filterPaidInvoiceWeek('paid');

            // Init data values
            $data = [
                'invoices' => $invoices
            ];

            // Load view
            $this->view('sales/week', $data); 
        }

        // Sales for the month
        public function month()
        {
            // Fetch paid invoices
            $invoices = $this->invoiceModel->filterPaidInvoiceMonth('paid');

            // Init data values
            $data = [
                'invoices' => $invoices
            ];

            // Load view
            $this->view('sales/month', $data);
        }
    }