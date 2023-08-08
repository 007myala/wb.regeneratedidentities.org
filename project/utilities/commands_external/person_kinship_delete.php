<?php
    session_start();
    date_default_timezone_set('America/Toronto');
    $date = new DateTime();
    $TimeDate = $date->format('Y-m-d H:i:s');
     require '../database_SS.php';
     require '../user-check-utilities-subfolders.php';

     $q="SELECT * FROM `person_kinship` where `ID`='".$_GET['ID']."'";
     $query = $conn->query($q);
     $delete_entry = $query->fetch(PDO::FETCH_ASSOC);

     $q="SELECT * FROM `person` where `personID`='".$delete_entry['personID']."'";
     $query1 = $conn->query($q);
     $delete_person1 = $query1->fetch(PDO::FETCH_ASSOC);

     if($delete_entry['Flag']==1){
     $q="SELECT * FROM `person` where `personID`='".$delete_entry['person_related']."'";
     $query1 = $conn->query($q);
     $delete_person2 = $query1->fetch(PDO::FETCH_ASSOC);
     $delete_person2_info = $delete_person2['UI'];
      }
      if($delete_entry['Flag']==0)
      {
        $delete_person2_info = $delete_entry['person_related'];
      }

      $sql = "DELETE FROM `person_kinship` WHERE `ID`='".$_GET['ID']."'";
      $stmt = $conn->prepare($sql);
      if( $stmt->execute() ):

      //Update Log
      $RA=$results['fname']." ".$results['lname'];
      $action="Deleted";
      $type="person";
      $field="Relationship (Kinship) Removed between individuals with RegIDs:<br> ".$delete_person1['UI']." and ".$delete_person2_info."<br>Type: ".$delete_entry['Type'];
          $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$delete_entry['personID']."','".$type."','".$TimeDate."','".$RA."','".$field."','".$action."')";
          $stmt = $conn->prepare($sql);
          if( $stmt->execute() ):
        		$message = 1;

        	else:
        		$message = 2;
        	endif;



          $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];
          $url=$url."&message=1";


          header( 'location: '.$url);

        else:
          $url=$url."&message=2";
        header( 'location: '.$url);

  	endif;





 ?>
