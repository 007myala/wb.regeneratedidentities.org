<?php
    session_start();
    date_default_timezone_set('America/Toronto');
    $date = new DateTime();
    $TimeDate = $date->format('Y-m-d H:i:s');
     require '../database_SS.php';
     require '../user-check-utilities-subfolders.php';

     $q="SELECT * FROM `person_event` where `ID`='".$_GET['ID']."'";
     $query = $conn->query($q);
     $delete_entry = $query->fetch(PDO::FETCH_ASSOC);


     if($delete_entry['Flag']==1){
       $q="SELECT * FROM `person` where `personID`='".$delete_entry['personID']."'";
       $query1 = $conn->query($q);
       $delete_person = $query1->fetch(PDO::FETCH_ASSOC);

       $delete_person_UI = $delete_person['UI'];
      }
      if($delete_entry['Flag']==0)
      {
        $delete_person_UI = $delete_entry['personID'];
      }

      $sql = "DELETE FROM `person_event` WHERE `ID`='".$_GET['ID']."'";
      $stmt = $conn->prepare($sql);
      if( $stmt->execute() ):

      //Update Log
      $RA=$results['fname']." ".$results['lname'];
      $action="Deleted";
      $type="event";
      $field="Relationship removed for Event RegID:<br> ".$delete_entry['eventID']." <br> Removed  Person Details:<br>RegID: ".$delete_person_UI."<br>Event Type: ".$delete_entry['Type'];
          $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$delete_entry['eventID']."','".$type."','".$TimeDate."','".$RA."','".$field."','".$action."')";
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
