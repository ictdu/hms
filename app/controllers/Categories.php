<?php
    class Categories extends Controller {

        // Init model var
        private $categoryModel;

        public function __construct()
        {
            // Load models
            $this->roomModel = $this->model('Room');
            $this->categoryModel = $this->model('Category');

            // Check if user is logged in
            if(!isLoggedIn()) {
                // If not, redirect to login page
                redirect('users/login');
            } 
        }

        // Default method
        public function index()
        {
            // Fetch all room categories
            $categories = $this->categoryModel->getAllCategories();

            // Check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Proccess form
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // File upload
                // Get image dimension
                // $dimension = @getimagesize($_FILES['category-image']['tmp_name']);

                // Allowed image extensions
                $allowedImageExt = ['jpg', 'jpeg', 'png', 'PNG'];

                // Get image file extension
                $file_extension = pathinfo($_FILES['category-image']['name'], PATHINFO_EXTENSION);
                $file = pathinfo($_FILES['category-image']['name']);
                $imageName = $file['filename'] . '.' . $file['extension'];

                // Check if file input is not empty
                // Validate file input extension
                // Validate file size
                if(!file_exists($_FILES['category-image']['tmp_name'])) {
                    
                    $data['image_err'] = 'File does not exist.';

                } elseif(!in_array($file_extension, $allowedImageExt)) {

                    $data['image_err'] = 'File extension not allowed.';

                } elseif($_FILES['category-image']['size'] > 2000000) {

                    $data['image_err'] = 'File size is too large. (Max: 2MB)';

                } else {
                    // File upload location
                    $target = URLROOT  . '/images/uploads/' . basename($_FILES['category-image']['name']);

                    // If uploaded successfully
                    if(move_uploaded_file($_FILES['category-image']['tmp_name'], $target)) {
                        // Success, redirect to index
                        die('uploaded');
                    } else {
                        // An error occured
                        $data['image_err'] = 'There seems to be a problem.';
                    }
                }

                // Data values
                $data = [
                    'name' => trim($_POST['name']),
                    'rate' => trim($_POST['rate']),
                    'capacity' => trim($_POST['capacity']),
                    'description' => trim($_POST['description']),
                    'image' => trim($imageName),
                    'categories' => $categories,
                    'name_err' => '',
                    'rate_err' => '',
                    'capacity_err' => '',
                    'description_err' => '',
                    'image_err' => ''
                ];

                // Validate category name
                if(empty($data['name'])) {
                    $data['name_err'] = 'The name field is required.';
                } elseif(!empty($data['name']) && ($this->categoryModel->findCategoryByName($data['name']))) {
                    $data['name_err'] = 'Category name already exists.';
                }

                // Validate category rate
                if(empty($data['rate'])) {
                    $data['rate_err'] = 'The rate field is required.';
                }

                // Validate capacity
                if(empty($data['capacity'])) {
                    $data['capacity_err'] = 'The capacity field is required.';
                }

                // Validate category description
                if(empty($data['description'])) {
                    $data['description_err'] = 'The description field is required.';
                }

                // Make sure errors are empty
                if(empty($data['name_err']) && empty($data['rate_err']) && empty($data['capacity_err']) && empty($data['description_err']) && empty($data['image_err'])) {
                    if($this->categoryModel->createRoomCategory($data)) {
                        flash('feedback', 'New category successfully added.');
                        redirect('categories/index');
                    } else {
                        flash('feedback', 'Adding new category failed.', 'alert alert-danger alert-dismissible fade show');
                        redirect('categories/index');
                    }
                } else {
                    // Load view with errors
                    $this->view('categories/index', $data);
                }     
            } else {
                // Load form
                // Init data
                $data = [
                    'name' => '',
                    'rate' => '',
                    'capacity' => '',
                    'description' => '',
                    'image' => '',
                    'categories' => $categories,
                    'name_err' => '',
                    'rate_err' => '',
                    'capacity_err' => '',
                    'description_err' => '',
                    'image_err' => ''
                ];

                // Load view
                $this->view('categories/index', $data);
            }
        }
    }