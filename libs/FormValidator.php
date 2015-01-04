<?php

class FormValidator {

    private $errors = [];

    public function username($username = '', $params = '') {
        //change this logic to make parameters required. This is unsafe now!
        if ($params != '') {
            $pattern = $params['pattern'];
            $minLength = $params['minLength'];
            $maxLength = $params['maxLength'];
        } else {
            $minLength = 4;
            $maxLength = 18;
            $pattern = "/^[^!@#$%^&*()\-+=\\\/\'\"|?<>]{" . $minLength . "," . $maxLength . "}$/";
        }
        if (preg_match($pattern, $username)) {
            return true;
        } else {
            $this->setErrors('username', "The username contains some illegal characters (!.@,%,^,&,*,(, ) etc..");
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
            $pattern = "/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?!.*\s).{" . $minLength . "," . $maxLength . "}$/";
        }
        if (preg_match($pattern, $password)) {
            return true;
        } else {
            $this->setErrors('password', "Psword must be between " . $minLength . " and " . $maxLength . "and to contain at least one capital letter, small letter and digit");
            return false;
        }
    }

    public function email($email = '', $params = '') {
        if ($params != '') {
            $pattern = $params['pattern'];
            if (preg_match($pattern, $email)) {
                return true;
            } else {
                $this->setErrors("password", "Invalid email address!");
                return false;
            }
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                $this->setErrors("password", "Invalid email address!");
                return false;
            }
        }
    }

    public function image($image = '', $params = '') {
        //put some logic here

        return true;
    }

    //setters and getters
    public function getErrors($error = 'all') {
        if ($error != "all") {
            if (isset($this->errors[$error])) {
                return $this->errors[$error];
            } else {
                return false;
            }
        } else {
            return $this->errors;
        }
    }

    public function setErrors($errorName, $errorValue) {
        if (isset($this->errors[$errorName])) {
            $this->errors[$errorName] .= $errorValue . "\n";
        } else {
            $this->errors[$errorName] = $errorValue . "\n";
        }
    }

}
