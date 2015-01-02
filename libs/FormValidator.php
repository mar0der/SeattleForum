<?php

class FormValidator {

    public function username($username = '', $params = '') {
        if ($params != '') {
            $pattern = $params['pattern'];
            $minLength = $params['minLength'];
            $maxLength = $params['maxLength'];
        } else {
            $minLength = 4;
            $maxLength = 18;
            $pattern = "/.{" . $minLength . "," . $maxLength . "}/";
        }
        if (preg_match($pattern, $username)) {
            return true;
        } else {
            return false;
        }
    }

    public function password($password = '', $params = '') {
        if ($params != '') {
            $pattern = $params['pattern'];
            $minLength = $params['minLength'];
            $maxLength = $params['maxLength'];
        } else {
            $minLength = 6;
            $maxLength = 20;
            $pattern = "/.{" . $minLength . "," . $maxLength . "}/";
        }
        if (preg_match($pattern, $password)) {
            return true;
        } else {
            return false;
        }
    }

    public function email($email = '', $params = '') {
        if ($params != '') {
            $pattern = $params['pattern'];
        } else {
            $pattern = "/./";
        }
        if (preg_match($pattern, $email)) {
            return true;
        } else {
            return false;
        }
    }

    public function image($image = '', $params = '') {
        //put some lohic here
 
        return true;
    }

}
