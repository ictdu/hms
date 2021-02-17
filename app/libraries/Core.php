<?php  
    /*
    *   App Core Class
    *   Creates URL & loads Core Controller
    *   URL FORMAT - ./controller/method/params
    */
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            $url = $this->getUrl();

            // Look in controllers for first value
            if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }
            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';
            // Instantiate controller
            $this->currentController = new $this->currentController;

            // Check for $url[1] 
            if(isset($url[1])) {
                // Check if method exists
                if(method_exists($this->currentController, $url[1])) {
                    // Set as current method
                    $this->currentMethod = $url[1];
                    // Unset 1 index
                    unset($url[1]);
                }
            }

            // Get params 
            $this->params =  $url ? array_values($url) : [];

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        // Get URL
        public function getUrl() 
        {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);

                return $url;
            }
        }
    }