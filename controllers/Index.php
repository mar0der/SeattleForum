<?php

class Index extends Controller {

    function __construct($controllerName, $actionName) {
        parent::__construct($controllerName, $actionName);
    }

    function index() {
        $this->view->title = 'Home';
        $this->redirect('questions');
    }

}
