<?php

class Rating extends Model
{

    public function create($imageId, $userId, $type){
        $prepare = $this->prepare("INSERT INTO rating (userId, imageId, type) VALUES (?, ?, ?)");
        $prepare->execute([$userId, $imageId, $type]);
    }

    public function get($userId, $imageId){
        $prepare = $this->prepare("SELECT * FROM rating WHERE userId = ? AND imageId = ?");
        $prepare->execute([$userId, $imageId]);
        return $prepare->fetch();
    }

    public function update($id, $type){
        $prepare = $this->prepare("UPDATE rating SET type = ? WHERE id = ?");
        $prepare->execute([$type, $id]);
    }

    public function countVotes($imageId, $type){
        $prepare = $this->prepare("SELECT COUNT(*) FROM rating WHERE imageId = ? AND type = ?");
        $prepare->execute([$imageId, $type]);
        return $prepare->fetchColumn();
    }
}