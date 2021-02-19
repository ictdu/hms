<?php
    class Pages extends Controller {
        
        public function __construct()
        {
            // Load model
            // $this->model = $this->model('model')    
        }

        // Default method
        public function index() 
        {
            // Load view
            $this->view('pages/index');
        }

        // Error 404 
        public function error_404() 
        {
            $this->view('pages/error_404');
        }

        // Error 403
        public function error_403() 
        {
            $this->view('pages/error_403');
        }

    }