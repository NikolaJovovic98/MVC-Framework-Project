<?php
    //Ovo je basic kontroler kojeg ce svaki kontroler naslijediti jer smo u njemu definisali 2 vazne funckije
    //prva jeste model tj kreiranje specificnog modela tako sto cemo ga navesti kao parametar nakon toga cemo ga rekvajerovati
    //i naravno vratiti novu instancu toga modela druga funckija je view koja ima 2 parametra prvi je putanja do view-a tj sami view a drugi 
    //parametar jeste niz podataka onda provjeravamo da li postoji taj view koji smo mu proslijedili i ukoliko postoji mi ga require a ako ga nema
    //posaljemo poruku
    class Controller {

        
        public function model($model) {
            

            require_once '../app/models/' . $model . '.php';
        

            return new $model();
        }


        public function view($view, $data = []) {

            if (file_exists('../app/views/' . $view . '.php')) {

                require_once '../app/views/' . $view . '.php';
            } 
            
            else {

                die("View does not exists.");
                
            }


        }
    }
