<?php
class Controller 
{
    public $c;
    private $_controllerName;
    private $_actionName;
    function __construct($c, $controllerName, $actionName) 
    {
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
    public function loadModel($name, $modelPath, $c) 
    {
        $file = $modelPath . $name.'_Model.php';
        if (file_exists($file)) 
	{
            require $file;
            //the naming convetion for model`s class is Controller_Model
            $modelName = $name . '_Model';
            return new $modelName($c);
        }        
    }
}