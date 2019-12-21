<?php

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->redirectIfNotAdmin();
    }

    public function users(){
        $_users = new Users();
        $users = $_users->getAll();
        $this->view('adminUsers', 'list of users', [
            'users' => $users
        ]);
    }
    public function deleteUser($id){
        $_user = new Users();
        $user = $_user->destroy($id);
        $this->redirect('admin/users');
    }
}