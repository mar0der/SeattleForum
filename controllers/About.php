<?php

class About extends Controller {

    function __construct($controllerName, $actionName) {
        parent::__construct($controllerName, $actionName);
    }

    public function index() {
        $this->view->title = 'Abount Us';
        $this->view->render();
    }

}
