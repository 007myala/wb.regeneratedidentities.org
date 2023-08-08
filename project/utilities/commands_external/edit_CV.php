<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

$table=$_POST['table'];
$CV_ID=$_POST['CV_ID'];
//Loading values
$type=$table;
$field="";

foreach ($_POST as $name => $val)
{

     if($name !="ID" &&  $name !="table" && $name !="CV_ID"){
     $val=htmlspecialchars($val,ENT_QUOTES);
     $field=$field.htmlspecialchars($name . ':' . $val) . " <br> ";


     }


}
if($field!=""){

$field_update="";
  foreach ($_POST as $name => $val){

if($name !="ID" && $name!="Status" && $name !="table" && $name !="CV_ID" && $name !="Submitby"){
$val=htmlspecialchars($val,ENT_QUOTES);
$field_update=$field_update.htmlspecialchars('`'.$name.'`=\''.$val.'\',');

}

}
}
$field_update=$field_update."`Status`='".$_POST['Status']."',";
$field_update=substr_replace($field_update,"",-1);

$url=explode("&message", $_SERVER['HTTP_REFERER'])[0];

//Update table with CV Value
$sql = "UPDATE `".$table."` SET ".$field_update." WHERE `ID` = ".$CV_ID;

$stmt = $conn->prepare($sql);
if( $stmt->execute() ):

  //Update Log
  $action="Updated";
      $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$CV_ID."','".$type."','".$TimeDate."','".$_POST['Submitby']."','".$field."','".$action."')";
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







 ?>
