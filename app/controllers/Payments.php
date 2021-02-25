<?php
    class Payments extends Controller {

        // Init model var
        private $invoiceModel;
        private $guestModel;
        private $categoryModel;


        public function __construct()
        {
            // Load models
            $this->invoiceModel = $this->model('Invoice');
            $this->guestModelModel = $this->model('Guest');
            $this->categoryModel = $this->model('Category');
            
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
    }