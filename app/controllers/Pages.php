<?php
    class Pages extends Controller {
        public function __construct()
        {
            // Load model
            // $this->model = $this->model('model')    
        }

        public function index() 
        {
            $this->view('pages/index');
        }

        public function error_404() 
        {
            $this->view('pages/error_404');
        }

    }