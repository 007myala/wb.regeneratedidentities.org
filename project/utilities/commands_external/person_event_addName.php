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
     $person_related=$_POST['Name'];
     $url=explode("&message", $_SERVER['HTTP_REFERER'])[0];

     $q="SELECT * FROM `person` where `personID`='".$personID."'";
     $query1 = $conn->query($q);
     $add_entry = $query1->fetch(PDO::FETCH_ASSOC);


     $sql = "INSERT INTO `person_event` (`personID`,`eventID`,`Type`,`Flag`) VALUES ('".$person_related."','".$eventID."','".$Type."','2')";
      $stmt = $conn->prepare($sql);
      if( $stmt->execute() ):
        $new_ID_list= $conn->lastInsertId();
        $q1_updatelistorder="UPDATE `person_event` SET `listorder`='".$new_ID_list."' WHERE `ID` LIKE '".$new_ID_list."'";

        $stmt_updatelistorder = $conn->prepare($q1_updatelistorder);
        $k=$stmt_updatelistorder->execute();

      //Update Log
      $RA=$results['fname']." ".$results['lname'];
      $action="Adding Relationship for Event";
      $type="event";
      $field="Relationship Added between individuals with RegIDs ".$add_entry['UI']." and ".$person_related."<br>Event Type: ".$Type;
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
