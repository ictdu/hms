<?php
    class Pages extends Controller {
        public function __construct()
        {
            // $this->model = $this->model('model')    
        }

        public function index() 
        {
            $data = [
                'title' => 'Index'
            ];

            $this->view('pages/index', $data);
        }

        public function about() 
        {
            $this->view('pages/about');
        }

    }