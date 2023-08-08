
           <br><br>
            <div class="col-lg-12" style="background-color: #B0F5FB; padding-top: 10px;padding-bottom: 10px;">
              <h5>Autofill:</h5>
              Select the most appropriate pre-exisiting Geographic Area to load data below!


             <?php
             $q_CV_value_place="SELECT * FROM `".$table_name."` ORDER BY `listorder`";
             $query_CV_value_place = $conn->query($q_CV_value_place);


           ?>
           <!--Place Type Controlled Vocaublary Load-->

           <select onchange = "EnableDisableTextBox(this.value)" class="form-control " style="width:100%" id="<?php echo $Available_Names['Field'];?>_drop" >

             <?php

             while($selected_word = $query_CV_value_place->fetch(PDO::FETCH_ASSOC)){

                  echo "<option value=\"".$selected_word['ID']."\" >".$selected_word['Name']."</option>";

             } ?>

           </select>
           <br><br>




         </div>
