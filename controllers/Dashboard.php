<?php

class Dashboard extends Controller {

    function __construct($controllerName, $actionName) {
        parent::__construct($controllerName, $actionName);
        $this->view->js = array('dashboard/index.js');
    }

    function index() {
        $this->view->title = 'Dashboard';
        $this->view->render();
    }

    function xhrInsert() {
        $this->model->xhrInsert();
    }

    function xhrGetListings() {
        $this->model->xhrGetListings();
    }

    function xhrDeleteListing() {
        $this->model->xhrDeleteListing();
        echo 1;
    }

}
