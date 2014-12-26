<?php

class Error extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
    }

    function index($msg = 'This page doesn\'t exist!') {
        $this->view->title = '404 Error';
        $this->view->msg = $msg;
        $this->view->render();
    }

    function notauth($msg = 'You don\'t have permissions to view this page!') {
        $this->view->title = '404 Error';
        $this->view->msg = $msg;
        $this->view->render();
    }

}
