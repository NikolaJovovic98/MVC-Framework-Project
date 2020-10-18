<?php



class Comment {



    private $db;
    

    public function __construct() {

        $this->db = new Database;
    }

 
    public function postComment($data){

        $this->db->query('INSERT INTO comments (body, news_id, user_id) VALUES(:body, :news_id, :user_id)');

        //Bind values
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':news_id', $data['news_id']);
        $this->db->bind(':user_id', $data['user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function delete($commentID){

        $this->db->query("DELETE FROM comments WHERE id=:id");
        $this->db->bind(':id', $commentID);

          
          if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        


    }



}