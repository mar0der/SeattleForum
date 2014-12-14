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
        $this->model->editUser("username","password", "afaf@faf.com", "realname", "male", "avatar"); //this will create user
        $this->view->render();
    }

    public function edit() {
        $this->view->title = 'user/edit profile';
        $this->model->editUser(1, "password", "afaf@faf.com", "realname", "male", "avatar"); //this will call edit function and edit user 1 
        $this->view->render();
    }

    public function profile() {
        $this->view->title = 'view/profile';
        $this->model->viewUser(1); //this will get the details for user 1
        $this->view->render();
    }
    
    public function delete() {
        //add credentials check
        $this->view->title = 'view/profile';
        $this->model->deleteUser(1); //this delete user 1
        $this->view->render();
    }

}
