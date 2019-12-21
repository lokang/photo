<?php

class HomeController extends Controller
{
    public function index(){
        $_images = new Images();
        $_rating = new Rating();
        $images = $_images->getAll();

        $this->view('homeIndex', 'Home', [
            'images' => $images,
            '_images' => $_images,
            '_rating' => $_rating
        ]);
    }

    public function login(){
        if($this->auth){
            $this->redirect('account/index');
        }
        if($_POST){
            $this->form('email', 'required|min:10|max:150');
            $this->form('password', 'required|min:3|max:10');
            $_users = new Users();
            $user = $_users->get($_POST['email'], 'email');

            if($user && $user['password'] == hash('sha512', $_POST['password'])){
                setcookie('id', $user['id'], time()+3600*24*30, '/');
                setcookie('key', hash('sha512', $_POST['password']), time()+3600*24*30, '/');
                header('Location: /account/index');
                exit;
            } else{
                $this->setError('Your details are incorrect');
                $this->back();
            }
        }
        $this->view('homeLogin', 'login');
    }

    public function register(){
        if($this->auth){
            $this->redirect('account/index');
        }
        if($_POST){
            $this->form('name', 'required|min:3|max:150');
            $this->form('email', 'required|min:10|max:150');
            $this->form('password', 'required|min:3|max:10');

            $_users = new Users();
            $id = $_users->create([
                $_POST['name'],
                $_POST['email'],
                hash('sha512', $_POST['password'])
            ]);
            setcookie('id', $id, time()+3600*24*30, '/');
            setcookie('key', hash('sha512', $_POST['password']), time()+3600*24*30, '/');
            header('Location: /account/index');
            exit;
        }
        $this->view('homeRegister', 'register');
    }

    public function image($id){
        $_images = new Images();
        $image = $_images->get($id);
        if(!$image){
            $this->redirect('');
        }
        $_comments = new Comments();
        $comments = $_comments->getAll($image['id']);
        if($_POST){
            $this->form('message', 'required|min:3|max:1000');

            $_comments->create($image['id'], $this->auth['id'], $_POST['message']);
            $this->redirect('home/image/'.$id);
        }
        $this->view('homeImage', 'Image', [
            'image' => $image,
            'comments' => $comments
        ]);
    }

    public function contact(){
        if(empty($_SESSION['random'])){
            $_SESSION['random'] = rand(11111,99999);
        }
        if($_POST){
            $this->form('email', 'required|min:10|max:150');
            $this->form('message', 'required|min:3|max:10000');
            $this->form('captcha', 'required|min:5|max:5');
            if($_POST['captcha'] == $_SESSION['random']){
                $this->sendEmail('info@lokang.com', 'Request from user on lokang.com', $_POST['message'], $_POST['email']);
                $this->redirect('home/index');
            }
            unset($_SESSION['random']);
            $this->redirect('home/contact');
        }
        $this->view('homeContact', 'Contact');
    }

    public function recoverPassword(){
        if($_POST){
            $this->form('email', 'required|min:10|max:150');
            $_user = new Users();
            if(!$user = $_user->get($_POST['email'], 'email')){
                // error
            }

            $newPassword =  $this->randomString(10);
            $_user->passwordUpdate($user['id'], hash('sha512', $newPassword));

            //send email function
            //redirectWithInfo

        }
        $this->view('homeRecoverPassword', 'Recover Password');
    }
}