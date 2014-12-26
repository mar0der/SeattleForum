<?php

class Index extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
    }

    function index() {
        $this->view->title = 'Home';
        $this->redirect('questions');
    }

}
