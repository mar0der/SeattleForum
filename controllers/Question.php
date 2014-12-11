<?php

class Question extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
    }

    public function index() {
        $this->view->title = 'question/index go to view';
        $this->view->render();
    }

    public function view() {
        $this->view->title = 'question/view';
        $this->view->render();
    }

    public function ask() {
        $this->view->title = 'question/ask';
        $this->view->render();
    }

    public function edit() {
        $this->view->title = 'question/edit';
        $this->view->render();
    }

}
