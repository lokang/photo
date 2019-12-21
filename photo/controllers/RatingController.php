<?php

/**
 * Created by PhpStorm.
 * User: lokang
 * Date: 8/12/19
 * Time: 11:20 PM
 */
class RatingController extends Controller
{
    public function index($imageId, $type){
        if(!$this->auth) return false;

        $_rating = new Rating();
        $rating = $_rating->get($this->auth['id'], $imageId);
        if($rating){
            if($type != $rating['type']){
                $_rating->update($rating['id'], $type);
            }
        }else{
            $_rating->create($imageId, $this->auth['id'], $type);
        }
    }
    public function getUpVote($imageId){
        $_rating = new Rating();
        echo $_rating->countVotes($imageId, 'up');
    }

    public function getDownVote($imageId){
        $_rating = new Rating();
        echo $_rating->countVotes($imageId, 'down');
    }
}