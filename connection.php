<?php
$localhost="localhost";
$username="root";
$password="";
$database="case2final";
// $database="case2";

session_start();
ob_start();

$connect=mysqli_connect($localhost,$username,$password,$database);
?>
