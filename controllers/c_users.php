<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 */
class users_controller extends base_controller 
{
    public function __construct() {
        parent::__construct();
        
        
    }

    public function index()
    {
      echo "You are looking at users-index";
    }
    
    public function signup()
    {
        $this->template->content=view::instance("v_users_signup");
        echo $this->template;
    }
    
    public function p_signup()
    {
        $fmessage1=''; $fmessage2=''; $fmessage3=''; $fmessage4=''; $fmessage5=''; 
        
//        echo '<pre>';
//        print_r($_FILES);
//        echo '<pre>';
        
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["file"]["name"]);
//        
//        echo '<pre>';
//        print_r($temp[1]);
//        
//        echo '</pre>';
        
        //$extension = end($temp);
        
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 1000000)
    && (strtolower($temp[1])=="gif"|| strtolower($temp[1])=="jpeg"|| strtolower($temp[1])=="jpg"|| strtolower($temp[1]) == "png"))
  {
  if ($_FILES["file"]["error"] != 0)
    {
    $fmessage1 = "Return Code: " . $_FILES["file"]["error"] . "<br>";
    
    }
  else
    {
      
    $fmessage2 = "Upload: " . $_FILES["file"]["name"] . "<br>"
    . "Type: " . $_FILES["file"]["type"] . "<br>"
    . "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>"
    . "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" .$_POST['email']. $_FILES["file"]["name"]))
      {
      $fmessage3 = $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" .$_POST['email']. $_FILES["file"]["name"]);
      $fmessage4 = "Stored in: " . "upload/" .$_POST['email']. $_FILES["file"]["name"];
      }
    }
  }
else
  {
  $fmessage5 = "Invalid file";
  
  //info for admin
  $fmessage = $fmessage1 .' '.$fmessage2.' '.$fmessage3.' '.$fmessage4.' '.$fmessage5;     
  
  }
        
        $_POST['created']=Time::now();
        $_POST['password']=  sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token']=  sha1(TOKEN_SALT.$_POST['email']);
        
        $_POST['imagepath']= "/upload/" .$_POST['email'].$_FILES["file"]["name"];
            
        
       $q = 'SELECT COUNT(user_id)
             FROM users
             WHERE email = "'.$_POST['email'].'"'; 
        
        
        $result = DB::instance(DB_NAME)->select_field($q);
        
       if($result){
          $this->template->content=view::instance("v_error");
         echo $this->template; 
          
       }
       else{                
           
         DB::instance(DB_NAME)->insert_row("users",$_POST);
         
         $this->template->content=view::instance("v_users_login");
          echo $this->template;
       }
       
        
        
     
     //Router::redirect('/users/login');
     
    }
    
        public function login()
    {
        $this->template->content=view::instance("v_users_login");
        echo $this->template;
    }
    
    public function p_login()
    {
        $_POST['password']=  sha1(PASSWORD_SALT.$_POST['password']);
        
        $q = 'SELECT token 
             FROM users
             WHERE email = "'.$_POST['email'].'"
             AND password = "'.$_POST['password'].'"';
        
        $token = DB::instance(DB_NAME)->select_field($q);
        
        if($token)
        {
            
            setcookie('token', $token, strtotime('+1 year'),'/' );
            Router::redirect('/');
        }
        else 
        {
            Router::redirect('/');
        }
        
    }
    
    public function profile()
    {
         if(!$this->user)
        {
            //   Router::redirect('/');
            die('Members Only. <a href="/users/login"> Login </a>');
             
        }
         else
        {
          echo 'welcome buddy !';
        }
    }
    
    public function logout()
    {
       $new_token =  sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
       $data = Array('token'=>$new_token);
        
        DB::instance(DB_NAME)->update('users' ,$data, 'WHERE user_id ='. $this->user->user_id);
        setcookie('token','',  strtotime('-1 year'),'/');
        Router::redirect('/');
    }
    
//    public function p_signup_picture()
//    {
//          
//      
//    }   

}

