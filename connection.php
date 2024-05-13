<?php
$ServerName="localhost";
$Username="root";
$Password="";
$DatabaseName="grip_db";

$connect = mysqli_connect($ServerName,$Username,$Password,$DatabaseName);
if(!$connect){
    die("connection unsuccessful");
       
    }
else{
    echo '';
}
?>