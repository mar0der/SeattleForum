<?php

class Question_Model extends Model {

    public function __construct($c) {
        parent::__construct($c);
    }

    public function getQuestion($questionId) {
        //getCreator($creatorId); // use this function to get the creator data
        return $outputArray;
    }
    
    public function addQuestion($questionId, $creatorId, $body, $tags){
        $isDone = false;
        //insert all the stuff into the corrct tables
        return $isDone;
    }

    public function editQuestion($questionId){
        return $outputArray;
    }
    
    public function saveEditedQuestion($questionId, $body){
        $isDone = false;
        return $isDone;
    }
    
    public function deleteQuestion($questionId){
        $isDone = false;
        return $isDone;
    }
    
//############ private functions ##############
    private function getCreator($creatorId){
        return $outputArray;
    }
}
