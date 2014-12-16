<?php

class Questions_Model extends Model 
{

    public function __construct($c) 
    {
        parent::__construct($c);
    }
    
    public function getAllQuestions($params = array("category" => "", "tag" => "")){  //default values of cat and tag might be better to be changed to null
        if($params["category"] == "" && $params["tag"] == "") {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid");
        } elseif($params["category"] == "") {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid
INNER JOIN tags_questions C ON A.id = C.question_id
INNER JOIN tags D ON C.tag_id = D.tab_id WHERE D.tag_name = (:tag)", array(':tag' => $params["tag"]));
        } elseif($params["tag"] == "") {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid
INNER JOIN categories C ON A.category_id = C.id
WHERE C.category_url = :catURL", array(':catURL' => $params["category"]));
        } else {
            $questions = $this->db->select("SELECT A.id as question_id, A.subject, A.score, A.visites, B.username, B.avatar, A.create_date
FROM questions as A INNER JOIN users as B ON A.creator_id = B.userid
INNER JOIN categories C ON A.category_id = C.id
WHERE C.category_url = :catURL", array(':catURL' => $params["category"]));
        }

        foreach($questions as $key => $val) {
            $questions[$key]["latest_answer"] = $this->getLatestAnswer($questions[$key]["question_id"]);
            $questions[$key]["answers_number"] = $this->getNumberOfAnswers($questions[$key]["question_id"]);
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
SELECT A.tab_id as tag_id, A.tag_name, COUNT(question_id) as orderer
FROM tags A INNER JOIN tags_questions B ON A.tab_id = B.tag_id
INNER JOIN questions C ON B.question_id = C.id
GROUP BY A.tab_id, A.tag_name) as TEMP
ORDER BY TEMP.orderer DESC");

        //get all tags and sort them by number of uses
        return $tags;
    }
    
// private functions. You can`t call them from outside of this model
    private function numberOfQuestionsInCategory($categoryId){
        $numberOfQuestions = $this->db->select("SELECT COUNT(*) as counter FROM questions WHERE category_id = :cat_id",
            array(':cat_id' => $categoryId));
        return $numberOfQuestions[0]["counter"];
    }

    private function getLatestAnswer($questionId) {
        $result = $this->db->select("SELECT B.role, B.username, A.create_date, B.avatar
FROM questions as A INNER JOIN users B ON A.creator_id = B.userid WHERE A.id = :questionId ORDER BY A.create_date DESC LIMIT 1"
            , array(':questionId' => $questionId));
        return $result[0];
    }

    private function getNumberOfAnswers($questionId) {
        $result = $this->db->select("SELECT COUNT(*) as counter FROM answers WHERE question_id = :q_id", array(':q_id' => $questionId));
        return $result[0]["counter"];
    }
}