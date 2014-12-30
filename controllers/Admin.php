<?php

class Admin extends Controller {

    function __construct($controllerName, $actionName) {
        parent::__construct($controllerName, $actionName);
    }

    public function index() {
        $this->view->title = 'Admin Panel';
        $this->view->userList = $this->model->userList();
        $this->view->render();
    }

    public function create() {
        $data = array();
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        // @TODO: Do your error checking!

        $this->model->create($data);
        header('location: /admin');
    }

    public function edit($id) {
        $this->view->title = 'Admin - edit user';
        $this->view->user = $this->model->userSingleList($id);

        $this->view->render();
    }

    public function editSave() {
        $data = array();
        $data['userid'] = $_POST['userid'];
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['role'] = $_POST['role'];

        // @TODO: Do your error checking!

        $this->model->editSave($data);
        header('location: /admin');
    }

    public function delete($id) {
        $this->model->delete($id);
        header('location: /admin');
    }

}
