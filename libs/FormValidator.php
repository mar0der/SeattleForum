<?php

class FormValidator {

    public function username($username = '', $params = '') {
        //change this logic to make parameters required. This is unsafe now!
        if ($params != '') {
            $pattern = $params['pattern'];
            $minLength = $params['minLength'];
            $maxLength = $params['maxLength'];
        } else {
            $minLength = 4;
            $maxLength = 18;
            $pattern = "/^[^!@#$%^&*()\-+=\\\/\'\"|?<>]{".$minLength.",".$maxLength."}$/";
        }
        if (preg_match($pattern, $username)) {
            return true;
        } else {
            //improve the messaging system. Take it from parameters
            return "The username contains some illegal characters (!.@,%,^,&,*,(, ) etc..";
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
            $pattern = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).{".$minLength.",".$maxLength."}$/";
        }
        if (preg_match($pattern, $password)) {
            return true;
        } else {
            return "Psword must be between ".$minLength." and ".$maxLength. "and to contain at least one capital letter, small letter and digit";
        }
    }

    public function email($email = '', $params = '') {
        if ($params != '') {
            $pattern = $params['pattern'];
            if (preg_match($pattern, $email)) {
                return true;
            } else {
                return "Invalid email address!";
            }
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }else{
                return "Invalid email address!";
            }
        }
    }

    public function image($image = '', $params = '') {
        //put some logic here

        return true;
    }

}
