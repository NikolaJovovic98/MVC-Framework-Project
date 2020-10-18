<?php

/*
Model je mjesto dje su podaci smjesteni on sluzi za interakciju sa podacima izmedju baze podataka.
Dakle u modelu radimo stvari kao sto su upiti...model ima svoju instancu baze podataka tako da ima
 sve njene metode i preko modela radimo upite tj SELECT INSERT itd te
 metode modela kasnije u kontroleru koristimo nad modelom kojim smo tamo stvorili

 Ovo je News_model koji prestavlja blueprint za News dakle ovo je apstraktan pojam preuzet iz realnog svijeta 
 glavni zadatak modela ne samo ovog vec svakog jeste da vrsi neke upite nad bazom podataka i te upite kao rezultat vrati kroz
 svoju metodu u prethodnom primjeru kod News controllera imali smo metodu index u kojoj smo imali asocijativni niz $data koji je kao svoj 
 name key imao 'news' koji je sadrzio podatke izvucene iz newsModel->all() e ta metoda all koja se izvrsava nad istancom tog modela se nalazi
 upravo odje i njena funkcija jeste da izvrsi query nad bazom podataka i da vrati all() ( funckija koja se nalazi u Database.php) 

 Prva stvar koja se radi kod svakog modela jeste instanciranje baze podataka u kontroleru dakle imamo privatnu varijablu $db u koju cemo ubaciti
 novu bazu podataka (Database.php)


*/


class News_model {



    private $db;
    

    public function __construct() {

        $this->db = new Database;
    }

    public  function all(){

    
        $this->db->query("SELECT * FROM news ORDER BY id DESC ");
        return $this->db->all();

    }


    public function show($newsID){

        $this->db->query("SELECT * FROM news WHERE id=:id");
        $this->db->bind(':id', $newsID);
        return $this->db->single();
 
 
     }

    public function store($data) {

        
        $this->db->query('INSERT INTO news(user_id, title,synopsis, body) VALUES(:user_id, :title,:synopsis ,:body)');

        //Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':synopsis', $data['synopsis']);
        $this->db->bind(':body', $data['body']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($data){

        $this->db->query("DELETE FROM news WHERE id=:id");
        $this->db->bind(':id', $data);

          
          if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        

    }

    public function showUser($userID){

        //$this->db->query("SELECT users.id, users.username FROM news INNER JOIN users ON news.user_id=users.id");
        $this->db->query("SELECT * FROM users WHERE id=:id");
        $this->db->bind(':id', $userID);
        return $this->db->single();


    }

    
    public function showUsersComments(){

        $this->db->query("SELECT * FROM users ");
        return $this->db->all();


    }




    public function showComments($newsID){

      
        $this->db->query("SELECT * FROM comments WHERE news_id=:id ORDER BY date DESC");
        $this->db->bind(':id',$newsID);
        return $this->db->all();



    }



}