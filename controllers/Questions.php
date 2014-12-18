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
        $this->view->allQuestions = $this->model->getAllQuestions();
        $this->view->allTags = $this->model->getAllTags();
        $this->view->allCategories = $this->model->getAllCategories();
        $this->view->render();
    }

    public function category($getParams) {
        $category = (int)$getParams[0];
        $this->view->title = 'questions/category';
        $this->view->allTags = $this->model->getAllTags();
        $this->view->allCategories = $this->model->getAllCategories();
        $this->view->allQuestions = $this->model->getAllQuestions(array("category" => $category, "tag" => ""));
        $this->view->render('questions/index'); //reusing the view of index
    }

    public function tag($getParams) {
        $this->view->title = 'questions/tag';
        $tag = (int)$getParams[0];
        $this->view->allTags = $this->model->getAllTags();
        $this->view->allCategories = $this->model->getAllCategories();
        $this->view->allQuestions = $this->model->getAllQuestions(array("category" => "", "tag" => $tag));
        $this->view->render('questions/index'); //reusing the view of index
    }

}
