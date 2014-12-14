<?php

class Questions_Model extends Model 
{

    public function __construct($c) 
    {
        parent::__construct($c);
    }
    
    public function getAllQuestions($params = array("category" => 0, "tag" => 0)){  //default values of cat and tag might be better to be changed to null
        //var_dump($outputArray); // debug with this
        return $outputArray;
    }
    
    public function getAllCategories(){
        //numberOfQuestionsInCategory($categoryId) // call this function for each category found to get it`s number of questions
        return $outputArray;
    }
    
    public function getAllTags(){
        //gett all tags and sort them by number of usees
        return $outputArray;
    }
    
// private functions. You can`t call them from outside of this model
    private function numberOfQuestionsInCategory($categoryId){
        return $numberOfQuestions;
    }
}