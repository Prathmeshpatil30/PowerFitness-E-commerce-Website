<?php
  //start session
  session_start();


  //create constant to store non repeating values

//  $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//define('SITEURL', $actual_link);

  define('SITEURL','http://localhost:8080/food-order/');
  define('LOCALHOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','food-order');
  $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn)); //DB connection
  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //Selecting DB

?>