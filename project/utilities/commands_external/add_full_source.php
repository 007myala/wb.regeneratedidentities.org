<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

    $doctype=$_POST['doctype'];
    $collectionName=$_POST['collectionName'];
    $RA=$results['fname']." ".$results['lname'];
    $action="Object Created";
    $type_log="object";
    $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
    $url_error=$url."&message=2";

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
      $url_success="../../Full_object_edit.php?collectionname=".$doctype."&objectID=".$new_ID;


      $q1_updateEvent="UPDATE `object` SET `UI`='".$new_UI."', `project`='".$project."', `CollectionName`='".$collectionName."' WHERE `objectID` LIKE '".$new_ID."'";
      $query_updateEvent = $conn->prepare($q1_updateEvent);

      //Updating Object Entry
      if( $query_updateEvent->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
      	}

        $field="New Source created with RegID Ending with : ".$new_UI." The object was not associated with any person on creation ";
        $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$new_ID."','".$type_log."','".$TimeDate."','".$RA."','".$field."','".$action."')";
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
