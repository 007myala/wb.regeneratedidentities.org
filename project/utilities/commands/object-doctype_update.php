<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';
 $RA=$results['fname']." ".$results['lname'];

//***************************************************
// Update doctype
if($_POST['action']=="doc" ){
  if(isset($_POST['doctype'])){
    $column = $_POST['doctype'];
  }else{
      $column="NoSelection";
    }
$field="Document Type : ".$column;
$date = new DateTime();
$objectID=$_POST['objectID'];


//Update entry
  $sql = "UPDATE `object` SET `doctype`=\"".$column."\" WHERE `objectID` = \"".$objectID."\"";
  $stmt = $conn->prepare($sql);
  $type="object";

  if( $stmt->execute() ):

    $action="Document Type Changed";
    $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$objectID."','".$type."','".$TimeDate."','".$RA."','".$field."','".$action."')";
    $stmt_log = $conn->prepare($sql_log);

        if( $stmt_log->execute() )
          {
          $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
            header( 'location: '.$url);
          }
        else	{
          $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
            header( 'location: '.$url);

          }
  else:
    $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
      header( 'location: '.$url);
  endif;
//End of Update Entry

  }
  ?>
