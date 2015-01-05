<?php

class User extends Controller {

    function __construct($controllerName, $actionName) {
        parent::__construct($controllerName, $actionName);
        $paths = Config::getValue('paths');
        $this->questionsModel = $this->loadModel("Questions", $paths['models']);
    }

    public function index() {
        $this->redirect('/user/profile');
    }

    public function register() {
        $this->view->allCategories = $this->questionsModel->getAllCategories();
        $this->view->allTags = $this->questionsModel->getAllTags();
        $this->view->title = Config::getValue('siteName') . ' - Register to our forum!';
        mb_internal_encoding('UTF-8');
        if ($_POST && isset($_POST['gender'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['pass']);
            $confirmPassword = trim($_POST['confirm-pass']);
            $email = trim($_POST['email']);
            $formValidator = new FormValidator();
            $formValidator->checkFields(array(
                'username' => $password,
                'password' => $password,
                'confirmPassword' => $confirmPassword,
                'email' => $email
            ));

            vd($formValidator->errors);



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

    public function edit($getParams = NULL) {
        $this->view->allCategories = $this->questionsModel->getAllCategories();
        $this->view->allTags = $this->questionsModel->getAllTags();
//Save user`s data
        if (isset($_POST) && count($_POST) > 0 && (Auth::isAuth('user/editBtn') or Session::get('userid') == $_POST['userid'])) {

            $postData = $this->sanitizeArray($_POST);
            $errors = array();
            $genders = array('male', 'female', 'unknown');

            vd($postData);
            $avatar = $this->view->dataUser[0]['avatar'];



            if (!$_FILES['pic']['name'] == NULL && count($errors) == 0) {
                $size = 6291456;
                $imagesSize = $_FILES['pic']['size'];
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $_FILES['pic']['tmp_name']);

                if (($mime == 'image/png') || ($mime == 'image/gif') || ($mime == 'image/jpg') || ($mime == 'image/jpeg') || ($mime == 'image/jpe') && $imagesSize < $size) {

                    if (!move_uploaded_file($_FILES['pic']['tmp_name'], '/var/SF/public/images/avatars/' . $_FILES['pic']['name'])) {
                        $errors['uploaded-file'] = "Uploaded file erorr";
                    }
                } else {
                    $errors['uploaded-file'] = "Picture format is invalid";
                }
                if (count($errors) == 0) {
                    unlink("/var/SF/public/images/avatars/$avatar");
                    $avatar = $_FILES['pic']['name'];
                }
                finfo_close($finfo);
            }
            if (count($errors) == 0) {
                if ($this->model->saveEditedUser(USERID, $pass, $email, $role, $realName, $userGender, $avatar)) {
                    
                } else {
                    
                }
            } else {

                $this->view->e = $errors;
            }
        }
//end of saving user`s data
//Load the edit page with user`s data
        if ($getParams != NULL && (Session::get('userid') == $getParams[0] || Auth::isAuth('user/editBtn'))) {
            $editedUserId = $this->sanitize($getParams[0]);
        } else {
            $this->redirect('/error/index');
        }
        $this->view->title = $this->c->siteName . ' - Edit user ' . $editedUserId;
        $this->view->dataUser = $this->model->viewUser($editedUserId);
        $this->view->render();
    }

    public function profile($getParams = '') {

        $this->view->allCategories = $this->questionsModel->getAllCategories();
        $this->view->allTags = $this->questionsModel->getAllTags();
        $this->view->title = $this->c->siteName . ' - User Profile';
        if ($getParams != NULL) {
            $userId = $this->sanitize($getParams[0]);
        } else {
            $userId = Session::get('userid');
            if ($userId == 0) {
                $this->redirect('/questions');
            }
        }

        $this->view->d = $this->model->viewUser($userId);
        $this->view->editBtn = (Auth::isAuth("user/editBtn") or $userId == Session::get("userid"));
        $this->view->deleteBtn = (Auth::isAuth("user/deleteBtn") and $userId != Session::get("userid"));
        $this->view->d[0]["avatar"] = $this->c->paths->avatarUrl . $this->view->d[0]["avatar"];
        $this->view->render();
    }

    public function delete($getParams = '') {
        if ($getParams != NULL && Session::get('userid') != $getParams[0] && Auth::isAuth('user/deleteBtn')) {
            $userId = $this->sanitize($getParams[0]);
        } else {
            $this->redirect('/error/index');
        }

        if ($this->model->deleteUser($userId)) {
            $this->view->message = "You have successfuly deleted user with id " . $userId;
            $this->view->render('user/success');
            die();
        } else {
            $this->redirect('/error/index');
        }
    }

    public function success($message) {
        $this->view->title = Config::getValue('siteName') . " - " . $message;
        $this->view->message = $message;
        $this->view->render();
    }

}
