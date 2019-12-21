<?php

class Images extends Model
{

    public function create($data){
        $prepare = $this->prepare("INSERT INTO images (userId, private, name, description, image) VALUES(?, ?, ?, ?, ?)");
        $prepare->execute($data);
        return $this->conn->lastInsertId();
    }

    public function getAll(){
        $prepare = $this->prepare("SELECT images.*, users.name AS userName FROM images JOIN users ON images.userId = users.id WHERE private = 0 ORDER BY createdDate DESC");
        $prepare->execute();
        return $prepare->fetchAll();
    }

    public function get($id){
        $prepare = $this->prepare("SELECT images.*, users.name AS userName FROM images JOIN users ON images.userId = users.id WHERE images.id = ?");
        $prepare->execute([$id]);
        return $prepare->fetch();
    }

    public function destroy($id){
        $prepare = $this->prepare("DELETE FROM images WHERE id =?");
        $prepare->execute([$id]);
        $prepareComment = $this->prepare("DELETE FROM comments WHERE imageId = ?");
        $prepareComment->execute([$id]);
    }

    public function update($id, $private, $name, $description){
        $prepare = $this->prepare("UPDATE images SET private = ?, name = ?, description = ? WHERE id = ?");
        $prepare->execute([$private, $name, $description, $id]);
    }

    public function getAllByUser($id, $onlyPublic=0){
        $sql = "SELECT * FROM images WHERE userId = ?";
        if($onlyPublic){
            $sql .= " AND private=0 ";
        }
        $sql .= "ORDER BY createdDate DESC";
        $prepare = $this->prepare($sql);
        $prepare->execute([$id]);
        return $prepare->fetchAll();
    }

    public function countByUser($id){
        $prepare = $this->prepare("SELECT COUNT(*) FROM images WHERE userId = ? && private = 0");
        $prepare->execute([$id]);
        return $prepare->fetchColumn();
    }
}