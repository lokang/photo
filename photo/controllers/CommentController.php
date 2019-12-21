<?php

class CommentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->redirectIfNotAuth();
    }

    public function edit($id)
    {
        $_comments = new Comments();
        $comment = $_comments->get($id);
        if ($this->auth['id'] != $comment['userId']) {
            $this->redirect('home/image/' . $comment['imageId'] . '#comments');
        }

        if ($_POST) {
            $this->form('message', 'required|min:3|max:15000');
            $_comments->update($_POST['message'], $id);
            $this->redirect('home/image/' . $comment['imageId'] . '#comments');
        }
        $this->view('commentEdit', 'Edit', [
            'comment' => $comment
        ]);
    }

    public function destroy($id)
    {
        $_comments = new Comments();
        $comment = $_comments->get($id);
        if ($this->auth['id'] != $comment['userId']) {
            $this->redirect('home/image/' . $comment['imageId'] . '#comments');
        }
        if ($_POST) {
            $_comments->destroy($id);
            $this->redirect('home/image/' . $comment['imageId'] . '#comments');
        }
        $this->view('commentDestroy', 'Delete', [
            'comment' => $comment
        ]);
    }
}