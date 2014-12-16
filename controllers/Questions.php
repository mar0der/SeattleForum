<?php

class Questions extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
    }

    public function index() {
        $this->view->title = 'Get your answers here!';
        $this->model->getAllQuestions(); //testing for all question
        //testing for aside tags and categories
        //$this->model->getAllTags();
        //$this->model->getAllCategories();
        $this->view->render();
    }

    public function category() {
        $this->view->title = 'questions/category';
        $this->model->getAllQuestions(array("category" => 2, "tag" => 0)); //testing for categories
        $this->view->render('questions/index'); //reusing the view of index
    }

    public function tag() {
        $this->view->title = 'questions/tag';
        $this->model->getAllQuestions(array("category" => 0, "tag" => 3)); //testing for tags
        $this->view->render('questions/index'); //reusing the view of index
    }

}
