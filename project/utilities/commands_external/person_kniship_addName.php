<?php
    session_start();
    date_default_timezone_set('America/Toronto');
    $date = new DateTime();
    $TimeDate = $date->format('Y-m-d H:i:s');
     require '../database_SS.php';
     require '../user-check-utilities-subfolders.php';

     $personID=$_POST['personID'];
     $Type=$_POST['Type'];
     $person_related=$_POST['Name'];

     $q="SELECT * FROM `person` where `personID`='".$personID."'";
     $query1 = $conn->query($q);
     $add_entry = $query1->fetch(PDO::FETCH_ASSOC);


     $sql = "INSERT INTO `person_kinship` (`personID`,`person_related`,`Type`,`Flag`) VALUES ('".$personID."','".$person_related."','".$Type."','0')";
      $stmt = $conn->prepare($sql);
      if( $stmt->execute() ):

      //Update Log
      $RA=$results['fname']." ".$results['lname'];
      $action="Adding Relationship (Kinship)";
      $type="person";
      $field="Relationship (Kinship) Added between individual with RegID: ".$add_entry['UI']." and ".$person_related."<br>Type: ".$Type;
          $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$personID."','".$type."','".$TimeDate."','".$RA."','".$field."','".$action."')";
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
