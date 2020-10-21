<?php

//MODEL

class User {

    
    private $db;
    

    public function __construct() {

        $this->db = new Database;
    }

    public function numberOfUsers(){

        //$this->db->query("SELECT COUNT(*) FROM users");
        $this->db->query("SELECT * FROM users");
        $this->db->execute();
        return $this->db->rowCount();
       

    }

    public function show($data){

       $this->db->query("SELECT * FROM users WHERE id=:id");
       $this->db->bind(':id', $data);
       return $this->db->single();


    }

    public function showUserNews($data){

        $this->db->query("SELECT * FROM news WHERE user_id=:id");
        $this->db->bind(':id',$data);
        return $this->db->all();


    }

    public function countUserNews($data){

        $this->db->query("SELECT * FROM news WHERE user_id=:id");
        $this->db->bind(':id',$data);
        $this->db->execute();
        return $this->db->rowCount();


    }

    public function showUsersYouFollow($data) {

        $this->db->query("SELECT * FROM users WHERE id IN (SELECT following_user_id FROM follows uf WHERE uf.user_id = :id)");
        $this->db->bind(':id',$data);
        return $this->db->all();


    }

    public  function all(){

        if(isset($_SESSION['user_id'])){

            $id= $_SESSION['user_id'];

            $this->db->query("SELECT * FROM users WHERE id !=:id ");
            $this->db->bind(':id',$id);
            return $this->db->all();

        }

        else {

            $this->db->query("SELECT * FROM users  ");
                    return $this->db->all();

        }
        

        

    }


    public function register($data) {

        
        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {

          
        

        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            
            return $row;
        } else {
            return false;
        }

    }

    public function updateUserInfo($data){

        $this->db->query("UPDATE users SET username =:username , email=:email WHERE id = :id");
        
        $this->db->bind(':username', $data['user_username']);
        $this->db->bind(':email', $data['user_email']);
        $this->db->bind(':id', $data['user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }


    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        
        $this->db->query('SELECT * FROM users WHERE email = :email');

        $this->db->bind(':email', $email);

        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfUserExists($data){

        $this->db->query('SELECT * FROM users WHERE id=:id');

        $this->db->bind(':id', $data);

        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }

    
}
