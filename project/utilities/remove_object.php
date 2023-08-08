<?php
session_start();
date_default_timezone_set('America/Toronto');

require 'user-check-utilities.php';
require 'database_SS.php';
try{
  $q1="SELECT * FROM `object` WHERE `objectID` LIKE '".$_GET['objectID']."'";
  $query = $conn->query($q1);
  $object_data = $query->fetch(PDO::FETCH_ASSOC);


//***************************************************
// Update doctype
$objectID = $_GET['objectID'];
$panned_id=sprintf("%06d", $objectID);

$field="Object ID : ".$object_data['project'].$panned_id;
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
$RA = $results['fname']."".$results['lname'];

//Update entry
  $sql = "UPDATE `object` SET `personID`=\"NA\" WHERE `objectID` = \"".$objectID."\"";
  $stmt = $conn->prepare($sql);

  if( $stmt->execute() ):

    $action="Object Removed";
    $sql_log = "INSERT INTO `log_person` (`personID`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$_GET['personID']."','".$TimeDate."','".$RA."','".$field."','".$action."')";
    $stmt_log = $conn->prepare($sql_log);

        if( $stmt_log->execute() )
          {
          $message = 1;
          }
        else	{
          $message = 2;

          }
  else:
    $message = 3;
  endif;
//End of Update Entry



}
catch (Exception $e) {
    print "something went wrong, caught yah! n";
}
finally{

 //header back
header("Location: ".$_SERVER['HTTP_REFERER']);
}

 ?>
