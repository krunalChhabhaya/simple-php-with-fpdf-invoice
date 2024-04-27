<?php
$host="localhost";
$username="root";
$pass="";
$db="footflex";
$conn=mysqli_connect($host,$username,$pass,$db);
if(!$conn){
die("Database connection error");
}
    
?>