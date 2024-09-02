<?php
$localhost="localhost";
$username="root";
$password="";
$database="case2final";
// $database="case2";

session_start();
ob_start();
error_reporting(0);


$connect=mysqli_connect($localhost,$username,$password,$database);
?>
