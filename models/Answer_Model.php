<?php

class Answer_Model extends Model 
{
    public function __construct($c) 
    {
        parent::__construct($c);
    }

    public function getAllAnswersForQuestion($questionId) {
        $result = $this->db->select("SELECT A.id as answer_id, A.body as answer_body, A.edit_date, A.creator_id
FROM answers A WHERE A.question_id = :qId", array(':qId' => $questionId));

        foreach($result as $key => $val) {
            $result[$key]["creator"] = $this->getAnswerCreator($result[$key]["creator_id"]);
        }
    }

    public function addAnswer($questionId, $creatorId, $answerBody) {
        //???
    }

    public function editAnswer($answerId) {
        $answer_edit = $this->db->select("SELECT A.id as answer_id, A.body as answer_body
FROM answers A WHERE A.id = :ansId", array(':ansId' => $answerId));
        return $answer_edit;
    }

    public function saveEditedAnswer($answerId, $answerBody) {

    }

    public function deleteAnswer($answerId) {

    }

    //private functions
    private function getAnswerCreator($creatorId) {
        $creator = $this->db->select("SELECT A.avatar, A.userid as user_id, A.username
FROM users A INNER JOIN answers B ON A.userid = B.creator_id WHERE B.creator_id = :creatorId", array(':creatorId' => $creatorId));
        return $creator;
    }
}