<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

    $objectID=$_GET['objectID'];
    $RA=$results['fname']." ".$results['lname'];
    $action="Object Deleted";
    $type_log="object";
    $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."&message=2";
    $url_success=$url."&message=1";


    $error=0;
    $field="Object Deleted with ID: ".$objectID."<br><br>";
    $q="SELECT * FROM `object` WHERE `objectID` LIKE '".$objectID."'";
    $query1 = $conn->query($q);
    $list = $query1->fetch(PDO::FETCH_ASSOC);

    unlink($list['File']);


    foreach ($list as $fields) {
    $field=$field."<br>".$fields;
    }



      $q1_connection="DELETE FROM `objects_person` WHERE `objectID` LIKE '".$objectID."'";
      $query_connection = $conn->prepare($q1_connection);
      //Building Connection between person and Event
      if( $query_connection->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;

        }


            $sql_del = "DELETE FROM `object` WHERE `objectID` = ".$objectID;

            $stmt_del = $conn->prepare($sql_del);
            //Deleting in Object table
            if( $stmt_del->execute() ){

              $error=$error+$error;
              }
              else{
              $error=$error+1;

            	}






        $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$objectID."','".$type_log."','".$TimeDate."','".$RA."','".$field."','".$action."')";
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
