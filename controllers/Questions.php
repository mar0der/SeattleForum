<?php

class Questions extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
        if (!Auth::isAuth(get_class())) {
            header('location: ../error/notauth');
        }
    }

    public function index($getParams) {
        if (!is_array($getParams) or count($getParams) < 1) {
            $currentPage = 1;
        } else {
            $currentPage = (int) $getParams[0];
        }
        $this->view->css["paginator"] = "paginator.css";
        $this->view->title = 'Get your answers here!';
        $this->view->allTags = $this->model->getAllTags();
        $this->view->allCategories = $this->model->getAllCategories();
        $dataParams = array(
            "category" => "",
            "tag" => ""
        );
        $paginator = Paginator::create($this->model, "getAllQuestions")
                ->setResultsPerPage(5)
                ->setCurrentPage($currentPage)
                ->setPaginatorHtml("paginatorView.php")
                ->setDataParams($dataParams);
        $this->view->allQuestions = $paginator->getData();
        $this->view->paginator = $paginator;
        $this->view->render();
    }

    public function category($getParams) {
        $this->view->css["paginator"] = "paginator.css";
        $category = (int) $getParams[0];
        if (!is_array($getParams) or count($getParams) < 2) {
            $currentPage = 1;
        } else {
            $currentPage = (int) $getParams[1];
        }
        $this->view->title = 'All questions in cateogry';
        $this->view->allTags = $this->model->getAllTags();
        $this->view->allCategories = $this->model->getAllCategories();
        $dataParams = array(
            "category" => $category,
            "tag" => ""
        );
        $paginator = Paginator::create($this->model, "getAllQuestions")
                ->setResultsPerPage(5)
                ->setCurrentPage($currentPage)
                ->setPaginatorHtml("paginatorView.php")
                ->setDataParams($dataParams);
        $this->view->allQuestions = $paginator->getData();
        $this->view->paginator = $paginator;
        $this->view->render('questions/index'); //reusing the view of index
    }

    public function tag($getParams) {
        $this->view->css["paginator"] = "paginator.css";
        $this->view->title = 'All questions for tag';
        $tag = $this->sanitize($getParams[0]);
        if (!is_array($getParams) or count($getParams) < 2) {
            $currentPage = 1;
        } else {
            $currentPage = (int) $getParams[1];
        }
        $this->view->allTags = $this->model->getAllTags();
        $this->view->allCategories = $this->model->getAllCategories();
        $dataParams = array(
            "category" => "",
            "tag" => $tag
        );
        $paginator = Paginator::create($this->model, "getAllQuestions")
                ->setResultsPerPage(5)
                ->setCurrentPage($currentPage)
                ->setPaginatorHtml("paginatorView.php")
                ->setDataParams($dataParams);
        $this->view->allQuestions = $paginator->getData();
        $this->view->paginator = $paginator;
        $this->view->render('questions/index'); //reusing the view of index
    }

    public function ajaxvote() {
        if (isset($_POST) && count($_POST) > 0) {
            $vote = $this->sanitize($_POST["vote"]);
            $questionId = $this->sanitize($_POST["questionId"]);
            $voted = $this->model->checkIfVoted(Session::get('userid'), $questionId);
            $this->view->hasVoted = $voted;
            if ($voted == 0) {
                if ((int) $vote == 1) {
                    $votePlus = $this->model->votePlus(Session::get('userid'), $questionId, null);
                    echo $votePlus;
                } else {
                    $voteMinus = $this->model->voteMinus(Session::get('userid'), $questionId, null);
                    echo $voteMinus;
                }
            }
        } else {
            $this->redirect('questions/index');
        }
    }

}
