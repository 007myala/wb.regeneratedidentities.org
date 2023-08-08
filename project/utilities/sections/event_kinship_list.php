<?php
$q3="SELECT * FROM `person_event` WHERE `eventID` =".$eventID;
$query3 = $conn->query($q3);

 while($list = $query3->fetch(PDO::FETCH_ASSOC)){

?>

<div class="col-xl-12 col-md-6 mb-12" style="margin-top: 5%;">
  <?php
  if($list['personID']!=$personID){ ?>

  <div class="card bg-secondary text-white shadow">
    <div class="card-body">
      <?php


        if($list['Flag']==0){?>
          <div class="text-white-50 small">
            Name: <?php echo $list['personID'];?><br></div>
            <h5><a class="text-white" href="utilities/commands_external/person_event_delete.php?ID=<?php echo $list['ID'];?>&personID=<?php echo $personID;?>"><i class="fas fa-times"></i></a></h5>

        <?php }

        if($list['Flag']==1){

          $query="SELECT * FROM `person` WHERE `personID` =".$list['personID'];
          $query_conn = $conn->query($query);
          $details = $query_conn->fetch(PDO::FETCH_ASSOC);

          ?>
          <div class="text-white-50 small">
            Name: <?php echo $details['Name'];?><br>
            FN ID: <?php echo $details['UI'];?><br>
            Type: <?php echo $list['Type'];?><br><br>
            <h5><a class="text-white" href="person_edit.php?personID=<?php echo $details['personID'];?>"><i class="fas fa-external-link-alt"></i></a>
            <a class="text-white" href="utilities/commands_external/person_event_delete.php?ID=<?php echo $list['ID'];?>&personID=<?php echo $personID;?>"><i class="fas fa-times"></i></a></h5>
          </div>
          <?php }
            ?>
            <?php
            if($list['Flag']==2){



              ?>
              <div class="text-white-50 small">
                Type: <?php echo $list['Type'];?><br>
                Name: <?php echo $list['personID'];?><br>

                <h5><a class="text-white" href="utilities/commands_external/person_event_delete.php?ID=<?php echo $list['ID'];?>&personID=<?php echo $personID;?>"><i class="fas fa-times"></i></a></h5>
              </div>
              <?php }
                ?>


    </div>
  </div>
<?php }?>

</div>

<?php }?>
