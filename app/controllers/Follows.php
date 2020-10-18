<?php

//KONTROLER

class Follows extends Controller {

     protected $followModel;
    

    public function __construct() {

        $this->followModel = $this->model('Follow');
        
    }




    public function store () {

        $data = [

            'signed_in_user_id' => '',
            'following_user_id' => '',
            
        ];

        
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [

                'signed_in_user_id' => trim($_POST['userID']),
                'following_user_id' => trim($_POST['followingUserID']),
               
                
            ];


            if( $this->followModel->follow($data)){

                header('location: ' . URLROOT . '/users/show/'.$data['following_user_id'].'?success=followed');
                exit();

               }
               else {

                    die("Something went wrong!");

               }

    }

} 

public function delete(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [

                'signed_in_user_id' => trim($_POST['userID']),
                'following_user_id' => trim($_POST['followingUserID']),
               
                
            ];


            if($this->followModel->unfollow($data)){

                
                header('location: ' . URLROOT . '/users/show/'.$data['following_user_id'].'?success=unfollowed');
                exit();

            }

            else {

                die("Something went wrong.");
            }

        }



}


}
