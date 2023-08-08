<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

    $doctype=$_POST['doctype'];
    $personID=$_POST['personID'];
    $RA=$_POST['RA'];
    $action="Object Created";
    $type_log="object";
    $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."&message=2";

    $pID = $_POST['pID']; 

    // Get the previous page
    if(isset($_POST['page_m'])){
      $page_m = $_POST['page_m'];
    } else {
      $page_m = 1;
    }

    // Get the set entries per page
    if(isset($_POST['pCnt'])){
      $pCnt = $_POST['pCnt'];
    } else {
      $pCnt = 10;
    }

    $error=0;

    $sql = "INSERT INTO `object` (`doctype`) VALUES ('".$doctype."')";
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
      $new_UI=$project."-OB-".$new_ID;
      $url_success="../../object_edit.php?personID=".$personID."&objectID=".$new_ID."&page_m=".$page_m."&pCnt=".$pCnt."&pID=".$pID;

      $q1_connection="INSERT INTO `objects_person` (`personID`,`objectID`) VALUES ($personID,'".$new_ID."')";
      $query_connection = $conn->prepare($q1_connection);
      //Building Connection between person and Event
      if( $query_connection->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
        }


      $q1_updateEvent="UPDATE `object` SET `UI`='".$new_UI."', `project`='".$project."' WHERE `objectID` LIKE '".$new_ID."'";
      $query_updateEvent = $conn->prepare($q1_updateEvent);

      //Updating Event Entry
      if( $query_updateEvent->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
      	}




        $field="New Source created with RegID Ending with : ".$new_UI." for Person with local system ID: ".$personID;
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
