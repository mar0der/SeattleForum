<?php

class Questions_Model extends Model 
{

    public function __construct($c) 
    {
        parent::__construct($c);
    }
    
    public function getAllQuestions($params = array("category" => "", "tag" => "")){  //default values of cat and tag might be better to be changed to null
        if($params["category"] == "" && $params["tag"] == "") {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date, B.userid
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid");
        } elseif($params["category"] == "") {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date, B.userid
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid
INNER JOIN tags_questions C ON A.id = C.question_id
INNER JOIN tags D ON C.tag_id = D.tag_id WHERE D.tag_id = (:tag)", array(':tag' => $params["tag"]));
        } elseif($params["tag"] == "") {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date, B.userid
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid
INNER JOIN categories C ON A.category_id = C.id
WHERE C.id = :catId", array(':catId' => $params["category"]));
        } else {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date, B.userid
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid
INNER JOIN categories C ON A.category_id = C.id
WHERE C.id = :catId", array(':catId' => $params["category"]));
        }

        foreach($questions as $key => $val) {
            $questions[$key]["latest_answer"] = $this->getLatestAnswer($questions[$key]["question_id"]);
            $questions[$key]["answers_number"] = $this->getNumberOfAnswers($questions[$key]["question_id"]);
            $questions[$key]["tags"] = $this->getTagsForEachQuestion($questions[$key]["question_id"]);
        }
//        echo "<pre>".var_dump(json_encode($questions))."</pre>";
//        var_dump($questions); // debug with this
        return $questions;
    }
    
    public function getAllCategories(){
        $categories = $this->db->select("SELECT category_name, id as category_id FROM categories");

        foreach($categories as $key => $val) {
            $categories[$key]["questions_number"] = $this->numberOfQuestionsInCategory($val["category_id"]);
        }
        //numberOfQuestionsInCategory($categoryId) // call this function for each category found to get it`s number of questions
        return $categories;
    }
    
    public function getAllTags(){
        $tags = $this->db->select("SELECT TEMP.tag_id, TEMP.tag_name FROM (
SELECT A.tag_id as tag_id, A.tag_name, COUNT(question_id) as orderer
FROM tags A INNER JOIN tags_questions B ON A.tag_id = B.tag_id
INNER JOIN questions C ON B.question_id = C.id
GROUP BY A.tag_id, A.tag_name) as TEMP
ORDER BY TEMP.orderer DESC");

        //get all tags and sort them by number of uses
        return $tags;
    }

    public function votePlus($userid, $questionId, $answerId) {
        $initialScore = $this->db->select("SELECT score FROM questions WHERE id = :qId", array(':qId' => $questionId));
        $initialScore[0]["score"]++;
        $this->db->update("questions",
            array("score"      => $initialScore[0]["score"],
            ), "id = " . $questionId);

        $this->db->insert("votes",
            array("user_voting" => $userid,
                  "question_id_voted" => $questionId,
                  "answer_id_voted" => $answerId
            )
        );

        $laterScore = $this->db->select("SELECT score FROM questions WHERE id = :qId", array(':qId' => $questionId));
        return $laterScore[0]["score"];
    }

    public function voteMinus($userid, $questionId, $answerId) {
        $initialScore = $this->db->select("SELECT score FROM questions WHERE id = :qId", array(':qId' => $questionId));
        $initialScore[0]["score"]--;
        $this->db->update("questions",
            array("score"      => $initialScore[0]["score"],
            ), "id = " . $questionId);

        $this->db->insert("votes",
            array("user_voting" => $userid,
                  "question_id_voted" => $questionId,
                  "answer_id_voted" => $answerId
            )
        );

        $laterScore = $this->db->select("SELECT score FROM questions WHERE id = :qId", array(':qId' => $questionId));
        return $laterScore[0]["score"];
    }

    public function checkIfVoted($voterId, $questionId = 0, $answerId = 0) {
        if($questionId != 0) {
            $result = $this->db->select("SELECT COUNT(*) as counter
FROM votes A INNER JOIN questions B ON B.id = A.question_id_voted WHERE B.id = :qId AND A.user_voting = :voterId"
                , array(':qId' => $questionId, ':voterId' => $voterId));
            return $result[0]['counter'];
        } else {
            $result = $this->db->select("SELECT COUNT(*) as counter
FROM votes A INNER JOIN answers B ON B.id = A.answer_id_voted WHERE B.id = :aId AND A.user_voting = :voterId"
                , array(':aId' => $answerId, ':voterId' => $voterId));
            return $result[0]['counter'];
        }
    }
    
// private functions. You can`t call them from outside of this model
    private function numberOfQuestionsInCategory($categoryId){
        $numberOfQuestions = $this->db->select("SELECT COUNT(*) as counter FROM questions WHERE category_id = :cat_id",
            array(':cat_id' => $categoryId));
        return $numberOfQuestions[0]["counter"];
    }

    private function getLatestAnswer($questionId) {
        $result = $this->db->select("SELECT B.userid, B.role, B.username, A.create_date, B.avatar
FROM questions as A INNER JOIN users B ON A.creator_id = B.userid WHERE A.id = :questionId ORDER BY A.create_date DESC LIMIT 1"
            , array(':questionId' => $questionId));
        return $result[0];
    }

    private function getNumberOfAnswers($questionId) {
        $result = $this->db->select("SELECT COUNT(*) as counter FROM answers WHERE question_id = :q_id", array(':q_id' => $questionId));
        return $result[0]["counter"];
    }

    private function getTagsForEachQuestion($questionId) {
        $result = $this->db->select("SELECT distinct A.tag_id, A.tag_name
FROM tags A INNER JOIN tags_questions B ON A.tag_id = B.tag_id WHERE B.question_id = :qId", array(':qId' => $questionId));
        return $result;
    }
}