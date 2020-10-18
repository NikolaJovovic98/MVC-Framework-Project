<?php

//MODEL

class Follow {

    
    private $db;
    

    public function __construct() {

        $this->db = new Database;
    }


    public function follow($data) {

        $this->db->query('INSERT INTO follows(user_id,following_user_id) VALUES(:userId,:followingUserId)');

        
        $this->db->bind(':userId', $data['signed_in_user_id']);
        $this->db->bind(':followingUserId', $data['following_user_id']);
       

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }


    }

    public function unfollow($data){

        $this->db->query("DELETE FROM follows WHERE user_id=:userID AND following_user_id=:followingUserID");
        $this->db->bind(':userID', $data['signed_in_user_id']);
        $this->db->bind(':followingUserID', $data['following_user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }


    }

   
}
