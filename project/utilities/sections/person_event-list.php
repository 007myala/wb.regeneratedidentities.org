

<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
          <th>Re-Order</th>
          <th>Event ID</th>
          <th>Type</th>
          <th>Start Date</th>



          <th> </th>
          <th> </th>

      </tr>
    </thead>
  </tbody>

<?php

$q1="SELECT * FROM `person_event` WHERE `personID` = ".$_GET['personID']." ORDER BY `listorder`";

$query = $conn->query($q1);

//Get Min List order
$q3="SELECT MIN(`listorder`) AS 'MIN_listorder' FROM `person_event` WHERE `personID` = ".$_GET['personID']." ";
$query3 = $conn->query($q3);
$MIN_listorder_data = $query3->fetch(PDO::FETCH_ASSOC);
$MIN_listorder_data =$MIN_listorder_data['MIN_listorder'];

//Get Max Lst order
$q3="SELECT MAX(`listorder`) AS 'MAX_listorder' FROM `person_event` WHERE `personID` = ".$_GET['personID']." ";
$query3 = $conn->query($q3);
$MAX_listorder_data = $query3->fetch(PDO::FETCH_ASSOC);
$MAX_listorder_data =$MAX_listorder_data['MAX_listorder'];

while ($datas = $query->fetch(PDO::FETCH_ASSOC)) {

  $q="SELECT * FROM `event` WHERE `eventID` LIKE '".$datas['eventID']."'";
  $query1 = $conn->query($q);
  $event = $query1->fetch(PDO::FETCH_ASSOC);

echo "<tr>";

if($datas['listorder']==$MIN_listorder_data){

  echo "<td width=\"100\" ! important><h4><a href=\"utilities/commands_external/move_down_event.php?listID=".$datas['listorder']."&personID=".$_GET['personID']."&ID=".$datas['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-down\"></i></a></h4></td>";
}elseif ($datas['listorder']==$MAX_listorder_data) {
  echo "<td width=\"100\" ! important><h4><a href=\"utilities/commands_external/move_up_event.php?listID=".$datas['listorder']."&personID=".$_GET['personID']."&ID=".$datas['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-up\"></i></a></h4></td>";
}else{
  echo "<td width=\"100\" ! important><h4><a href=\"utilities/commands_external/move_up_event.php?listID=".$datas['listorder']."&personID=".$_GET['personID']."&ID=".$datas['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-up\"></i></a><a href=\"utilities/commands_external/move_down_event.php?listID=".$datas['listorder']."&personID=".$_GET['personID']."&ID=".$datas['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-down\"></i></a></h4></td>";
}
echo "<td width=\"130\" ! important>" . $event['UI'] . "</td>";
if($event['Event_Type']!='0'){
  if(fnmatch("*Connection Only*",$datas['Type'])){
echo "<td width=\"200\" ! important>" . $event['Event_Type'] . "<br>(Connection Only)</td>";
}else{
  echo "<td width=\"200\" ! important>" . $event['Event_Type'] . "</td>";
}
}else {
  echo "<td width=\"200\" ! important></td>";
}
if($event['Field1']!='0'){
echo "<td width=\"154\" ! important>" . $event['Field1'] . "</td>";
}else {
  echo "<td width=\"154\" ! important></td>";
}




echo "<td width=\"154\" ! important><a href=\"event_edit.php?personID=".$_GET['personID']."&eventID=".$event['eventID']."\" class=\"btn btn-success btn-block waves-effect waves-light\">Update</a></td>";
echo "<td width=\"154\" ! important><a href=\"utilities/commands_external/delete_event.php?eventID=".$event['eventID']."\" class=\"btn btn-secondary btn-block waves-effect waves-light\" title=\"Delete Event From the Database. To remove only for this individual click 'Update'.\">Delete</a></td>";





echo "</tr>";
}
?>

</tbody>
</table>


</div>
