<?php

class Answer extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
        $paths = Config::getValue('paths');
        $this->questionsModel = $this->loadModel("Questions", $paths['models'], $c);
    }

    public function index() {
        $this->view->title = 'answer/index (go back to questions/index)';
        $this->view->render();
    }

    public function add($params = '') {
        if(isset($_POST) && count($_POST) > 0) {
            $postData = $this->sanitizeArray($_POST);
            if($postData['questionId'] == 0) {
                if (empty($postData['answerBody'])) {
                    $this->view->response = "The field is empty.";
                    $this->view->render();
                    die();
                } else {
                    $body = htmlentities($_POST['answerBody']);
                    $this->model->addAnswer($postData['questionId'], Session::get('userid'), $body);
                }
            } else {
                $this->redirect('/error');
            }
        }
        $this->view->title = 'Adding an answer';
        if(!empty($params)) {
            $this->view->questionId = (int)$params[0];
        } else {
            $this->redirect('/error');
        }
        $this->view->allCategories = $this->questionsModel->getAllCategories();
        $this->view->allTags = $this->questionsModel->getAllTags();
        $this->view->render();
    }

    public function edit() {
        $this->view->title = 'answer/edit';
        $this->view->render();
    }

}
