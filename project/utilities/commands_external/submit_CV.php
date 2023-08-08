<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

$table=$_POST['table'];
//Loading values
$type=$table;
$field="";
foreach ($_POST as $name => $val)
{

     if($name !="ID" && !empty($val) && $name !="table"){
       $val1=htmlspecialchars($val,ENT_QUOTES);
     $field=$field.htmlspecialchars($name . ': ' . $val1) . " <br> ";


     }


}
if($field!=""){

$column_names="";
$values="";
  foreach ($_POST as $name => $val){

if(!empty($_POST[$name] && $name !="table") ){

$column_names=$column_names."`".$name."`,";
$val1=htmlspecialchars($val,ENT_QUOTES);
$values=$values."'".$val1."',";

}
}
}
$column_names = rtrim($column_names,',');
$values = rtrim($values,',');
$url=explode("&message", $_SERVER['HTTP_REFERER'])[0];

//Update table with CV Value
$sql = "INSERT INTO `".$table."` (".$column_names.") VALUES (".$values.")";


$stmt = $conn->prepare($sql);
if( $stmt->execute() ):
  //Adding Listorder
  $new_ID= $conn->lastInsertId();
  $q1_updatelistorder="UPDATE `".$table."` SET `listorder`='".$new_ID."' WHERE `ID` LIKE '".$new_ID."'";
  
  $query_updatelistorder = $conn->prepare($q1_updatelistorder);
  if( $query_updatelistorder->execute() ):
    //Update Log
    $action="Added";
        $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$new_ID."','".$type."','".$TimeDate."','".$_POST['Submitby']."','".$field."','".$action."')";
        $stmt = $conn->prepare($sql);
        if( $stmt->execute() ):
          $url=$url."&message=1";
        header( 'location: '.$url);

      	else:
          $url=$url."&message=2";
        header( 'location: '.$url);
      	endif;

  else:
    $url=$url."&message=3";
  header( 'location: '.$url);
  endif;

else:
  $url=$url."&message=4";
//header( 'location: '.$url);
endif;







 ?>
