<?php

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->redirectIfNotAuth();
    }

    public function upload(){
        if($_POST){
           $private = !empty($_POST['private']) ? 1 : 0;
           $targetFile = 'images/'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            $_images = new Images();
            $imageId = $_images->create([$this->auth['id'], $private, $_POST['name'], $_POST['description'], $_FILES['image']['name']]);
            $this->redirect('home/image/'.$imageId);
        }
        $this->view('accountUpload', 'upload');
    }

    public function index(){
        $this->view('accountIndex', 'account');
    }

    public function logout(){
        setcookie('id', false, -1, '/');
        setcookie('key', false, -1, '/');
        $this->redirect('home/login');
    }

    public function profile(){
        if($_POST){
            $this->form('name', 'required|min:4|max:150');
            $this->form('email', 'required|min:3|max:20');
            $_users = new Users();
            $_users->update($this->auth['id'], $_POST['name'], $_POST['email']);
            $this->redirect('account/profile');
        }
        $this->view('accountProfile', 'profile');
    }

    public function destroy(){
        if($_POST){
            $_users = new Users();
            $_users->destroy($this->auth['id']);
            $this->redirect('account/logout');
        }
        $this->view('accountDestroy', 'Delete');
    }

    public function photos($id){
        $_images = new Images();
        $images = $_images->getAllByUser($id, $id!=$this->auth['id']);
        $this->view('accountPhotos', 'Photos', [
            'images' => $images
        ]);
    }

    public function changePassword(){
        if($_POST){
            $this->form('newPassword', 'requires|min:6');
            $_user = new Users();
            $user = $_user->passwordUpdate($this->auth['id'], hash('sha512', $_POST['newPassword']));
            $this->redirect('home/login');
        }
        $this->view('accountChangePassword', 'change password');
    }
}