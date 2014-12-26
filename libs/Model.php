<?php

class Model {

    public $c;

    function __construct($c) {
        $this->c = $c;
        $this->db = new Database($this->c->database->type, $this->c->database->host, $this->c->database->dbname, $this->c->database->username, $this->c->database->password);
    }

}
