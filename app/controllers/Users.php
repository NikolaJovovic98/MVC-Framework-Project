<?php

//KONTROLER

class Users extends Controller
{

    protected $userModel;
    protected $count;
    protected $user_news = array();

    public function __construct()
    {

        $this->userModel = $this->model('User');
    }


    public function index()
    {


        $numOfUsers = $this->userModel->numberOfUsers();


/*
        for ($i = 1; $i <= $numOfUsers; $i++) {

            // $this->user_news = $this->userModel->countUserNews($i);

            array_push($this->user_news, $this->userModel->countUserNews($i));
        }
       */

        $data = [

            'users' => $this->userModel->all(),
            'usersNum' => $this->userModel->numberOfUsers(),
            

        ];

        $this->view('users/usersList', $data);
    }


    public function show($userID)
    {

        $user_data = $this->userModel->show($userID);
        $user_news = $this->userModel->showUserNews($userID);
        $user_news_count = $this->userModel->countUserNews($userID);

        if (isset($_SESSION['user_id'])) {

            $user_followers_object = $this->userModel->showUsersYouFollow($_SESSION['user_id']);

            foreach ($user_followers_object as $follower) {

                if ($follower->id == $userID) {

                    $this->count++;
                }
            }
        }


        $data = [

            'user' => $user_data,
            'user-news' => $user_news,
            'singed-In-User-Followers' => $this->count,
            'user-news-count' => $user_news_count


        ];

        $this->view('users/showOneUser', $data);
    }

    public function showUserProfile($userID)
    {

        $user_data = $this->userModel->show($userID);
        $user_news = $this->userModel->showUserNews($userID);
        $users_you_follow = $this->userModel->showUsersYouFollow($userID);
        $count_followers = $this->userModel->countUsersYouFollow($userID);


        $data = [

            'user' => $user_data,
            'user-news' => $user_news,
            'users-you-follow' => $users_you_follow,
            'count-follow'=>$count_followers,

        ];

        $this->view('users/showUserProfile', $data);
    }


    public function register()
    {

        $data = [

            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken.';
                }
            }

            // Validate password on length, numeric values,
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter password.';
            } elseif (strlen($data['password']) < 6) {
                $data['passwordError'] = 'Password must be at least 6 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Password must be have at least one numeric value.';
            }

            //Validate confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login?success=registration');
                    exit();
                } else {
                    die('Something went wrong.');
                }
            }
        }


        $this->view('users/register', $data);
    }

    public function login()
    {

        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];
            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {


                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                    if ($loggedInUser) {
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['passwordError'] = 'Password or username is incorrect. Please try again.';

                        $this->view('users/login', $data);
                    }  
            }
        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/login', $data);
    }

    public function edit(){

        $this->view('users/edit');

    }

    public function update(){


        $data = [

            'user_id'=> '',
            'user_username'=> '',
            'user_email'=> '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [

                'user_id' => trim($_POST['userid']),
                'user_username' => trim($_POST['username']),
                'user_email' => trim($_POST['email']),
                
            ];


            if($this->userModel->updateUserInfo($data)){

               
                
                $_SESSION['username'] = $data['user_username'];
                $_SESSION['email'] = $data['user_email'];
                header('location: ' . URLROOT . '/users/showUserProfile/'. $data['user_id'] .'?success=update');
                exit();

            }
            else {

               die("Something went wrong!");

            }





        }

    }


    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/home/index');
    }

    public function createAdminSession($user)
    {
        $_SESSION['admin_id'] = $user->id;
        $_SESSION['admin_username'] = $user->username;
        header('location:' . URLROOT . '/home/index');
    }


    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);

        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        header('location:' . URLROOT);
    }
}
