<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';


    $personID=$_GET['personID'];
    $RA=$results['fname']." ".$results['lname'];
    $action="Object Attached";
    $type_log="object";
    $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."&message=2";

    $error=0;



      $new_ID= $_GET['objectID'];


      $url_success=$url."&message=1";

      $q1_connection="INSERT INTO `objects_person` (`personID`,`objectID`) VALUES ($personID,'".$new_ID."')";
      $query_connection = $conn->prepare($q1_connection);
      //Building Connection between person and Event
      if( $query_connection->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
        }




        $field="Attached exisiting source - Source RegID Ending with ".$new_ID." for Person with RegID: ".$personID;
        $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$new_ID."','".$type_log."','".$TimeDate."','".$RA."','".$field."','".$action."')";
        $stmt_log = $conn->prepare($sql_log);
        //Updating Log
        if( $stmt_log->execute() ){
          $error=$error+$error;
          }
          else{
          $error=$error+1;
          }

          $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$personID."','person','".$TimeDate."','".$RA."','".$field."','".$action."')";
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
  }
  else {
    header( 'location: '.$url_error);
  }






 ?>
