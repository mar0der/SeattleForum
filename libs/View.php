<?php

class View {
    public $header = 'header';
    public $footer = 'footer';
    private $_viewPath;
    private $_controllerName;
    private $_actionName;
    public $url;
    
    function __construct($c, $controllerName, $actionName) 
    {
        $this->_controllerName = $controllerName;
        $this->_actionName = $actionName;
        $this->_viewPath = $c->paths->views;
	$this->url = $c->paths->url;
    }

    public function render($name = "", $noInclude = false)
    {   
        $controllerActionViewFile = $this->_getViewFileName($name);
        
        //loading the header
        require $this->_getHeaderFileName();
        
        //loading the content    
        if(file_exists($controllerActionViewFile))
        {
            require $controllerActionViewFile;
        }else{
            header('Location: /error/index');
        }
        
        //loading the footer
        require $this->_getFooterFileName();
    }

//some private functions
    private function _getViewFileName($url){  
        if($url == ""){
            //if the name is not sent we try with the standart naming convention
            $viewName = $this->_viewPath .strtolower($this->_controllerName)."/". strtolower($this->_controllerName) . ucfirst($this->_actionName) . "View.php";
        }else{
            $url = explode("/", $url);
            $viewName = $this->_viewPath .strtolower($url[0])."/". strtolower($url[0]) . ucfirst($url[1]) . "View.php";
        }
        return $viewName;
    }
   
    private function _getHeaderFileName(){
        $customHeaderFile = $this->_viewPath.$this->_controllerName."/".$this->_controllerName."Header.php";
        if(file_exists($customHeaderFile))
        {
            return $customHeaderFile;
        } else
        {
            return $this->_viewPath . $this->header . '.php';
        }
    }
    
    private function _getFooterFileName(){
        $customFooterFile = $this->_viewPath.$this->_controllerName."/".$this->_controllerName."Footer.php";
        if(file_exists($customFooterFile))
        {
            return $customFooterFile;
        } else
        {
            return $this->_viewPath . $this->footer . '.php';
        }
    }

}