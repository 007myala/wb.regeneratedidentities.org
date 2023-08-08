<?php
require '../user-check-utilities-subfolders.php';
$ID=$_GET['id'];
$table_name=$_GET['table_name'];



$q_CV_value="SELECT * FROM `".$table_name."` where `ID`='".$ID."'";
$query_CV_value = $conn->query($q_CV_value);
$CV_values = $query_CV_value->fetch(PDO::FETCH_ASSOC);

$response = json_encode($CV_values);
echo $response;

?>
