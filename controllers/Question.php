<?php

class Question extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
        $paths = Config::getValue('paths');
        $this->questionsModel = $this->loadModel("Questions", $paths['models'], $c);
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

    public function ask($params = '') {
        if(isset($_POST) && count($_POST) > 0) {
            $postData = $this->sanitizeArray($_POST);
            if($postData['categoryId'] == 0) {
                if (empty($postData['subject']) || empty($postData['question_body']) || empty($postData['tags'])) {
                    $this->view->response = "All fields are required.";
                    $this->view->render();
                    die();
                } else {
                    $subject = htmlentities($_POST['subject']);
                    $body = htmlentities($_POST['question_body']);
                    $tagsStr = htmlentities($_POST['question_body']);
                    $tags = explode(",", str_replace(" ", "", $tagsStr)); //TODO - look at str_replace
                    $this->model->addQuestion(Session::get('userid'), $postData['categoryId'], $subject, $body, $tags);
                }
            } else {
                $this->redirect('/error');
            }
        }
        $this->view->title = 'Ask a question!';
        if(!empty($params)) {
            $this->view->categoryId = (int)$params[0];
        } else {
            $this->redirect('/error');
        }
        $this->view->allCategories = $this->questionsModel->getAllCategories();
        $this->view->allTags = $this->questionsModel->getAllTags();
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
