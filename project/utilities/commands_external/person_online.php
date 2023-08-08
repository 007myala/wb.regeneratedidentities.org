<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';


    $tablename="person";
    $ID=$_GET['ID'];
    $value=$_GET['value'];

    $RA=$results['fname']." ".$results['lname'];

    if($value==1){
      $action="Folder Published";
      $field="This folder was published online by ".$RA;
    } else{
      $action="Folder Unpublished";
      $field="This folder was unpublished by ".$RA;
    }

    $url=$_SERVER['HTTP_REFERER'];
    $error=0;


      $q1_publish="UPDATE `".$tablename."` SET `online`='".$value."' WHERE `personID` LIKE '".$ID."'";
      $query_publish = $conn->prepare($q1_publish);

      //Updating Event Entry
      if( $query_publish->execute() ){
        $error=$error+$error;
        }
        else{
        $error=$error+1;
        }


          $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$ID."','person','".$TimeDate."','".$RA."','".$field."','".$action."')";
          $stmt_log = $conn->prepare($sql_log);
          //Updating Log
          if( $stmt_log->execute() ){
            $error=$error+$error;
            }
            else{
            $error=$error+1;
            }



      header( 'location: '.$url);



?>
