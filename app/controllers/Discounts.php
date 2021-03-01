<?php 
    class Discounts extends Controller {

        // Init model var
        private $discountModel;

        public function __construct()
        {
            // Load models
            $this->discountModel = $this->model('Discount');

            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            }    
        }

        // Default method
        public function index()
        {
            // Fetch all discounts
            $discounts = $this->discountModel->getAllDiscounts();

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Data values
                $data = [
                    'discounts' => $discounts,
                    'type' => trim($_POST['type']),
                    'code' => trim(strtoupper($_POST['code'])),
                    'discount' => trim($_POST['discount']),
                    'number_of_usage' => trim($_POST['number_of_usage']),
                    'type_err' => '',
                    'code_err' => '',
                    'discount_err' => '',
                    'number_of_usage_err' => '',
                ];

                // Validate type
                if(empty($data['type'])) {
                    $data['type_err'] = 'The discount type can not be empty.';
                }

                // Validate code
                if(empty($data['code'])) {
                    $data['code_err'] = 'The code can not be empty.';
                }

                // Validate discount amount
                if(empty($data['discount'])) {
                    $data['discount_err'] = 'The amount can not be empty.';
                }

                 // Validate limit
                 if(empty($data['number_of_usage'])) {
                    $data['number_of_usage_err'] = 'The number of usage can not be empty.';
                }

                // Make sure errors are empty
                if(empty($data['type_err']) && empty($data['code_err']) && empty($data['discount_err']) && empty($data['limit_err'])) {
                    if($this->discountModel->createDiscount($data)) {
                        // Discount successfully created
                        flash('feedback', 'Discount has been created.');
                        redirect('discounts/index'); 
                    }
                } else {
                    // Load view with errors
                    $this->view('discounts/index', $data);
                }

            } else {
                // Init data
                $data = [
                    'discounts' => $discounts,
                    'type' => '',
                    'code' => '',
                    'discount' => '',
                    'number_of_usage' => '',
                    'type_err' => '',
                    'code_err' => '',
                    'discount_err' => '',
                    'number_of_usage_err' => '',
                ];

                // Load view
                $this->view('discounts/index', $data);
            }
        }

        // Update discount statusto inactive
        public function inactive($discountId)
        {

            if($this->discountModel->updateStatus('inactive', $discountId)) {
                // Discount discarded
                flash('feedback', 'Discount status has been set to inactive.');
                redirect('discounts/index'); 
            }
        }

        // Update discount status to active
        public function active($discountId)
        {

            if($this->discountModel->updateStatus('active', $discountId)) {
                // Discount discarded
                flash('feedback', 'Discount status has been set to active.');
                redirect('discounts/index'); 
            }
        }

        // Delete discount 
        public function delete($discountId)
        {

            if($this->discountModel->deleteDiscount($discountId)) {
                // Discount discarded
                flash('feedback', 'Discount has been deleted.');
                redirect('discounts/index'); 
            }
        }
    }