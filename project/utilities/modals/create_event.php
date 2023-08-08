<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Success Message-->
<div class="modal fade" id="Message" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="max-width: 500px !important; margin: 1.75rem auto !important;">
      <div class="modal-header">
        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-file"></i>&nbsp;&nbsp; Create Event</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="utilities/commands_external/create_new_event.php" method="POST">
          <input type="hidden" name="personID" value=<?php echo $_GET['personID'];?>>
          <input type="hidden" name="RA" value="<?php echo $results['fname']." ".$results['lname'];?>">
          <input type="hidden" name="project" value="<?php echo $person_data['project']?>">

        <div class="form-group">

        <?php

        // Loading Controlled Vocaublary
        $q1="SELECT DISTINCT * FROM `document_type` WHERE `Sheet` LIKE 'event'";

        $query_CL = $conn->query($q1);


        ?>
        <?php if($person_data['project']!="FN"){ ?>
          <label for="exampleInputEmail1">Select the Type of Form</label>
         <select class="form-control" name="doctype" >
           <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){
              echo "<option value=\"".$selected_word['Type']."\">".$selected_word['Display']."</option>";
           } ?>

         </select>
       <?php }else{
         echo "<input type=\"hidden\" name=\"doctype\" value=\"FN_Event\">";
       }
         ?>

          </div>

          <div class="form-group">
          <label for="exampleInputEmail1">Click below to select Event Type</label>
          <?php

          // Loading Controlled Vocaublary
          $q1="SELECT * FROM `event_Type` WHERE `Status` LIKE '1' ORDER BY `listorder`";

          $query_CL = $conn->query($q1);


          ?>

           <select class="form-control searchdropdown" name="Type" style="width:100%;" required>

             <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){


                 echo "<option value=\"".$selected_word['Name']."\">".$selected_word['Name']."</option>";

             } ?>

           </select>


            </div>

       </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="submit" >Create</button>
      </form>
      <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>

      </div>

    </div>
  </div>
</div>
