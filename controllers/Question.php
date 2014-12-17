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
        $this->model->getQuestion($questionId);
        $this->view->render();
    }

    public function ask() {
        if(!isset($_POST['subject'], $_POST['question_body'], $_POST['tags'])) {
            $this->view->response = "All fields are required.";
            $this->view->render();
        } else {
            $subject = htmlentities($_POST['subject']);
            $body = htmlentities($_POST['question_body']);
            $tagsStr = htmlentities($_POST['question_body']);
            $tags = explode(",", str_replace(" ", "", $tagsStr)); //TODO - look at str_replace
            $this->
            $this->model->addQuestion($creatorId, $categoryId, $subject, $body, $tags);
        }
        $this->view->title = 'question/ask';
        $this->view->render();
    }

    public function edit() {
        $this->view->title = 'question/edit';
        $this->model->editQuestion($questionId);
        //$this->model->saveEditedQuestion($questionId, $body); // use this for testint this function
        //$this->model->deleteQuestion($questionId); // test this function with this row
        $this->view->render();
    }

//testing purposes to handle the exeption in order to be able to have non action functions in the controller
    private function ask2() {
        $this->view->title = 'question/edit';
        $this->view->render();
    }

}
