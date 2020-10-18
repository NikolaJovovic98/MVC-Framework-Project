<?php



class Home extends Controller {

    protected $currentMethod;

    public function __construct($currentMethod) {

        
        //$this->userModel = $this->model('User');
         
       return $this->currentMethod=$currentMethod;

    }

    public function index() {

        /*
        $data = [
            'title' => 'Home page',
             'foobar' => 'Nights in white satin'
        ];
*/
   // $data = ['jedan','dva','tri'];

        $this->view('index');
    }

    public function about(){

        

        $this->view('about');


    }


}
