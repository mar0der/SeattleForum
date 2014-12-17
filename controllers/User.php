<?php

class User extends Controller {

    function __construct($c, $controllerName, $actionName) {
        parent::__construct($c, $controllerName, $actionName);
    }

    public function index() {
        $this->redirect('/user/profile');
        $this->view->render();
    }

    public function register() {
        $this->view->title = 'Register to our forum!';
        mb_internal_encoding('UTF-8');
        if ($_POST && isset($_POST['gender'])) {
            $errors = array();
            $username = trim($_POST['username']);
            $regexName = '/[a-zA-Z]/';
            $pass = trim($_POST['pass']);
            $confirmPass = trim($_POST['confirm-pass']);
            $email = trim($_POST['email']);
            $regexEmail = '/\b[a-zA-Z_0-9]+@[a-zA-Z0-9]+\.[a-z]{2,6}\b/';
            $gender = (int) trim($_POST['gender']);
            $realName = trim($_POST['first-name']);
            $genders = array('male', 'female', 'unknown');
            $userGender = $genders[$gender];
            $avatar = $_FILES['pic']['name'];
            if (count($_FILES) == 1) {
                $size = 16291456;
                $imagesSize = $_FILES['pic']['size'];
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $_FILES['pic']['tmp_name']);
                if (($mime == 'image/png') || ($mime == 'image/gif') || ($mime == 'image/jpg') || ($mime == 'image/jpeg') || ($mime == 'image/jpe') && $imagesSize < $size) {
                    $avatarPath = Config::getValue('paths');
                    if (!move_uploaded_file($_FILES['pic']['tmp_name'], $avatarPath['avatarFolder'] . $_FILES['pic']['name'])) {
                        $errors['uploaded-file'] = "Uploaded file erorr";
                    }
                    $avatarPath = Config::getValue('paths');
                } else {
                    $errors['uploaded-file'] = "Picture format is invalid";
                }
                finfo_close($finfo);
            } else {
                $errors['uploaded-file'] = "Please select picture";
            }

            $data = array(
                'username' => $username,
                'password' => $pass,
                'email' => $email,
                'role' => 'user',
                'first_name' => $realName,
                'registered_on' => date('Y-m-d H:i:s'),
                'last_login' => '',
                'score' => '0',
                'gender' => $userGender,
                'ip' => $_SERVER['REMOTE_ADDR'],
                'avatar' => $avatar
            );

            if ((mb_strlen($username) < 4 || mb_strlen($username) > 25) || (preg_match('/\b[a-zA-Z0-9_\.-]+\b/', $username)) == 0) {
                $errors['username'] = 'Invalid username';
            }
            if ((mb_strlen($realName) < 4 || mb_strlen($realName) > 25) || (preg_match('/\b[a-zA-Z]+\b/', $realName)) == 0) {
                $errors['first-name'] = 'Invalid First name';
            }
            if ($gender > 2 || $gender < 0) {

                $errors['gender'] = 'Invalid gender';
            }
            if ($pass != $confirmPass || (mb_strlen($pass) < 6 || mb_strlen($pass) > 64)) {
                $errors['pass-error'] = "Invalid password";
            }
            if (preg_match($regexEmail, $email) != 1) {
                $errors['email'] = 'Invalid Email';
            }
            if ($this->model->isUserExist($username)) {
                $errors['username'] = "This user is exist";
            }
            //check if we have errors
            if (count($errors) == 0) {
                if ($this->model->addUser($data)) {
                    $this->redirect('/questions');
                } else {

                    $this->redirect('/error');
                }
            } else {
                $data['gender'] = $gender;
                $this->view->e = $errors;
                $this->view->d = $data;
                $this->view->render();
                die();
            }
        }
        $this->view->render();
    }

    public function edit() {
        $this->view->title = 'user/edit profile';
        $this->model->saveEditedUser(4, "pass", "afaf@faf.com", "realname", "user", "male", "avatar"); //this will call edit function and edit user 1 
        $this->view->render();
    }

    public function profile($getParams = '') {
        $this->view->title = 'User Profile';
        if (isset($getParams) && $getParams != '') {
            $userId = $this->sanitize($getParams[0]);
        } else {
            $userId = Session::get('userid');
            if($userId == 0){
                $this->redirect('/questions');
            }
        }
        $paths = Config::getValue("paths");
        $this->view->d = $this->model->viewUser($userId); //this will get the details for user 1
        $this->view->d[0]["avatar"] = $paths["avatarUrl"] . $this->view->d[0]["avatar"];
        $this->view->render();
    }

    public function delete() {
        //add credentials check
        $this->view->title = 'view/profile';
        $this->model->deleteUser(1); //this delete user 1
        $this->view->render();
    }

}
