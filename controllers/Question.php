<?php

class Question extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
        $paths = Config::getValue('paths');
        $this->questionsModel = $this->loadModel("Questions", $paths['models'], $c);
        $this->answersModel = $this->loadModel("Answer", $paths['models'], $c);
    }

    public function index() {
        $this->redirect('/question/ask');
    }

    public function view($params = '') {
        if(!empty($params)) {
            $questionId = (int)$params[0];
        } else {
            $this->redirect('/error');
        }
        $this->view->answers = $this->answersModel->getAllAnswersForQuestion($questionId);
        $this->view->title = 'question/view';
        $this->model->addVisit($questionId);
        $this->view->question = $this->model->getQuestion($questionId);
        $paths = Config::getValue('paths');
        $this->view->question[0]['creator'][0]['avatar'] = $paths['avatarUrl'].$this->view->question[0]['creator'][0]['avatar'];
        $this->view->allCategories = $this->questionsModel->getAllCategories();
        $this->view->allTags = $this->questionsModel->getAllTags();
        $this->view->render();
    }

    public function ask() {
        if(isset($_POST) && count($_POST) > 0) {
            $postData = $this->sanitizeArray($_POST);
            if (empty($postData['subject']) || empty($postData['questionBody']) || empty($postData['tags']) || empty($postData['categoryId'])) {
                $this->view->response = "All fields are required.";
                $this->view->render();
            } else {
                $subject = $postData['subject'];
                $body = $postData['questionBody'];
                $tagsStr = $postData['tags'];
                $categoryId = $postData['categoryId'];
                $this->view->category_id = $categoryId."kkk";
                $tags = explode(",", str_replace(" ", "", $tagsStr)); //TODO - look at str_replace
                $this->model->addQuestion(Session::get('userid'), $categoryId, $subject, $body, $tags);
                $this->redirect('/questions');
            }
        }
        $this->view->title = 'Ask a question!';
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
