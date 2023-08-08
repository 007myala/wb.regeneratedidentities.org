<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

$table=$_GET['table'];
$listID=$_GET['listID'];


$url="../../CV_update.php";
$url=$url."?table=".$table;


//Update ORDER
$sql="Select `listorder`+1 AS `listno` From `".$table."` where `ID`='".$listID."'";


  $stmt = $conn->query($sql);
  $stmt_data = $stmt->fetch(PDO::FETCH_ASSOC);
  $list_prioviousID= $stmt_data['listno'];



$sql ="Update `".$table."`
    Set `listorder`=`listorder`-1
        Where `listorder`='".$list_prioviousID."'";
        echo $sql;
$stmt = $conn->prepare($sql);
if( $stmt->execute() ):
  $sql ="Update `".$table."`
          Set `listorder`=`listorder`+1
            Where `ID`='".$listID."'";
            $stmt = $conn->prepare($sql);

            if( $stmt->execute() ):
              echo $sql;
              header( 'location: '.$url);
            else:

              header( 'location: '.$url);
            endif;

else:
header( 'location: '.$url);
endif;

 ?>
