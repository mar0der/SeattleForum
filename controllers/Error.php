<?php

class Error extends Controller {

    function __construct() {
        parent::__construct("error", "index");
    }

    public function index($msgs = array(0 => "404")) {
        $this->view->title = "An error occured";
        $this->view->msgs = $msgs;
        $this->view->render();
    }
}
