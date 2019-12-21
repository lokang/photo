<?php

class Model extends Db
{

    public function query($query){
        return $this->conn->query($query);
    }

    public function prepare($prepare){
        return $this->conn->prepare($prepare);
    }

}