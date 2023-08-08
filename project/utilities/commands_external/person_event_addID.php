<?php
    session_start();
    date_default_timezone_set('America/Toronto');
    $date = new DateTime();
    $TimeDate = $date->format('Y-m-d H:i:s');
     require '../database_SS.php';
     require '../user-check-utilities-subfolders.php';

     $personID=$_POST['personID'];
     $eventID=$_POST['eventID'];
     $Type=$_POST['Type'];
     $personID_related=$_POST['personID_related'];
     $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];

     $q="SELECT * FROM `person` where `personID`='".$personID."'";
     $query1 = $conn->query($q);
     $add_entry1 = $query1->fetch(PDO::FETCH_ASSOC);


     $q="SELECT * FROM `person` where `personID`='".$personID_related."'";
     $query1 = $conn->query($q);
     $add_entry2 = $query1->fetch(PDO::FETCH_ASSOC);


     $sql = "INSERT INTO `person_event` (`personID`,`eventID`,`Type`,`Flag`) VALUES ('".$personID_related."','".$eventID."','".$Type."','1')";
      $stmt = $conn->prepare($sql);
      if( $stmt->execute() ):
        $new_ID= $conn->lastInsertId();
        $q1_updatelistorder="UPDATE `person_event` SET `listorder`='".$new_ID."' WHERE `ID` LIKE '".$new_ID."'";
        echo $q1_updatelistorder;
        $stmt_updatelistorder = $conn->prepare($q1_updatelistorder);
        $k=$stmt_updatelistorder->execute();


      //Update Log
      $RA=$results['fname']." ".$results['lname'];
      $action="Adding Relationship for Event";
      $type="event";
      $field="Relationship Added between person with RegIDs ".$add_entry1['UI']." and ".$add_entry2['UI']."<br>Event Type: ".$Type;
          $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$eventID."','".$type."','".$TimeDate."','".$RA."','".$field."','".$action."')";
          $stmt = $conn->prepare($sql);
          if( $stmt->execute() ):
        		$message = 1;

        	else:
        		$message = 2;
        	endif;


          $url_success=$url."&message=1";
          header( 'location: '.$url_success);

        else:
          $url_error=$url."&message=2";
        header( 'location: '.$url_error);

  	endif;


 ?>
