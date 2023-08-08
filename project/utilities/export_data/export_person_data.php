<?php
require '../database_SS.php';


   /* if(empty($_GET['projectID'])){
    $projectID="%";
    }
    else {
    $projectID=$_GET['projectID'];
    }*/
    $projectID="BM";
    echo "<table>";
    //Loading Value for Key in Person Table
    $q1="SELECT * FROM BM_Person_V1";
    $query_CL = $conn->query($q1);

     echo "<tr>";
      echo "<td><b>RegID</b></td>";
     while($CV_identifer = $query_CL->fetch(PDO::FETCH_ASSOC))
     {
       echo "<td><b>".$CV_identifer['display']."</b></td>";
     }
     echo "</tr>";

    $q1="SELECT * FROM `person` WHERE `project` LIKE '".$projectID."'";
    $query1 = $conn->query($q1);
    while ($person_data = $query1->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>";
      echo "<td>".$person_data['UI']."</td>";


    //Loading Value for Key in Person Table
    $q1="SELECT * FROM BM_Person_V1";
    $query_CL = $conn->query($q1);

     while($CV_identifer = $query_CL->fetch(PDO::FETCH_ASSOC))
    {

      if($CV_identifer['FieldType']=="dropdown-CV")
      {
        // Check for blanks
        if($person_data[$CV_identifer['ColumnName']]==''){
          echo "<td></td>";
        } else {
          $sql = "SELECT x.* FROM " . $CV_identifer['Options'] . " x WHERE ID=" . $person_data[$CV_identifer['ColumnName']] . " limit 1;";
          $query = $conn->query($sql);
          $dynamic = $query->fetch(PDO::FETCH_ASSOC);
          if(is_array($dynamic)){
            echo "<td>".$dynamic['Name']."</td>";
          } else {
            echo "<td></td>";
          }
        }
      } else if($CV_identifer['FieldType']=="dropdown-CV-multi"){
        // Check for blanks
        if($person_data[$CV_identifer['ColumnName']]==''){
          echo "<td></td>";
        } else {
          $mstring = "";
          $s = $person_data[$CV_identifer['ColumnName']];
          $sids = preg_split('/;/',$s, -1, PREG_SPLIT_NO_EMPTY);
          $sln = count($sids);
          for($i=0; $i<$sln; $i++){
            $sql = "SELECT x.* FROM " . $CV_identifer['Options'] . " x WHERE ID=" . $sids[$i] . " limit 1;";
            $query = $conn->query($sql);
            $dynamic = $query->fetch(PDO::FETCH_ASSOC);
            if(is_array($dynamic)){
              $sN = $dynamic['Name'];
              if($i==0){
                $mstring = $sN;
              } else {
                $mstring = $mstring . ',' . $sN;
              }
            }
          }
          echo "<td>".$mstring."</td>";
        }
      } else{
        echo "<td>".$person_data[$CV_identifer['ColumnName']]."</td>";
      }
    }
    echo "</tr>";
}
echo "</table>";
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="'.basename($file).'"');

readfile($file);
?>
