<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

    $eventID=$_GET['eventID'];
    $RA=$results['fname']." ".$results['lname'];
    $action="Event Deleted";
    $type_log="event";
    $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."&message=2";
    $url_success=$url."&message=1";
    echo $eventID;

    $error=0;
    $field="Event Deleted with ID: ".$eventID."<br><br>";
    $q="SELECT * FROM `event` WHERE `eventID` LIKE '".$eventID."'";
    $query1 = $conn->query($q);
    $list = $query1->fetch(PDO::FETCH_ASSOC);
    foreach ($list as $fields) {
    $field=$field."<br>".$fields;
    }

    $sql = "DELETE FROM `event` WHERE `eventID` LIKE '".$eventID."'";
    $stmt = $conn->prepare($sql);
    //Creating New Event
    if( $stmt->execute() ){
      $error=$error+$error;
      }
      else{
      $error=$error+1;
    	}


      $q1_connection="DELETE FROM `person_event` WHERE `eventID` LIKE '".$eventID."'";
      $query_connection = $conn->prepare($q1_connection);
      //Building Connection between person and Event
      if( $query_connection->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
        }






        $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$eventID."','".$type_log."','".$TimeDate."','".$RA."','".$field."','".$action."')";
        $stmt_log = $conn->prepare($sql_log);
        //Updating Log
        if( $stmt_log->execute() ){
          $error=$error+$error;
          }
          else{
          $error=$error+1;
          }

      


  if($error==0)
  {
      header( 'location: '.$url_success);
      //echo $error;
  }
  else {
    header( 'location: '.$url_error);
    //echo $error;
  }






 ?>
