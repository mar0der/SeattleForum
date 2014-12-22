<?php

class Answer extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
//        if (!Auth::isAuth(get_class())) {
//            header('location: ../error/notauth');
//        }
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
            if($postData['questionId'] != 0) {
                if (empty($postData['answerBody'])) {
                    $this->redirect('/question/view/'.$postData['questionId']."/noempty");
                    die;
                } else {
                    $body = htmlentities($_POST['answerBody']);
                    $this->model->addAnswer($postData['questionId'], Session::get('userid'), $body);
                    $this->redirect('/question/view/'.$postData['questionId']);
                    die;
                }
            } else {
                $this->redirect('/error');
            }
        } 
        $this->redirect('/questions');
    }

    public function edit() {
        $this->view->title = 'answer/edit';
        $this->view->render();
    }

}
