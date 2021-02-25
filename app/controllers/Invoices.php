<?php
    class Invoices extends Controller {

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
    }