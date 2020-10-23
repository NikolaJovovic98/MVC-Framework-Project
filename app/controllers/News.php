<?php

/* 
Kontroleri sluze za interakciju sa korisnikom i jedina komponenta koja suradjuje sa Modelom dakle korisnik 
zahtijeva stvari od kontrolera koji te stvari pronalazi u Modelu,kontroleri su zasluzni i za redirektovanje 
na druge stranice rad sa url-om vracanje view-a i slicno.Dakle logika je da kod kontrolera imamo odredjene metode 
tj akcije te metode se zasnivaju na CRUD tj create read update delete metodama svaki kontroler bi trebalo da ima ove
 metode ...npr metoda index sluzi za prikazivanje svih user-a ...metoda show sluzi za prikazivanje jednog user-a ...dakle 
 u toj metodi pravimo odgovarajuci model i podatke toga modela smjestamo u neku varijablu koju prosljedjujemo view-u dakle
  u metodu vracemo odgovarajuci view zajedno sa podacima.


   Kontroler nasljedjuje klasu Controller i ima jednu promjenjivu $newsModel koja prestavlja upravo model News sa kojim manipulisemo kroz metode
   u kontroleru se primjenjuje CRUD create read update delete ...tj svaki kontroler bi trebao da sadrzi ove metode za kreiranje objekta
   za citanje objekta za nadogradjivanje objekta i za njegovo brisanje u susitini CREATE (Store/Create) READ(index/show) UPDATE(update) DELETE(delete)
   te metode treba da postoje za te pojmove prvo u konstruktoru kontrolera stvaramo taj njegov model (Pogledati Controller.php) samim tim 
   stvorili smo model News tj taj jedan objekat nad kojim vrsimo neke akcije 

*/

class News extends Controller{

    protected $newsModel;

    public function __construct()
    {

        $this->newsModel=$this->model('News_model'); ;
        

    }

    /*  

    Najosnovnija metoda je index koja sluzi za prikazivanje svih objekata nekog modela tj svih podataka iz nekog modela 
    Ideja je da kod metoda kontrolera imamo neki asocijativni niz koji ce kao name key da ima neki poznati pojam u ovom slucaju to je news
    a kao njegovu vrijednost imacemo newsModel->all dje je all metoda koja se nalazi u modelu News(Pogledati model News) i glavna ideja
    da nakon toga vracemo view (pogedati Controller.php) koji ima 2 parametra prvi je koji view vracemo u ovom slucaju to je users/news
    a drugi je prosljedjivanje podataka tj proslijedimo asocijativni niz $data kako bi mu mogli pristupiti u tom view-u sad idemo U News_Model

    */

    public function index(){

        $data = [

            'news' => $this->newsModel->all(),
            //'users'=> $this->newsModel->showUser()

        ];


    $this->view('users/news',$data);


    }

    public function show($newsID){

        $news = [

            'news'=>$this->newsModel->show($newsID)      

        ];

        $data = [
          
            'news'=>$this->newsModel->show($newsID),
            'user'=> $this->newsModel->showUser($news['news']->user_id),
            'comments' => $this->newsModel->showComments($newsID),
            'usersComments'=>$this->newsModel->showUsersComments()
        ];

        $this->view('users/showOneNews',$data);

      


    }




    /*
   public function create() {


    $this->view('users/write_news');


   }
   */

   public function store(){

    
    if(isset($_SESSION['user_id'])){



        $data = [

            'user_id' => '',
            'title' => '',
            'synopsis' => '',
            'body' => '',
            'titleError' => '',
            'synopsisError' => '',
            'bodyError' => '',
            
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'user_id' => trim($_POST['user_id']),
                'title' => trim($_POST['title']),
                'synopsis' => trim($_POST['synopsis']),
                'body' => trim($_POST['body']),
                'titleError' => '',
                'synopsisError' => '',
                'bodyError' => '',
                
            ];

            if (empty($data['title'])) {
                $data['titleError'] = 'Please enter title.';
            } 

            if (empty($data['synopsis'])) {
                $data['synopsisError'] = 'Please enter synopsis.';
            } 

            if (empty($data['body'])) {
                $data['bodyError'] = 'Please enter body.';
            } 

            
           

            if(empty($data['titleError']) && empty($data['bodyError']) && empty($data['synopsisError'])){

                if ($this->newsModel->store($data)) {
                   
                    header('location: ' . URLROOT . '/news/store?success=news');
                    exit();
                } else {
                    die('Something went wrong.');
                }


            }



   }

   $this->view('users/write_news',$data);




    }

    else {

        
        header("HTTP/1.0 404 Not Found");

    }

}

public function delete($newsID) {

    if( $this->newsModel->delete($newsID)){

        header('location: ' . URLROOT . '/news/index?success=newsDeleted');

    }
     
    else {

        die('Something went wrong.');

    }
}

public function search () {


    

    $data = [

        'search-text' => '',
        'news' => '',
        'search-error'=>''
        
        
    ];

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $news = $this->newsModel->countSearch($data);

    $data = [

        'search-text' => $_POST['search_text'],
        'news' => $this->newsModel->countSearch($data),
        'search-error'=>''

    ];

    $news = $this->newsModel->countSearch($data);

 $data = [

        'search-text' => $_POST['search_text'],
        'news' => $news,
        'search-error'=>''

    ];

    
    
    if($news==0 || empty($data['search-text'])){


        $data = [

            'search-text' => $_POST['search_text'],
            'news' => '',
            'search-error'=>'Error'
    
        ];


    }

    else {


        $news = $this->newsModel->search($data);


                $data = [

                        'search-text' => $_POST['search_text'],
                        'news' =>$news,

                    ];



    }


    
    


  }

  $this->view('users/newsSearch',$data);

}

}