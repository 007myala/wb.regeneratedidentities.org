<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';

 $objectID=$_POST['objectID'];
 $personUI=$_POST['personUI'];
 $error=0;
 $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
 $url_error=$url."&message=2";
 $url_success=$url."&message=1";
//File upload for Image


  $val=$_FILES['image']['name'];

  $ext = pathinfo($val, PATHINFO_EXTENSION);
  $imglink="../../DataFiles/".$objectID.".".$ext;
  $folder_link="../../DataFiles/".$personUI;
  if (!file_exists($folder_link)) {
    mkdir($folder_link, 0777, true);
}
  $temp = explode(".", $val);

  $newfilename = $folder_link."/".$objectID."-1.".$ext;


  if (move_uploaded_file($_FILES['image']['tmp_name'],$newfilename)) {
    $error=$error+$error;
} else {
    $error=$error+1;
}

  $ext_enter=strtoupper($ext);
  $sql = "UPDATE `object` SET `File`=\"".$newfilename."\",`Format`=\"".$ext_enter."\" WHERE `objectID` = \"".$objectID."\"";

  $stmt = $conn->prepare($sql);

  if( $stmt->execute() ):
    $type_log="object";
    $RA=$results['fname']." ".$results['lname'];
    $field="File Uploaded with Local Name : ".$val;
    $action="File Upload/Update";
    $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$objectID."','".$type_log."','".$TimeDate."','".$RA."','".$field."','".$action."')";
    $stmt_log = $conn->prepare($sql_log);
    //Updating Log
    if( $stmt_log->execute() ){
      $error=$error+$error;
      }
      else{
      $error=$error+1;

      }


  else:
    $error=$error+1;
  endif;


    if($error==0)
    {
        header( 'location: '.$url_success);
        //echo $error;
    }
    else {
      header( 'location: '.$url_error);
      //echo $error;
    }



?>
