<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>
<?php
require 'utilities/pages/geographic_details_rules.php';
require 'utilities/pages/autofill_geoplace.php';
?>

<!-- Success Message-->
<div class="modal fade" id="Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="max-width: 500px !important; margin: 1.75rem auto !important;">
      <div class="modal-header">

        <?php

        $CV_ID=$_GET['CV_ID'];

        $table_name_readable=str_replace("_", " ", $_GET['table']);
        $table_name_readable=explode("CV",$table_name_readable )[1];
        if($table_name_readable=="")
        {
          $table_name_readable=str_replace("_", " ", $_GET['table']);
        }
        ?>

        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-plus-square"></i>&nbsp;&nbsp;<?php echo $table_name_readable;?></h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="utilities/commands_external/edit_CV.php" method="post">
        <?php

        //Extracting table name from submission Form (GET function)
        $table_name=$_GET['table'];

        //Extract Column Names

        $q1="DESCRIBE `".$table_name."`";
        $query_CL = $conn->query($q1);
        $status=0;



        while($Available_Names = $query_CL->fetch(PDO::FETCH_ASSOC)){
          if( $Available_Names['Field']=="Type_of_Location" || $Available_Names['Field']=="Type_of_Geographic_Area" || $Available_Names['Field']=="Type_of_Geographical_Entity" || $Available_Names['Field']=="Place_Type" || $Available_Names['Field']=="ID" || $Available_Names['Field']=="Status" || $Available_Names['Field']=="Message" ||$Available_Names['Field']=="Submitby" |$Available_Names['Field']=="listorder"){
            //Type of Region Controlled Vocaublary Load
            if($Available_Names['Field']=="Sub-Region" ){
              $q_CV_value="SELECT * FROM `".$table_name."` where `ID`='".$CV_ID."'";
              $query_CV_value = $conn->query($q_CV_value);
              $CV_values_pt = $query_CV_value->fetch(PDO::FETCH_ASSOC);

              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Region_of_Destination` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group" id="<?php echo $Available_Names['Field'];?>_formgroup">
            <label id="<?php echo $Available_Names['Field'];?>_label" for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" id="<?php echo $Available_Names['Field'];?>" >
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                if($selected_word['Name']==$CV_values_pt['Sub-Region']){

                  // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   echo "<option value=\"".$selected_word['Name']."\" selected >".$selected_word['Name']."</option>";

                }
                else {
                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";
                }
              } ?>

            </select>
            </div>
            <?php
          }
            //Type of Location Controlled Vocaublary Load
            if($Available_Names['Field']=="Type_of_Location" ){
              $q_CV_value="SELECT * FROM `".$table_name."` where `ID`='".$CV_ID."'";
              $query_CV_value = $conn->query($q_CV_value);
              $CV_values_pt = $query_CV_value->fetch(PDO::FETCH_ASSOC);

              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Location` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group" id="<?php echo $Available_Names['Field'];?>_formgroup">
            <label id="<?php echo $Available_Names['Field'];?>_label" for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" id="<?php echo $Available_Names['Field'];?>" >
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                if($selected_word['Name']==$CV_values_pt['Type_of_Location']){

                  // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   echo "<option value=\"".$selected_word['Name']."\" selected >".$selected_word['Name']."</option>";

                }
                else {
                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";
                }
              } ?>

            </select>
            </div>
            <?php
          }
            //Type of Place Controlled Vocaublary Load
            if($Available_Names['Field']=="Type_of_Geographic_Area" ){
              $q_CV_value="SELECT * FROM `".$table_name."` where `ID`='".$CV_ID."'";
              $query_CV_value = $conn->query($q_CV_value);
              $CV_values_pt = $query_CV_value->fetch(PDO::FETCH_ASSOC);

              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Type_of_Geographic_Area` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group" id="<?php echo $Available_Names['Field'];?>_formgroup">
            <label id="<?php echo $Available_Names['Field'];?>_label" for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select onchange="Type_of_Geographic_Area_Rules(this.value)" class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" id="<?php echo $Available_Names['Field'];?>"  >
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                if($selected_word['Name']==$CV_values_pt['Type_of_Geographic_Area']){

                  // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   echo "<option value=\"".$selected_word['Name']."\" selected >".$selected_word['Name']."</option>";

                }
                else {
                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";
                }
              } ?>

            </select>
            </div>
            <?php
          }

            //Type_of_Geographical_Entity Type Controlled Vocaublary Load
            if($Available_Names['Field']=="Type_of_Geographical_Entity" ){
              $q_CV_value="SELECT * FROM `".$table_name."` where `ID`='".$CV_ID."'";
              $query_CV_value = $conn->query($q_CV_value);
              $CV_values_pt = $query_CV_value->fetch(PDO::FETCH_ASSOC);

              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Type_of_Geographical_Entity` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group" id="<?php echo $Available_Names['Field'];?>_formgroup">
            <label id="<?php echo $Available_Names['Field'];?>_label" for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" id="<?php echo $Available_Names['Field'];?>">
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                if($selected_word['Name']==$CV_values_pt['Type_of_Geographical_Entity']){

                  // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   echo "<option value=\"".$selected_word['Name']."\" selected >".$selected_word['Name']."</option>";

                }
                else {
                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";
                }
              } ?>

            </select>
            </div>
            <?php
          }  //Place Type Controlled Vocaublary Load
            if($Available_Names['Field']=="Place_Type" ){
              $q_CV_value="SELECT * FROM `".$table_name."` where `ID`='".$CV_ID."'";
              $query_CV_value = $conn->query($q_CV_value);
              $CV_values_pt = $query_CV_value->fetch(PDO::FETCH_ASSOC);

              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Place_Type` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group" id="<?php echo $Available_Names['Field'];?>_formgroup">
            <label id="<?php echo $Available_Names['Field'];?>_label" for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" id="<?php echo $Available_Names['Field'];?>" <?php if($Available_Names['Field']=="Place_Type"){ echo "onchange = \"EnableDisableTextBox(this)\"";}?>>
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                if($selected_word['Name']==$CV_values_pt['Place_Type']){

                  // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   echo "<option value=\"".$selected_word['Name']."\" selected >".$selected_word['Name']."</option>";

                }
                else {
                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";
                }
              } ?>

            </select>
            </div>
            <?php
          }//LOCATION Type Controlled Vocaublary Load
            if($Available_Names['Field']=="Location" ){
              $q_CV_value="SELECT * FROM `".$table_name."` where `ID`='".$CV_ID."'";
              $query_CV_value = $conn->query($q_CV_value);
              $CV_values_pt = $query_CV_value->fetch(PDO::FETCH_ASSOC);

              $q_CV_terms="SELECT `ID`,`Name` FROM `CV_Location` WHERE `Status` LIKE '1' ORDER BY `listorder`";
              $query_CV_terms = $conn->query($q_CV_terms);

            ?>
            <!--Place Type Controlled Vocaublary Load-->
            <div class="form-group" id="<?php echo $Available_Names['Field'];?>_formgroup">
            <label id="<?php echo $Available_Names['Field'];?>_label" for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
            <select class="form-control " style="width:100%" name="<?php echo $Available_Names['Field'];?>" id="<?php echo $Available_Names['Field'];?>">
              <?php while($selected_word = $query_CV_terms->fetch(PDO::FETCH_ASSOC)){

                if($selected_word['Name']==$CV_values_pt['Location']){

                  // echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                   echo "<option value=\"".$selected_word['Name']."\" selected >".$selected_word['Name']."</option>";

                }
                else {
                   echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";
                }
              } ?>

            </select>
            </div>
            <?php
            }
            }else{
              $q="SELECT * FROM `".$table_name."` where `ID`='".$CV_ID."'";
              $query1 = $conn->query($q);
              $CV_values = $query1->fetch(PDO::FETCH_ASSOC);
              $status=$CV_values['Status'];
              if($CV_values[$Available_Names['Field']]=='0')
              {
                $placeholder="placeholder=\"Enter Value\"";
              }
              else {
                {
                  $placeholder="value=\"".$CV_values[$Available_Names['Field']]."\"";
                }
              }
          ?>
          <div class="form-group" id="<?php echo $Available_Names['Field'];?>_formgroup">
          <label id="<?php echo $Available_Names['Field'];?>_label" for="exampleInputEmail1"><?php echo str_replace("_"," ",$Available_Names['Field']);?></label>
          <?php if($Available_Names['Field']=="Type_of_Location"  || $Available_Names['Field']=="Type_of_Geographic_Area"){
           $disable_flag="disabled";
         }else{
           $disable_flag="";
         }
         if($Available_Names['Field']=="Name_in_Original_-_Variant_Names" && $table_name=="CV_Geographic_Details"){ ?>
           <div class="row">
           <div class="col-lg-12">
             <input <?php echo $disable_flag;?> type="text" class="form-control" id="<?php echo $Available_Names['Field'];?>"  name="<?php echo $Available_Names['Field'];?>" <?php echo htmlspecialchars_decode($placeholder);?>>

           </div>
           <div class="col-lg-12">
             <div class="form-group" id="place_check_formgroup" style="margin-top:18px;">
             <label id="place_check_label">Do you know the <b>City/Town/Village</b> associated with this Location?</label>
             <select class="form-control" onchange="place_known(this.value)" style="width:100%" id="place_check">
               <option value="Yes">Yes</option>
               <option value="No">No</option>
             </select>
           </div>

           </div>

         </div>



         <?php }else { ?>
          <input <?php echo $disable_flag;?> type="text" class="form-control" id="<?php echo $Available_Names['Field'];?>"  name="<?php echo $Available_Names['Field'];?>" <?php echo htmlspecialchars_decode($placeholder);?>>



      <?php }?>
      </div>



      <?php  }


    }
        ?>


        <?php if($results['security']>0){ ?>
          <!--Radio buttion -->
          <div class="form-group">
          <label for="exampleInputEmail1">Status</label><br>
          <input type="radio" name="Status" value="0" <?php if($status=='0'){ echo "checked";}?>>Pending </input>
          <input type="radio" name="Status" value="1" <?php if($status=='1'){ echo "checked";}?>>Approved</input><br>
        </div>

        <?php }else{ ?>
          <input type="hidden" name="Status" value="0">
        <?php } ?>
        <input type="hidden" name="Submitby" value="<?php echo $RA;?>">
          <input type="hidden" name="table" value="<?php echo $table_name;?>">
          <input type="hidden" name="CV_ID" value="<?php echo $CV_ID;?>">


          <div class="form-group">
            <label for="exampleInputEmail1">Message</label>
            <textarea rows="8" class="form-control" name="Message"  placeholder="Type Message or Comment here" ></textarea>


          </div>


       </div>
      <div class="modal-footer">
        <?php if($results['security']>0){ ?>
          <button class="btn btn-success" type="submit" >Save</button>
        <?php }else{ ?>
          <button class="btn btn-warning" type="submit" >Submit for Approval</button>

        <?php } ?>

          </form>


      </div>
    </div>
  </div>
</div>
