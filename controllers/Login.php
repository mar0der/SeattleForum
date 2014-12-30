<?php

class Login extends Controller {

    function __construct($controllerName, $actionName) {
        parent::__construct($controllerName, $actionName);
    }

    function index() {
        $this->view->title = 'Loging';
        $this->view->render();
    }

    function logout() {
        Session::destroy();
        header('location: /login');
        exit;
    }

    function run() {
        $this->model->run();
    }

}
