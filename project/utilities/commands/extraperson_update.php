<?php


$q1="SELECT * FROM `".$doctype."`";
$query1 = $conn->query($q1);
$q2="SELECT * FROM `person` WHERE `personID` LIKE '".$_GET['personID']."'";
$query2 = $conn->query($q2);
$person= $query2->fetch(PDO::FETCH_ASSOC);

//NEW ENTRY

$k=0;$total_col=0;

while($columns= $query1->fetch(PDO::FETCH_ASSOC)){
  $total_col=$total_col+1;


      if($person[$columns['ColumnName']] == "NA")
            {
              $k=$k+1;

            }




//Loading values
if($_GET['action']=="Update"){

$field="";
foreach ($_POST as $name => $val)
{
     if($name !="number" && $name !="new_name" && !empty($val) && $name!=="action"){
     $field=$field.htmlspecialchars($name . ': ' . $val) . " <br> ";


     }

}

$message=$_POST[$columns['ColumnName']];
//***************************************************
// Update Entries matching columns from doctype
if(!empty($_POST[$columns['ColumnName']]) ){
$personID = $_GET['personID'];
$column = $_POST[$columns['ColumnName']];

//Update entry
	$sql = "UPDATE `person` SET `".$columns['ColumnName']."`=\"".$column."\" WHERE `personID` = \"".$personID."\"";
	$stmt = $conn->prepare($sql);

	if( $stmt->execute() ):
		$message = 1;

	else:
		$message = 2;
	endif;
//End of Update Entry

	}
}
}

if($_GET['action']=="Update"){
//Enter the log in the database
$action="person Updated";
    $sql = "INSERT INTO `log_person` (`personID`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$personID."','".$TimeDate."','".$RA."','".$field."','".$action."')";
    $stmt = $conn->prepare($sql);

    if( $stmt->execute() )
      {
      $message = 1;


      }
    else	{
      $message = 3;

      }
}


  $m=round((($total_col-$k)/$total_col)*100,0);
  if($doctype=="NoSelection"){$m=0;}
  $sql_complete = "UPDATE `person` SET `Complete`= '".$m."' WHERE `personID` = '".$_GET['personID']."'";
  $stmt_complete = $conn->prepare($sql_complete);


  if( $stmt_complete->execute() ){}
  else{
    $message = 2;
  }

  //Extracting Project ID and personID to generate and save UI
  $q1="SELECT * FROM `person` WHERE `personID` LIKE '".$_GET['personID']."'";
  $query = $conn->query($q1);
  $person_data = $query->fetch(PDO::FETCH_ASSOC);

  $num_padded = sprintf("%06d", $person_data['personID']);

  $sql_UI = "UPDATE `person` SET `UI`= '".$person_data['project'].$num_padded."' WHERE `personID` = '".$_GET['personID']."'";
  $stmt_UI = $conn->prepare($sql_UI);


  if( $stmt_UI->execute()){}
  else{
    $message = 2;

  }

  ?>
