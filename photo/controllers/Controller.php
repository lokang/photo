<?php

class Controller
{
    public $auth = false;

    public function view($fileName, $title=false, $vars=[]){
        foreach($vars as $key=>$value){
            $$key = $value;
        }
        include 'views/header.php';
        include 'views/'.$fileName.'.php';
        include 'views/footer.php';
    }

    public function __construct(){
        if(!empty($_COOKIE['id']) && !empty($_COOKIE['key'])){
            $_users = new Users();
            $user = $_users->findUserById($_COOKIE['id']);
            if($user && $user['password'] == $_COOKIE['key']){
                $this->auth = $user;
            }
        }
    }

    protected function redirect($url){
        header('Location: /'.$url);
        exit;
    }

    public function redirectIfNotAuth(){
        if(!$this->auth){
            $this->redirect('home/login');
        }
    }

    public function isAdmin(){
        if($this->auth && $this->auth['id']==1){
            return true;
        }
        return false;
    }

    public function redirectIfNotAdmin(){
        if(!$this->isAdmin()){
            $this->redirect('');
        }
    }

    protected function back(){
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    }

    public function form($name, $rules){
        $_SESSION['post'] = $_POST;
        $ruleArray = explode('|', $rules);
        foreach($ruleArray as $rule){
            if($rule == 'required'){
                if(empty($_POST[$name])){
                    $_SESSION['errors'] = 'The field '.$name.' is required';
                    $this->back();
                }
            }elseif(preg_match('/^min:([0-9]+)$/', $rule, $match)){
                if(strlen($_POST[$name]) < $match[1]){
                    $_SESSION['errors'] = 'The minimum length of '.$name .' is '.$match[1];
                    $this->back();
                }
            }elseif(preg_match('/^max:([0-9]+)$/', $rule, $match)){
                if(strlen($_POST[$name]) > $match[1]){
                    $_SESSION['errors'] = 'The maximum length of '.$name .' is '.$match[1];
                    $this->back();
                }
            }
        }

    }

    public function errors(){
        if(!empty($_SESSION['errors'])){
            $errors = '<div class ="alert alert-danger">'. $_SESSION['errors'] .'</div>';
            unset($_SESSION['errors']);
            return $errors;
        }
    }

    protected function setError($message){
        $_SESSION['errors'] = $message;
    }

    private function value($name){
        if(!empty($_SESSION['post'][$name])){
            $post = $_SESSION['post'][$name];
            unset($_SESSION['post'][$name]);
            return $post;
        }
    }

    protected function sendEmail($to, $subject, $message, $from='info@lokang.com'){
        $headers = 'From: '.$from . "\r\n" .
            'Reply-To: '. $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
    }

    protected function randomString($length=8){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $result = false;
        for($i=0; $i<$length; $i++){
            $result .= $characters[rand(0,60)];
        }
        return $result;
    }
}