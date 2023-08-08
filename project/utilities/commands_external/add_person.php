<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';


    $Name=htmlspecialchars($_POST['Name'], ENT_QUOTES);
    $project=$_POST['project'];
    $doctype=$_POST['doctype'];
    $RA=$results['fname']." ".$results['lname'];

    $action="Create New Person";

    $url=$_SERVER['HTTP_REFERER'];
    $url_error=$url."?message=2";

    $error=0;

    $sql = "INSERT INTO `person` (`doctype`,`Name`) VALUES ('".$doctype."','".$Name."')";
    $stmt = $conn->prepare($sql);
    //Creating New Event
    if( $stmt->execute() ){
      $error=$error+$error;
      }
      else{
      $error=$error+1;
      }
      //Extracting last updated ID
      $new_ID= $conn->lastInsertId();

      //Extracting the Max ID for the project
      //Allowing all projects to start with Zero
      $max_UI_query="SELECT COUNT(`personID`) AS `max_ID` FROM `person` where `project`='".$project."'";
      $max_UI_ex = $conn->query($max_UI_query);
      $max_UI_data = $max_UI_ex->fetch(PDO::FETCH_ASSOC);
      $max_UI=$max_UI_data['max_ID']+1; //Increasing the Count by one
      $new_UI=$project.sprintf('%06d', $max_UI);
      $url_success="../../person_edit.php?personID=".$new_ID;


      $q1_updateEvent="UPDATE `person` SET `UI`='".$new_UI."', `project`='".$project."' WHERE `personID` LIKE '".$new_ID."'";
      $query_updateEvent = $conn->prepare($q1_updateEvent);

      //Updating Event Entry
      if( $query_updateEvent->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
        }




        $field="New Person created with RegID : ".$new_UI." <br>Database ID : ".$project;


          $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$new_ID."','person','".$TimeDate."','".$RA."','".$field."','".$action."')";
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
