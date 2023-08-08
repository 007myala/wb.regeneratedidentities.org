<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

$table=$_GET['table'];
$CV_ID=$_GET['CV_ID'];
$RA=$results['fname']." ".$results['lname'];
//Loading Place data
$q_place="SELECT * FROM `".$table."` WHERE `ID` = ".$CV_ID;
$query_CV = $conn->query($q_place);
$place_data = $query_CV->fetch(PDO::FETCH_ASSOC);
//Loading values
$type=$table;
$field="Deleted Contolled Vocaublary<br>Table Name : ".$table."<br> System ID : ".$CV_ID."<br><br>";
$action="Deleted";
$q1="DESCRIBE `".$table."`";
$query_CL = $conn->query($q1);

while($Available_Names = $query_CL->fetch(PDO::FETCH_ASSOC)){
  if($Available_Names['Field']=="ID" || $Available_Names['Field']=="Status"){

    }else{
      if($place_data[$Available_Names['Field']]!="0"){
        $f_name="<b>".str_replace("_"," ",$Available_Names['Field'])."</b>";
        $field=$field.$f_name." : ".$place_data[$Available_Names['Field']]."<br>";
    }

}}

if($field!=""){

  $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];

  //Update table with CV Value
  $sql = "DELETE FROM `".$table."` WHERE `ID` = ".$CV_ID;

  $stmt = $conn->prepare($sql);
  if( $stmt->execute() ):

    //Update Log
    $action="Deleted CV";
        $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('CV','".$type."','".$TimeDate."','".$RA."','".$field."','".$action."')";
        $stmt = $conn->prepare($sql);
        if( $stmt->execute() ):
          $url=$url."&message=1";
       header( 'location: '.$url);

      	else:
          $url=$url."&message=2";
        header( 'location: '.$url);
      	endif;

  else:
    $url=$url."&message=2";
  header( 'location: '.$url);
  endif;


}

 ?>
