<?php
  /*
    Ovo je dio dje vrsimo implementaciju logike rutiranja tj fecovanja url-a i manipulisanja sa njegovim djelovima
    logika i zamisao jeste ta da nakon URLROOT tj korijena naseg sajta koji je u ovom slucaju http://localhost/mvcinternet/ 
    izdvojimo kao elemente niza sve sto slijedi posle toga ovim redosljedom : 

    1.Prva rijec prestavlja kontroler
    2.Druga rijec prestavlja metodu toga kontrolera (akciju)
    3.Treca rijec prestavlja parametar koji se prosljedjuje toj prethodnoj metodi 

    http://localhost/mvcinternet/news/show/4

    Kontroler: News.php
    Metod/Akcija:Show
    Parametar:4 

    u prevodu idi na kontroler News.php i pozovi njegovu metodu show u koju ce se proslijediti parametar 4 
    
    Pravimo 4 protected varijable od kojih je Kontroler postavljen na Home i na metodu index taj kontroler se smatra za Home Controller
    tj onaj koji se prvi ucita kad posjetimo sajt.Sljedece sto radimo jeste da u konstruktoru definisemo $url koji dobijamo metodom getUrl
    koja vrace url (npr : news/show/4) zatim se pitamo ukoliko je $url=null tj nema nikavu vrijednost tj nalazimo se na http://localhost/mvcinternet/
    onda $url[0] tj kontroler postaje ovaj vec definisani Home onda ga require da bi ga odma stvorili i onda instaciramo taj kontroler
    sa new $url[0] a kao parametar zadajemo njegov metod ...else ukoliko imamo neke elemente onda prvi element $url[0] postaje kontroler
    drugi postaje metoda a treci parametar (ako ih ima) onda provjeravamo da li prvo postoji taj kontroler tako sto cemo u ctrlPath
    staviti  '../app/controllers/' . ucwords($url[0]). '.php'; u prevodu ucwords povecava prvo slovo pa ce na kraj ispasti
     '../app/controllers/' News '.php'; dakle postoji onda provjeravamo pomocu funckije file_exists i ukoliko je tacna onda
     rekvarujemo taj kontroler zajedno sa njegovom metodom kao parametar kad ga instaciramo na sami kraj dodajemo funckiju 
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params); koja poziva metodu i u isto vrijeme joj 
      salje niz parametara (?) sad idemo na kontroler News

   */
  class Core {  

  
    protected $currentController = 'Home';                                                                                    
    protected $currentMethod = 'index';
    protected $params = [];
    protected $ctrlPath;


    public function __construct(){

      $url = $this->getUrl();

      if($url==NULL){
       
        $url[0]=$this->currentController;
        require_once '../app/controllers/'. $this->currentController . '.php';
        $this->currentController = new $url[0]($this->currentMethod);


      }
      else {

        $this->currentController=$url[0];
        $this->currentMethod = isset($url[1]) ? $url[1] :'';
        $this->params=array_slice($url, 2);


        //  '../app/controllers/' . ucwords($url[0]). '.php'

        $this->ctrlPath = '../app/controllers/' . ucwords($url[0]). '.php';

        if(file_exists($this->ctrlPath)){

          require_once '../app/controllers/'. $this->currentController . '.php';
          $this->currentController = new $url[0]($this->currentMethod);




        }
        else {

           die("Location does not exist on this server. 404");

        }

      }
      
    //print_r($url);

    


      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

      
    }



    public function getUrl(){

      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }


  }


