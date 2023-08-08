<?php
require '../database_SS.php';
header('Content-type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=SHADD-Hub-Archive-Data.csv');

$data = array();
    $projectID="SD";

    //Loading Value for Key in Person Table
    $q1="SELECT * FROM SD_Person_V1";
    $query_CL = $conn->query($q1);

    $dHeaders = array();
    $dHeaders[] = "RegID";
    while($CV_identifer = $query_CL->fetch(PDO::FETCH_ASSOC)){
      $dHeaders[] = $CV_identifer['display'];
    }

    $q1="SELECT * FROM `person` WHERE `project` LIKE '".$projectID."'";
    $query1 = $conn->query($q1);
    while ($person_data = $query1->fetch(PDO::FETCH_ASSOC)) {
      $dRow = array();
      $dRow[] = $person_data['UI'];

      //Loading Value for Key in Person Table
      $q1="SELECT * FROM SD_Person_V1";
      $query_CL = $conn->query($q1);

      while($CV_identifer = $query_CL->fetch(PDO::FETCH_ASSOC)){
        if($CV_identifer['FieldType']=="dropdown-CV"){
          // Check for blanks
          if($person_data[$CV_identifer['ColumnName']]==''){
            $dRow[] = "";
          } else {
            $sql = "SELECT x.* FROM " . $CV_identifer['Options'] . " x WHERE ID=" . $person_data[$CV_identifer['ColumnName']] . " limit 1;";
            $query = $conn->query($sql);
            $dynamic = $query->fetch(PDO::FETCH_ASSOC);
            if(is_array($dynamic)){
              $dRow[] = $dynamic['Name'];
            } else {
              $dRow[] = "";
            }
          }
        } else if($CV_identifer['FieldType']=="dropdown-CV-multi"){
          // Check for blanks
          if($person_data[$CV_identifer['ColumnName']]==''){
            $dRow[] = "";
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
            $dRow[] = $mstring;
          }
        } else{
          $dRow[] = $person_data[$CV_identifer['ColumnName']];
        }
      }
      $data[] = $dRow;
    }

// Clean up output buffer before writing anything to CSV file.
ob_end_clean();

// Open a file handle for writing 
$fp = fopen('php://output','w');

// Save Header Row
fputcsv($fp,$dHeaders);

// Write the data to the file 
foreach ($data as $row){
  fputcsv($fp, $row);
}

// Close the file handle
fclose($fp);
?>
