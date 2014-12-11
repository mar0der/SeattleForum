<?php

class User extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
    }

    public function index() {
        $this->view->title = 'if logged go to questions else to register';
        $this->view->render();
    }

    public function register() {
        $this->view->title = 'user/register form';
        $this->view->render();
    }

    public function edit() {
        $this->view->title = 'user/edit profile';
        $this->view->render();
    }

    public function profile() {
        $this->view->title = 'view/profile';
        $this->view->render();
    }

}
