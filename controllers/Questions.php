<?php

class Questions extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
    }

    public function index() {
        $this->view->title = 'questions/index go to view';
        $this->view->render();
    }

    public function view() {
        $this->view->title = 'questions/view';
        $this->view->render();
    }

    public function category() {
        $this->view->title = 'questions/category';
        $this->view->render();
    }

    public function tag() {
        $this->view->title = 'questions/tag';
        $this->view->render();
    }

}
