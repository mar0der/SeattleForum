<?php

class Question_Model extends Model {

    public function __construct($c) {
        parent::__construct($c);
    }

    public function getQuestion($questionId) {
        $question = $this->db->select("SELECT A.subject, A.body, A.edit_date, B.category_name, A.creator_id
FROM questions A INNER JOIN categories B ON A.category_id = B.id WHERE A.id = :qId", array(':qId' => $questionId));

        foreach($question as $key => $val) {
            $question[$key]["creator"] = $this->getCreator($question[$key]["creator_id"]);
            $question[$key]["tags"] = $this->getTagsForQuestion($question[$key]["question_id"]);
        }

        return $question;
    }
    
    public function addQuestion($questionId, $creatorId, $body, $tags){
        $isDone = false;
        //insert all the stuff into the corrct tables
        return $isDone;
    }

    public function editQuestion($questionId){
        $question_edit = $this->db->select("SELECT A.id as question_id, A.body as question_body
FROM questions A WHERE A.id = :qId", array(':qId' => $questionId));
        return $question_edit;
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
        $creator = $this->db->select("SELECT A.score, A.username, A.avatar, A.userid as user_id
FROM users A WHERE userid = :userId", array(':userId' => $creatorId));
        return $creator;
    }

    private function getTagsForQuestion($questionId) {
        $tagsForQuestion = $this->db->select("SELECT A.tab_id as tag_id, A.tag_name
FROM tags A INNER JOIN tags_questions B ON A.tab_id = B.tag_id WHERE B.question_id = :qId", array(':qId' => $questionId));
        return $tagsForQuestion;
    }
}
