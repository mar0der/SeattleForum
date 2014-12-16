<?php

class Bootstrap {

    private $_url = null;
    private $_controller = null;
    public $c;

    /**
     * Starts the Bootstrap
     * @param array $c 
     * All configuration parameters have to be stored in $config array in the config file
     * @return boolean
     */
    public function init($c) {
        $this->c = $c;
        // Sets the protected $_url
        $this->_getUrl();

        // Load the default controller if no URL is set
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }
        $this->_loadExistingController($c);
        $this->_callControllerMethod();
        return true;
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
        $this->_controller = new Index($this->c, $this->_url[0], $this->_url[1]);
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
            require $file;
            $this->_controller = new $this->_url[0]($this->c, $this->_url[0], $this->_url[1]);
            //load additional models in the controller this way:
            $this->_controller->model = $this->_controller->loadModel(ucfirst($this->_url[0]), $this->c->paths->models, $this->c);
            return true;
        }
        $this->_error();
        return false;
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

        if($length > 1){
            if(method_exists($this->_controller, $this->_url[1])){
                if($length == 2){
                    $this->_controller->{$this->_url[1]}($params = '');
                }elseif($length > 2){
                    $this->_controller->{$this->_url[1]}(array_slice($this->_url, 2));
                }
            }else{
                $this->_error();
            }
        } else{
            $this->_controller->index();
        }
        

//        // Determine what to load
//        switch ($length) {
//            case 5:
//                //Controller->Method(Param1, Param2, Param3)
//                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
//                break;
//
//            case 4:
//                //Controller->Method(Param1, Param2)
//                $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
//                break;
//
//            case 3:
//                //Controller->Method(Param1, Param2)
//                $this->_controller->{$this->_url[1]}($this->_url[2]);
//                break;
//
//            case 2:
//                //Controller->Method(Param1, Param2)
//                $this->_controller->{$this->_url[1]}();
//                break;
//
//            default:
//                $this->_controller->index();
//                break;
//        }
    }

    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    private function _error() {
        require $this->c->paths->controllers . $this->c->errorFile;
        $this->_controller = new Error($this->c, $this->_url[0], $this->_url[1]);
        $this->_controller->index();
        exit;
    }

}
