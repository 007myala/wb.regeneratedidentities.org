<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';

    $id=$_GET['id'];



    $url=explode("?message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."?message=4";
    $url_success=$url."?message=3";


    $sql = "DELETE FROM `users` WHERE `id` LIKE '".$id."'";
    $stmt = $conn->prepare($sql);
    //Creating New Event
    if( $stmt->execute() ){
        header( 'location: '.$url_success);
      }
      else{
    header( 'location: '.$url_error);
      }



?>
