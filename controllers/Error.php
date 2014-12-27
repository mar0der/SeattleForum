<?php

class Error extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
    }

    function index($params = "") {
        $this->view->title = '404 Error';
        $this->view->msg = $params[0];
        $this->view->render();
    }

    function notauth($msg = 'You don\'t have permissions to view this page!') {
        $this->view->title = '404 Error';
        $this->view->msg = $msg;
        $this->view->render();
    }

}
