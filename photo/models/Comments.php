<?php

class Comments extends Model{

    public function getAll($imageId){
        $prepare = $this->prepare("SELECT comments.*, users.name AS userName FROM comments JOIN users ON comments.userId = users.id WHERE imageId = ? ORDER BY createdDate DESC");
        $prepare->execute([$imageId]);
        return $prepare->fetchAll();
    }

    public function create($imageId, $userId, $message){
        $prepare = $this->prepare("INSERT INTO comments (imageId, userId, message) VALUES (?, ?, ?)");
        $prepare->execute([$imageId, $userId, $message]);
    }

    public function countAll($imageId){
        $prepare = $this->prepare("SELECT COUNT(*) FROM comments WHERE imageId = ?");
        $prepare->execute([$imageId]);
        return $prepare->fetchColumn();
    }

    public function destroy($id){
        $prepare = $this->prepare("DELETE FROM comments WHERE id = ?");
        $prepare->execute([$id]);
    }

    public function get($id){
        $prepare = $this->prepare("SELECT * FROM comments WHERE id = ?");
        $prepare->execute([$id]);
        return $prepare->fetch();
    }

    public function update($message, $id){
        $prepare = $this->prepare("UPDATE comments SET message = ? WHERE id = ?");
        $prepare->execute([$message, $id]);
    }
}