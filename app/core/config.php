<?php

if($_SERVER['SERVER_NAME'] == 'localhost'){
  define('ROOT', 'http://localhost/php/Quick-Programming/php-mvc-2025/public');
  define('DBNAME', 'quickprogramming_mvc2024');
  define('DBHOST', 'localhost');
  define('DBUSER', 'imon');
  define('DBPASS', 'p@ssw0rd');
  define('DBDRIVER', '');
} else {
  /*  online */
}

define('APP_NAME', "My Webiste");
define('APP_DESC', "Best website on the planet");

/** true means show errors **/
define('DEBUG', true);