<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Success Message-->
<div class="modal fade" id="Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-check-circle"></i>&nbsp;&nbsp; Successfully Updated</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="object_edit.php?request=<?php echo $_GET['request'];?>&page=<?php echo $_GET['page'];?><?php echo "&doctype=".$doctype."&objectID=".$_GET['objectID']; ?>&action=Update" method="POST">

          <?php

          $q1="SELECT DISTINCT `section`,`SectionDisplay` FROM `".$doctype."`";
          $query = $conn->query($q1);


           while($section = $query->fetch(PDO::FETCH_ASSOC)){


             ?>
             <!-- Collapsable Section -->
             <div class="card shadow mb-4">
               <!-- Card Header - Accordion -->
               <a href="#collapseCardExample<?php echo $section['section'];?>" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="true" >
                 <h6 class="m-0 font-weight-bold text-primary"><?php echo $section['SectionDisplay']; ?></h6>
               </a>
               <!-- Card Content - Collapse -->
               <div class="collapse" id="collapseCardExample<?php echo $section['section'];?>">
                 <div class="card-body">
                   <?php

                   $q1="SELECT * FROM `".$doctype."` WHERE `section` LIKE '".$section['section']."'";
                   $query1 = $conn->query($q1);
                   while($columns= $query1->fetch(PDO::FETCH_ASSOC)){

                    if($columns['FieldType']=="text"){
                    ?>
                   <div class="form-group">
                     <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                     <?php if($object_data[$columns['ColumnName']]=="NA"){$text="Type here";}else{$text=$object_data[$columns['ColumnName']];}?>
                     <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  placeholder="<?php echo $text;?>" <?php if($columns['status']==0){echo "Disabled";}?>>

                   </div>
                <?php
                    }
                    if($columns['FieldType']=="date"){
                   ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                    <?php if($object_data[$columns['ColumnName']]=="NA"){$text="Type here";}else{$text=$object_data[$columns['ColumnName']];}?>
                    <input type="date" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  value="<?php echo $text;?>" <?php if($columns['status']==0){echo "Disabled";}?>>

                  </div>
                <?php
                   }
                    if($columns['FieldType']=="textarea"){
                   ?>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                    <?php if($object_data[$columns['ColumnName']]=="NA"){$text="Type here";}else{$text=$object_data[$columns['ColumnName']];}?>
                    <textarea rows="8" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  placeholder="" <?php if($columns['status']==0){echo "Disabled";}?>><?php echo $text;?></textarea>

                  </div>
                <?php
                   }
                   if($columns['FieldType']=="dropdown" & $columns['Options']!="Researcher"){
                  ?>
                 <div class="form-group">
                   <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                   <?php
                   $words = explode(";", $columns['Options']);
                   $selected_word = $object_data[$columns['ColumnName']];
                   ?>

                    <select class="form-control" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

                      <option value="NA">Not Known</option>
                      <?php for ($x = 0; $x < sizeof($words); $x++) {

                        if($words[$x]==$selected_word){

                          echo "<option value=\"\" selected disabled hidden>".$words[$x]."</option>";
                          echo "<option value=\"".$words[$x]."\">".$words[$x]."</option>";
                        }
                        else {
                          echo "<option value=\"".$words[$x]."\">".$words[$x]."</option>";
                        }




                  } ?>

                    </select>

                 </div>
               <?php
                  }

                  if($columns['FieldType']=="dropdown" & $columns['Options']=="Researcher"){
                 ?>
                <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                  <?php
                  require '../decodingorigins-login/database_login.php';
                  $q1="SELECT * FROM `users` WHERE `email` LIKE '".$columns['assignedto']."'";
                  $query_user = $conn->query($q1);
                  $assign_flag= $query_user->fetch(PDO::FETCH_ASSOC);
                  $assign=$assign_flag['fname']." ".$assign_flag['lname'];

                  $q1="SELECT * FROM `users` WHERE `SS`=1";
                  $query1 = $conn->query($q1);


                  ?>

                   <select class="form-control" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

                     <option value="NA">Not Known</option>
                     <?php while($user= $query1->fetch(PDO::FETCH_ASSOC)){


                         if($user['email']==$object_data['assignedto']){
                         echo "<option value=\"\" selected disabled hidden>".$user['fname']." ".$user['lname']."</option>";
                         echo "<option value=\"".$user['email']."\">".$user['fname']." ".$user['lname']."</option>";
                       }
                       else {
                         echo "<option value=\"".$user['email']."\">".$user['fname']." ".$user['lname']."</option>";
                       }

                     }?>

                   </select>

                </div>
              <?php
              require 'utilities/database_SS.php';
                 }


                  ?>


                 <?php
                  }?>

                 </div>
               </div>
             </div>


             <?php


           }

           ?>


              <?php if($_GET['doctype']!="NoSelection"):?>

              <button type="submit" class="btn btn-primary">Update <i class="fas fa-pen"></i></button>

            <?php endif;?>
                </form>

       </div>
      <div class="modal-footer">
        <a href="?message=0"><button class="btn btn-primary" type="button" >Ok</button></a>

      </div>
    </div>
  </div>
</div>
