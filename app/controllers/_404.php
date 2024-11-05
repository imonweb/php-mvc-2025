<?php 

defined('ROOTPATH') OR exit('Access Denied!');

Class _404 
{
  use Controller;
  public function index()
  {
    echo "404 Page Not Found";
  }
}
