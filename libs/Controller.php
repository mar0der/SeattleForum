<?php

class Controller {

    public $c;
    private $_controllerName;
    private $_actionName;

    function __construct($c, $controllerName, $actionName) {
        $this->_controllerName = $controllerName;
        $this->_actionName = $actionName;
        $this->view = new View($c, $controllerName, $actionName);
        $this->c = $c;
    }

    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     * @return model instance
     */
    public function loadModel($name, $modelPath, $c) {
        $file = $modelPath . $name . '_Model.php';
        if (file_exists($file)) {
            require $file;
            //the naming convetion for model`s class is Controller_Model
            $modelName = $name . '_Model';
            return new $modelName($c);
        }
    }

    /**
     * 
     * @param string $url 'controller/action'
     * @return void
     */
    public function redirect($url) {
        header('location: ' . $url);
    }

    /**
     * 
     * @param array of strings $inputArray
     * @return array of strings
     */
    public function sanitizeArray($inputArray) {
        $outputArray = array();
        foreach ($inputArray as $k => $v) {
            $outputArray[$k] = $this->sanitize($v);
        }
        return $outputArray;
    }

    /**
     * 
     * @param string $input
     * @return string
     */
    public function sanitize($input) {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitize($val);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input = $this->cleanInput($input);
            $output = htmlentities($input);
        }
        return $output;
    }

    public function cleanInput($input) {

        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );

        $output = preg_replace($search, '', $input);
        return $output;
    }

}
