<div class="col-xl-12 col-md-12 mb-12">
<div class="card mb-3">
  <div class="card-header">
    <div class="row">
    <div class="col-xl-8 col-md-8 mb-8">
    <h3> <?php if($person_data['Name']=="NA"){echo "Unkown";}else{echo $person_data['Name'];} ?> </h3>
  </div>

    <div class="col-xl-2 col-md-2 mb-2">
      <form action="person_edit.php" method="GET">
        <input name="personID" value=<?php echo $_GET['personID']; ?> type=hidden>
        <input name="action" value="doc" type=hidden>
        <input name="request" value="<?php echo $_GET['request']; ?>" type=hidden>
        <input name="page" value="<?php echo $_GET['page']; ?>" type=hidden>

        <select class="form-control" name="doctype">
          <?php

          $q1="SELECT * FROM `document_type` WHERE `sheet` LIKE 'person'";
          $query = $conn->query($q1);



           while($doc = $query->fetch(PDO::FETCH_ASSOC)){

               if($doc['Type']==$person_data['doctype']){

                 echo "<option value=\"\" selected disabled hidden>".$doc['Display']."</option>";
                 echo "<option value=\"".$doc['Type']."\">".$doc['Display']."</option>";
               }
               else {
                 echo "<option value=\"".$doc['Type']."\">".$doc['Display']."</option>";
               }

           }


             ?>

        </select>
      </div>
        <div class="col-xl-2 col-md-2 mb-2 pull-right">
        <button type="submit" class="btn btn-primary">Update Form Type</button>
      </form>
    </div>
  </div>
</div>
  <div class="card-body">
    <b>Keywords : </b><?php echo $person_data['Notes']." ".$message; ?><br>
    <b>Person ID : </b><?php echo $person_data['UI']; ?><br>

  </div>
</div>
</div>
