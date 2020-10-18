<?php



class Comments extends Controller{

    protected $commentModel;
    protected $redirect;

    public function __construct()
    {

        $this->commentModel=$this->model('Comment'); ;
        

    }


    public function store() {


        $data = [

            'body' => '',
            'news_id' => '',
            'user_id' => '',
            'bodyError' => '',
            
            
        ];

        
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'body' => trim($_POST['body']),
                'news_id' => trim($_POST['newsid']),
                'user_id' => trim($_POST['userid']),
                'bodyError' => '',
                
            ];

            if (empty($data['body'])) {
                $data['bodyError'] = 'Please enter text.';
            } 


            if(empty($data['bodyError'])){

                
               if( $this->commentModel->postComment($data)){

                header('location: ' . URLROOT . '/news/show/'.$data['news_id'].'?success=commentPosted');
                exit();

               }
               else {

                    die("Something went wrong!");

               }

               


            }
            



   }
    }
   

    public function delete($commentID){

        

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $this->redirect =  trim($_POST['redirect']);

        $this->redirect = explode('?',$this->redirect);


      }

      
        if($this->commentModel->delete($commentID)){

            header('location: '. $this->redirect[0] .' ');     
            exit();

        }
        else {

            die("Something went wrong!");
        }



    }


}