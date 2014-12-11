<?php

class Answer extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
    }

    public function index() {
        $this->view->title = 'answer/index (go back to questions/index)';
        $this->view->render();
    }

    public function add() {
        $this->view->title = 'answer/add';
        $this->view->render();
    }

    public function edit() {
        $this->view->title = 'answer/edit';
        $this->view->render();
    }

}
