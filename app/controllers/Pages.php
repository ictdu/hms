<?php
    class Pages extends Controller {
        public function __construct()
        {
            // Load model
            // $this->model = $this->model('model')    
        }

        public function index() 
        {
            if(!isLoggedIn()) {
                redirect('users/login');
            }
            $this->view('pages/index');
        }

        public function about() 
        {
            $this->view('pages/about');
        }

    }