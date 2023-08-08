

<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
          <th>Source RegID</th>
          <th>File Title</th>
          <th>File Uploaded</th>
          <th></th>
          <th> </th>
          <th> </th>
      </tr>
    </thead>
  </tbody>

<?php

$q1="SELECT * FROM `objects_person` WHERE `personID` LIKE '".$_GET['personID']."'";

$query = $conn->query($q1);


while ($datas = $query->fetch(PDO::FETCH_ASSOC)) {

  $q_object="SELECT * FROM `object` WHERE `objectID` LIKE '".$datas['objectID']."'";
  $query_object = $conn->query($q_object);
  $object_data = $query_object->fetch(PDO::FETCH_ASSOC);

echo "<tr>";
echo "<td width=\"200\" ! important>" . $object_data['UI'] . "</td>";
echo "<td width=\"154\" ! important>" . $object_data['Field1'] . "</td>";
if($object_data['File']=='0'){
echo "<td width=\"200\" ! important><i class=\"fas fa-times\"></i></td>";
}else{
  echo "<td width=\"200\" ! important><i class=\"fas fa-check\"></i></td>";
}
?>

<?php

echo "<td width=\"154\" ! important><a href=\"object_edit.php?personID=".$_GET['personID']."&objectID=".$object_data['objectID']."&page_m=".$page_m."&pCnt=".$pCnt."&pID=".$pID."\" class=\"btn btn-success btn-block waves-effect waves-light\">Update</a></td>";

echo "<td width=\"154\" ! important><a href=\"utilities/commands_external/remove_object.php?objectID=".$object_data['objectID']."&personID=".$_GET['personID']."\" class=\"btn btn-danger btn-block waves-effect waves-light\">Remove</a></td>";
if($object_data['Adminupload']==0){
echo "<td width=\"154\" ! important><a href=\"utilities/commands_external/delete_object.php?objectID=".$object_data['objectID']."&personID=".$_GET['personID']."\" class=\"btn btn-secondary btn-block waves-effect waves-light\">Delete</a></td>";
}
else{
echo "<td width=\"154\" ! important>Admin Upload</td>";

}




echo "</tr>";
}
?>
</tbody>
</table>

</div>
