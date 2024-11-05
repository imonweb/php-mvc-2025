<?php 

namespace Controller;

defined('ROOTPATH') OR exit('Access Denied!');

Class _404 
{
  use MainController;
  public function index()
  {
    echo "404 Page Not Found";
  }
}
