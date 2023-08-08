<?php
$q3="SELECT * FROM `person_kinship` WHERE `personID` =".$personID." OR (`Flag`=1 AND `person_related`=".$personID.")";
$query3 = $conn->query($q3);

 while($list = $query3->fetch(PDO::FETCH_ASSOC)){


?>

<div class="col-xl-12 col-md-6 mb-12" style="margin-top: 5%;">

  <div class="card bg-secondary text-white shadow">
    <div class="card-body">
      <?php if($list['personID']==$personID){

        echo $list['Type'];

        if($list['Flag']==0){?>
          <div class="text-white-50 small">
            <?php echo $list['person_related'];?><br></div>
            <h5><a class="text-white" href="utilities/commands_external/person_kinship_delete.php?ID=<?php echo $list['ID'];?>"><i class="fas fa-times"></i></a></h5>


        <?php }
        if($list['Flag']==1){

          $query="SELECT * FROM `person` WHERE `personID` =".$list['person_related'];
          $query_conn = $conn->query($query);
          $details = $query_conn->fetch(PDO::FETCH_ASSOC);

          ?>
      <div class="text-white-50 small">
        Name: <?php echo $details['Name'];?><br>
        FN ID: <?php echo $details['UI'];?><br>
        <h5><a class="text-white" href="person_edit.php?personID=<?php echo $details['personID'];?>"><i class="fas fa-external-link-alt"></i></a>
        <a class="text-white" href="utilities/commands_external/person_kinship_delete.php?ID=<?php echo $list['ID'];?>"><i class="fas fa-times"></i></a></h5>
      </div>
      <?php }
      }
      if($list['person_related']==$personID){
        echo $list['Type'];

        if($list['Flag']==0){?>
          <div class="text-white-50 small">
            <?php echo $list['personID'];?><br></div>
            <h5><a class="text-white" href="utilities/commands_external/person_kniship_delete.php?ID=<?php echo $list['ID'];?>"><i class="fas fa-times"></i></a></h5>

        <?php }
        if($list['Flag']==1){

          $query="SELECT * FROM `person` WHERE `personID` =".$list['personID'];

          $query_conn = $conn->query($query);
          $details = $query_conn->fetch(PDO::FETCH_ASSOC);
          ?>
          <div class="text-white-50 small">
            Name: <?php echo $details['Name'];?><br>
            FN ID: <?php echo $details['UI'];?><br><br>
              <h5><a class="text-white" href="person_edit.php?personID=<?php echo $details['personID'];?>"><i class="fas fa-external-link-alt"></i></a>
                  <a class="text-white" href="utilities/commands_external/person_kinship_delete.php?ID=<?php echo $list['ID'];?>"><i class="fas fa-times"></i></a></h5>
            </div>
        <?php }
      }
      ?>

    </div>
  </div>

</div>

<?php }?>
