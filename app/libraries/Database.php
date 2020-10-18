<?php

/*

Ovo je glavni fajl dje se zapravo kacimo na bazu podataka prethodno definisanim pojmovima kao sto su DB_HOST itd dodjeljujemo ih 
privatnim varijablama koje smo kreirali nakon toga u konstruktoru pomocu PDO vrsimo samu koneckiju na bazu podataka .Ovaj fajl pored toga ima i svoje
metode koje ne vrse nikakve upite nad bazom podataka vec samo pretstavljaju prepared statments tj vec pripremljene metode sa radom sa bazom
podataka kao sto su execute() , query(), all(), single (), bind() dakle njih cemo stalno pozivati u metodama 



*/


    class Database {
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;

        private $statement;
        private $dataBase;
        private $error;

        public function __construct() {
            $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            
            try {
                $this->dataBase = new PDO($conn, $this->dbUser, $this->dbPass, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //Metoda za pisanje query-ja
        public function query($sql) {

            $this->statement = $this->dataBase->prepare($sql);

        }

        //Bind-ovanje vrijednosti
        public function bind($parameter, $value, $type = null) {

            switch (is_null($type)) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            $this->statement->bindValue($parameter, $value, $type);
        }

        //Execute the prepared statement
        public function execute() {
            return $this->statement->execute();

        
        }

        //Return an array
        public function all() {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function allAssoc() {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_ASSOC);
        }

        //Return a specific row as an object
        public function single() {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
          // return $this->statement->fetchObject(PDO::FETCH_OBJ);
        }

        //Get's the row count
        public function rowCount() {
            return $this->statement->rowCount();
        }

        

    }
