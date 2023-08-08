<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

$personID=$_GET['personID'];
$listID=$_GET['listID'];
$attack_id=$_GET['ID'];

$url="../../events_person.php";
$url=$url."?personID=".$personID;

//Update ORDER
$sql="Select MIN(`listorder`) AS `listno` From `person_event` where `personID`='".$personID."' AND `listorder`>'".$listID."'";

  $stmt = $conn->query($sql);
  $stmt_data = $stmt->fetch(PDO::FETCH_ASSOC);
  $listorder_onedown= $stmt_data['listno'];


  $sql ="Update `person_event`
          Set `listorder`='".$listID."'
            Where `listorder`='".$listorder_onedown."'";
            $stmt = $conn->prepare($sql);

        echo $sql."<br>";
$stmt = $conn->prepare($sql);
if( $stmt->execute() ):
  $sql ="Update `person_event`
      Set `listorder`='".$listorder_onedown."'
          Where `ID`='".$attack_id."'";
          $stmt = $conn->prepare($sql);
          echo $sql."<br>";

            if( $stmt->execute() ):

              header( 'location: '.$url);
            else:

              header( 'location: '.$url);
            endif;

else:
header( 'location: '.$url);
endif;

 ?>
