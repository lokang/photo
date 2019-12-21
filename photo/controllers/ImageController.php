<?php

class ImageController extends Controller
{
    public function edit($id){
        $_images = new Images();
        $image = $_images->get($id);

        if($this->auth['id'] != $image['userId']){
            $this->redirect('home/image/'.$id);
        }

        if($_POST){
            $this->form('name', 'required|min:3|max:150');
            $this->form('description', 'required|min:3|max:15000');
            $private = !empty($_POST['private']) ? 1 : 0;
            $_images->update($id, $private, $_POST['name'], $_POST['description']);
            $this->redirect('home/image/'.$id);
        }

        $this->view('imageEdit', 'Edit', [
          'image' =>$image
        ]);
    }

    public function destroy($id){
        $_images = new Images();
        $image = $_images->get($id);
        if($this->auth['id'] != $image['userId']){
            $this->redirect('home/image/'.$id);
        }
        if ($_POST){
            $_images->destroy($id);
            $this->redirect('home/index');
        }
        $this->view('imageDestroy', 'Delete');
    }
}