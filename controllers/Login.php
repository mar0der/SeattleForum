<?php

class Login extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
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
