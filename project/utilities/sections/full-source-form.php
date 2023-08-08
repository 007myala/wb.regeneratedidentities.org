  <form action="?personID=<?php echo $personID; ?>&objectID=<?php echo $objectID; ?>" method="POST">
  <input type="hidden" name="action" value="Update">
  <?php if($_GET['doctype']!="NoSelection"):?>
  <div class="col-xl-3 col-md-3 mb-3">
  <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
  </div>
<?php endif;?>

  <?php

  $q1="SELECT DISTINCT `section`,`SectionDisplay` FROM `".$doctype."` WHERE `SectionDisplay` NOT LIKE '%Full Source%'";
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

             //For Text boxes
             if($columns['FieldType']=="text"){
             ?>
            <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
              <?php

              $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                       'newwindow',
                                 'width=500,height=500');
                           return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <?php if($object_data[$columns['ColumnName']]=="0"){$text="Placeholder=\"Type here\"";}else{$text="value=\"".$object_data[$columns['ColumnName']]."\"";}?>
              <input type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>

            </div>
             <?php
                 }

            // For dates
            if($columns['FieldType']=="date"){
             ?>
            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
            <?php

            $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
            <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                     'newwindow',
                               'width=500,height=500');
                         return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
                         <?php if($object_data[$columns['ColumnName']]=="0"){$text="Placeholder=\"YYYY-MM-DD\"";}else{$text="value=\"".$object_data[$columns['ColumnName']]."\"";}?>
                         <input pattern="0|[0-9]{4}|[0-9]{4}-[0-9]{2}|[0-9]{4}-[0-9]{2}-[0-9]{2}" type="text" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>"  <?php echo $text;?> <?php if($columns['status']==0){echo "Disabled";}?>>

            </div>
            <?php
             }

             //For Text Area - Para entries
             if($columns['FieldType']=="textarea"){
              ?>
             <div class="form-group">
             <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
             <?php

             $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
             <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                      'newwindow',
                                'width=500,height=500');
                          return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
             <?php if($object_data[$columns['ColumnName']]=="0"){?>

             <textarea rows="8" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>" placeholder="Type here" <?php if($columns['status']==0){echo "Disabled";}?>></textarea>
           <?php } else{
             $text=$object_data[$columns['ColumnName']];?>
             <textarea rows="8" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>><?php echo $text;?></textarea>

           <?php } ?>


             </div>
             <?php
              }

           // For Dropdown Menu - Defined Values
           if($columns['FieldType']=="dropdown" & $columns['Options']!="Researcher"){
            ?>
           <div class="form-group">
           <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
           <?php

           $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
           <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                    'newwindow',
                              'width=500,height=500');
                        return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
           <?php
           $words = explode(";", $columns['Options']);
           $selected_word = $object_data[$columns['ColumnName']];
           ?>

            <select class="form-control" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

              <option value="0">Not Known</option>
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

              // For RADIO BUTTON
              if($columns['FieldType']=="radio"){
               ?>
              <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
              <?php

              $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                       'newwindow',
                                 'width=500,height=500');
                           return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <?php
              $words = explode(";", $columns['Options']);
              $selected_word = $object_data[$columns['ColumnName']];

              ?>

              <div class="form-group">
                 <?php for ($x = 0; $x < sizeof($words); $x++) {

                   if($words[$x]==$selected_word){
                     ?>

                       <label class="radio-inline"><input type="radio" name="<?php echo $columns['ColumnName'];?>" checked><?php echo $words[$x];?></label>


                   <?php }
                   else{ ?>

                       <label class="radio-inline"><input type="radio" name="<?php echo $columns['ColumnName'];?>" value="<?php echo $words[$x];?>"><?php echo $words[$x];?></label>


                   <?php }
                 } ?>
               </div>

                </div>
              <?php
                 }

              // For Dropdown Menu - Controlled Vocaublary from Tables
              if($columns['FieldType']=="dropdown-CV"){
               ?>
              <div class="form-group">
              <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
              <?php

              $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
              <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                       'newwindow',
                                 'width=500,height=500');
                           return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
              <a href="<?php echo explode("&message", $current_URL)[0];?>&message=5&table=<?php echo $columns['Options'];?>"><i class="fas fa-plus-square"></i></a>
              <?php if($columns['Options']=="CV_Place" & $object_data[$columns['ColumnName']]!=0){ ?>
                <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $object_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>

              <?php } ?>
              <?php


                    //Loading Value for Key in Person Table
                    $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` WHERE `ID`=".$object_data[$columns['ColumnName']];
                    $query_CL = $conn->query($q1);
                    $selected_id_Name = $query_CL->fetch(PDO::FETCH_ASSOC);
                    $selected_Name=$selected_id_Name['Name'];


                    // Loading Controlled Vocaublary
                    $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` ORDER BY `listorder`";
                    $query_CL = $conn->query($q1);

              ?>

               <select class="form-control" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>


                 <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                   if($object_data[$columns['ColumnName']]==$selected_word['ID']){

                     echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                     echo "<option value=\"\" selected disabled hidden>".$selected_Name."</option>";

                   }
                   else {
                      echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   }
                 } ?>

                   </select>

                </div>
              <?php
                 }

                 // For Dropdown Menu - Controlled Vocaublary from Tables -multiselct box
                 if($columns['FieldType']=="dropdown-CV-multi"){
                  ?>
                 <div class="form-group">
                 <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
                 <?php

                 $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
                 <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                          'newwindow',
                                    'width=500,height=500');
                              return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
                 <a href="<?php echo explode("&message", $current_URL)[0];?>&message=5&table=<?php echo $columns['Options'];?>"><i class="fas fa-plus-square"></i></a>
                 <?php if($columns['Options']=="CV_Place" & $object_data[$columns['ColumnName']]!=0){ ?>
                   <a href="<?php echo explode("&message", $current_URL)[0];?>&message=6&place=<?php echo $object_data[$columns['ColumnName']];?>"><i class="fas fa-map-marker-alt"></i></a>

                 <?php } ?>
                 <?php

                           //Loading Value for Key in Events Table
                           $selectedoptions=$object_data[$columns['ColumnName']];
                           $selectedoptions_Array = explode(';', $selectedoptions);





                           // Loading Controlled Vocaublary
                           $q1="SELECT `ID`,`Name` FROM `".$columns['Options']."` ORDER BY `listorder`";
                           $query_CL = $conn->query($q1);


                 ?>
                 <div class="" style="height:120px;overflow:auto;width:100%;border:1px;">
                     <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){
                      $disable_flag="";
                      foreach($selectedoptions_Array as $opt_selected){
                        if($opt_selected==$selected_word['ID']){
                          $disable_flag="checked";

                        }
                      }
                      echo "<div class=\"form-control\">";
                      echo "<input type=\"checkbox\" name=\"".$columns['ColumnName']."[]\" ".$disable_flag." value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                      echo "</div>";
                    } ?>
                  </div>

                   </div>
                 <?php
                    }




          // For Dropdown Menu - Load Researchers
            if($columns['FieldType']=="dropdown" & $columns['Options']=="Researcher"){
           ?>
          <div class="form-group">
          <label for="exampleInputEmail1"><?php echo $columns['display'];?></label>
          <?php

          $instructions="instructions.php?type=".$doctype."&fieldID=".$columns['id'];?>
          <a href="<?php echo $instructions;?>.php" onclick="window.open('<?php echo $instructions;?>',
                                   'newwindow',
                             'width=500,height=500');
                       return false;" target="_blank"><i class="fas fa-info-circle"></i></a>
          <?php
          require 'utilities/database_login.php';

          $q_user="SELECT * FROM `users` WHERE `".$object_data['project']."`=1";
          $query_user = $conn->query($q_user);


          ?>

           <select class="form-control" name="<?php echo $columns['ColumnName'];?>" <?php if($columns['status']==0){echo "Disabled";}?>>

             <option value="0">Not Known</option>
             <?php while($user= $query_user->fetch(PDO::FETCH_ASSOC)){


                 if($user['email']==$object_data[$columns['ColumnName']]){
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


          }
        ?>

         </div>
       </div>
     </div>


     <?php


   }

   ?>

    <div class="row">
      <?php if($_GET['doctype']!="NoSelection"):?>
      <div class="col-xl-3 col-md-3 mb-3">
      <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
      </div>
    <?php endif;?>
        </form>
      </div>
