<?php

class Users extends Model
{
    public function get($value, $column = 'id'){
        $prepare = $this->prepare("SELECT * FROM users WHERE $column = ?");
        $prepare->execute([$value]);
        return $prepare->fetch();
    }

    public function create($values){
        $prepare = $this->prepare("INSERT INTO users(name, email, password) VALUES(?,?,?)");
        $prepare->execute($values);
        return $this->conn->lastInsertId();
    }

    public function findUserById($id){
        $prepare = $this->prepare("SELECT * FROM users WHERE id = ?");
        $prepare->execute([$id]);
        return $prepare->fetch();
    }

    public function update($id, $name, $email){
        $prepare = $this->prepare("UPDATE users SET name = ?, email= ? WHERE id = ?");
        $prepare->execute([$name, $email, $id]);
    }

    public function destroy($id){
        $prepare = $this->prepare("DELETE FROM users WHERE id = ?");
        $prepare->execute([$id]);

        $prepare = $this->prepare("DELETE FROM comments WHERE userId = ?");
        $prepare->execute([$id]);

        $prepare = $this->prepare("SELECT * FROM images WHERE userId = ?");
        $prepare->execute([$id]);
        $images = $prepare->fetchAll();
        if($images){
            foreach($images as $image){
                unlink('images/'.$image['image']);
            }
        }
        $prepare = $this->prepare("DELETE FROM images WHERE userId = ?");
        $prepare->execute([$id]);
    }

    public function getAll(){
        $prepare = $this->prepare("SELECT * FROM users");
        $prepare->execute();
        return $prepare->fetchAll();
    }

    public function passwordUpdate($id, $newPassword){
        $prepare = $this->prepare("UPDATE users SET password = ? WHERE id = ?");
        $prepare->execute([$newPassword, $id]);
    }
}