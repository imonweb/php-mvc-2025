<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');

// use \Model\user;

Class Home 
{
  use MainController;
  
  public function index()
  {
    $data['username'] = empty($_SESSION['USER']) ? 'User':$_SESSION['USER']->email;

    $user = new \Model\User;
    $this->view('home');
  }
}

