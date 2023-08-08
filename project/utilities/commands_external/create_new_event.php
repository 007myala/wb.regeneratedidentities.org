<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

    $doctype=$_POST['doctype'];
    $Type=$_POST['Type'];
    $personID=$_POST['personID'];
    $RA=$_POST['RA'];
    $action="Event Created";
    $type_log="event";
    $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."&message=2";

    $error=0;

    $sql = "INSERT INTO `event` (`doctype`) VALUES ('".$doctype."')";
    $stmt = $conn->prepare($sql);
    //Creating New Event
    if( $stmt->execute() ){
      $error=$error+$error;
      }
      else{
      $error=$error+1;
    	}

      $new_ID= $conn->lastInsertId();
      $project=$_POST['project'];
      $new_UI=$project."-E-".$new_ID;
      $url_success="../../event_edit.php?personID=".$personID."&eventID=".$new_ID;

      $q1_connection="INSERT INTO `person_event` (`personID`,`eventID`,`Type`,`Flag`) VALUES ($personID,'".$new_ID."','".$Type."',1)";
      $query_connection = $conn->prepare($q1_connection);
      //Building Connection between person and Event
      if( $query_connection->execute() ){
        $error=$error+$error;
        $event_person_ID= $conn->lastInsertId();
        $q1_addlistorder="UPDATE `person_event` SET `listorder`='".$event_person_ID."' WHERE `ID` LIKE '".$event_person_ID."'";
        $query_addlistorder = $conn->prepare($q1_addlistorder);
        if($query_addlistorder->execute() ){
            $error=$error+$error;
        }else{
          $error=$error+1;
        }

        }
        else{
        $error=$error+1;
        }


      $q1_updateEvent="UPDATE `event` SET `UI`='".$new_UI."', `project`='".$project."', `Event_Type`='".$Type."' WHERE `eventID` LIKE '".$new_ID."'";
      $query_updateEvent = $conn->prepare($q1_updateEvent);

      //Updating Event Entry
      if( $query_updateEvent->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
      	}




        $field="New Event created with RegID:".$new_ID." for Person with local system ID: ".$personID;
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
