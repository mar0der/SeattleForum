<?php

class Question_Model extends Model {

    public function __construct($c) {
        parent::__construct($c);
    }

    public function getQuestion($questionId) {
        $question = $this->db->select("SELECT A.id as question_id, A.create_date, A.score, A.visites, A.subject, A.body, A.edit_date, B.category_name, A.creator_id
FROM questions A INNER JOIN categories B ON A.category_id = B.id WHERE A.id = :qId", array(':qId' => $questionId));

        foreach($question as $key => $val) {
            $question[$key]["creator"] = $this->getCreator($question[$key]["creator_id"]);
            $question[$key]["tags"] = $this->getTagsForQuestion($question[$key]["question_id"]);
        }

        return $question;
    }

    public function addVisit($questionId) {
        $visitsArr = $this->db->select("SELECT visites FROM questions WHERE id = :qId", array(':qId' => $questionId));
        $visits = $visitsArr[0]["visites"];
        $visits++;
        $this->db->update("questions",
            array("visites" => $visits
            ), "id = " . $questionId);
    }
    
    public function addQuestion($creatorId, $categoryId, $subject, $body, $tags){
        //$added_question =
        $this->db->insert("questions",
            array("creator_id"  => $creatorId,
                  "category_id" => $categoryId,
                  "create_date" => date("Y-m-d h:i:s"),
                  "edit_date"   => date("Y-m-d h:i:s"),
                  "subject"     => $subject,
                  "body"        => $body,
                  "score"       => 0,
                  "visites"     => 0
            ));

        $questionIdArr = $this->db->select("SELECT MAX(id) as id FROM questions");
        $questionId = $questionIdArr[0]["id"];

        foreach($tags as $key => $val) {
            if($this->tagExists($val)) {
                $tagId = $this->getTagId($val);
                $this->db->insert("tags_questions",
                    array("question_id" => $questionId,
                          "tag_id"      => $tagId
                    ));
            } else {
                $this->db->insert("tags",
                    array("tag_name" => $val));

                $tagId = $this->getTagId($val);
                $this->db->insert("tags_questions",
                    array("question_id" => $questionId,
                        "tag_id"      => $tagId
                    ));
            }
        }

        //return $added_question; //this is a boolean value
    }

    public function editQuestion($questionId){
        $question_edit = $this->db->select("SELECT A.id as question_id, A.body as question_body
FROM questions A WHERE A.id = :qId", array(':qId' => $questionId));
        return $question_edit;
    }
    
    public function saveEditedQuestion($questionId, $body){
        $updated = $this->db->update("questions",
            array("body"      => $body,
                  "edit_date" => date("Y-m-d h:i:s")
            ), "id = " . $questionId);
        return $updated;
    }
    
    public function deleteQuestion($questionId){
        $deleted = $this->db->delete("questions", "id = " . $questionId);
        return $deleted;
    }
    
//############ private functions ##############
    private function getCreator($creatorId){
        $creator = $this->db->select("SELECT A.score, A.username, A.avatar, A.userid as user_id
FROM users A WHERE userid = :userId", array(':userId' => $creatorId));
        return $creator;
    }

    private function getTagsForQuestion($questionId) {
        $tagsForQuestion = $this->db->select("SELECT A.tag_id as tag_id, A.tag_name
FROM tags A INNER JOIN tags_questions B ON A.tag_id = B.tag_id WHERE B.question_id = :qId", array(':qId' => $questionId));
        return $tagsForQuestion;
    }

    private function tagExists($tagName) {
        $check = $this->db->select("SELECT case when A.counter = 0 then 'yes' else 'no' end as exis FROM
          (SELECT COUNT(*) as counter FROM tags WHERE tag_name = :tag_name) as A", array(":tag_name" => $tagName));

        if($check[0]["exis"] == "yes")
            return true;
        else
            return false;
    }

    private function getTagId($tagName) {
        $tag_id = $this->db->select("SELECT tag_id as tag_id FROM tags WHERE tag_name = :tag_name", array(":tag_name" => $tagName));
        return $tag_id[0]["tag_id"];
    }
}
