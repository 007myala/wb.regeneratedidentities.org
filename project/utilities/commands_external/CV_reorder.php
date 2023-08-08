<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

$table=$_GET['table'];


$url="../../CV_update.php";
$url=$url."?table=".$table;

//Update ORDER
$sql="Select * From `".$table."` where `ID` != 0 ORDER BY `Name`";


  $stmt = $conn->query($sql);

  $k=1;
  While($data = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $sql1 ="Update `".$table."`
        Set `listorder`= '".$k."'
            Where `ID`='".$data['ID']."'";
    echo $sql1;
    $k=$k+1;
    $stmt1 = $conn->prepare($sql1);
    if( $stmt1->execute() ):
      header( 'location: '.$url);
    else:
      header( 'location: '.$url);
    endif;


  }




 ?>
