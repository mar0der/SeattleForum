<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    private $c;

    /**
     * Starts the Bootstrap
     * @param array $c 
     * All configuration parameters have to be stored in $config array in the config file
     * @return boolean
     */
    public function init() {
        global $c;
        $this->c = $c;

        // Sets the protected $_url
        $this->_getUrl();

        // Load the default controller if no URL is set
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }
        $this->_loadExistingController();
        $this->_callControllerMethod();
    }

    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);

        //setting some default values
        if (count($this->_url) == 1 && $this->_url[0] == '') {
            $this->_url[0] = 'index';
            $this->_url[1] = 'index';
        } elseif (count($this->_url) == 1 && $this->_url[0] != '') {
            $this->_url[1] = 'index';
        }
    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->c->paths->controllers . $this->c->defaultFile;
        $this->_controller = new Index($this->_url[0], $this->_url[1]);
        $this->_controller->index();
    }

    /**
     * Load an existing controller if there IS a GET parameter passed
     * and it`s model if exists
     * 
     * @return boolean|string
     */
    private function _loadExistingController() {
        $file = $this->c->paths->controllers . ucfirst($this->_url[0]) . '.php';

        if (file_exists($file)) {
            if($this->_url[0] == 'error'){
                $this->_error("Bootstrap: Unknown error occured. Please contact your administrator!");
            }
            require $file;
            if (Auth::isAuth($this->_url[0]."/".$this->_url[1])) {
                $this->_controller = new $this->_url[0]($this->_url[0], $this->_url[1]);
                //load additional models in the controller this way:
                $this->_controller->model = $this->_controller->loadModel(ucfirst($this->_url[0]), $this->c->paths->models);
                return true;
            } else {
                $this->_error("You are not aouthorized to view this page!");
                return false;
            }
        } else {
            $this->_error("This page does not exists!");
            return false;
        }
    }

    /**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod() {
        $length = count($this->_url);
        if ($length > 1) {
            if (method_exists($this->_controller, $this->_url[1])) {
                if ($length == 2) {
                    $this->_controller->{$this->_url[1]}('');
                } elseif ($length > 2) {
                    $this->_controller->{$this->_url[1]}(array_slice($this->_url, 2));
                }
            } else {
                $this->_error("This action does not exists!");
            }
        } else {
            $this->_controller->index();
        }
    }

    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    private function _error($type = "error") {
        require $this->c->paths->controllers . $this->c->errorFile;
        $this->_controller = new Error();
        $this->_controller->index(array($type));
        exit;
    }

}
