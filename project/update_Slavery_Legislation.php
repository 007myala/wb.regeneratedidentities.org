<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
error_reporting(0);
$message = 0;
$projectID="AL";
?>

<?php
if(isset($_POST['action'])){
 
 $date = new DateTime();
 $TimeDate = $date->format('Y-m-d H:i:s');
 $RA = $results['fname']." ".$results['lname'];
 $type="person";
 $countUpdate=0;
 $count=count($_POST["personID"]);
 for($i=0;$i<$count;$i++){
  $personID="";$flag=0;$field_log="";$field="";
 
  foreach ($_POST as $name[$i] => $val){
   if($name[$i] !="action"){
    if($name[$i]=='personID'){
      $personID=$val[$i];
      $q_up="SELECT * FROM `person` WHERE `personID` LIKE '".$val[$i]."' ";
      $query_up = $conn->query($q_up);
      $person__one_data = $query_up->fetch(PDO::FETCH_ASSOC);
    }
    if($val[$i]!= $person__one_data[$name[$i]]){
      
     
     $CV_flag=0;
     $multi_flag=0;
     $q1_fieldName="SELECT `display` FROM AL_Person_V1 WHERE `ColumnName`LIKE '".$name[$i]."'";
     $query_fieldName = $conn->query($q1_fieldName);
     $Display_name = $query_fieldName->fetch(PDO::FETCH_ASSOC);

     //Loading Value for Key in Person Table
     $q1="SELECT * FROM AL_Person_V1";
     $query_CL = $conn->query($q1);
     $dropdownvalue;
     while($CV_identifer = $query_CL->fetch(PDO::FETCH_ASSOC)){
      if($CV_identifer['FieldType']=="dropdown-CV" & $CV_identifer['ColumnName']==$name[$i]){
        if($person__one_data[$name[$i]]==''){
          $dropdownvalue=0;
          
        }
        $CV_flag=1;
        $CV_table_name=$CV_identifer['Options'];
        
      }
     }

    if($val[$i]!= $dropdownvalue){
      $flag=1;$countUpdate++;
      if(!empty($val[$i]) && $CV_flag==0 ){
      if($name[$i] =="personID"){
        $Display_name['display']="personID";
      }

     $field=$field.htmlspecialchars($name[$i] . ': ' . $val[$i], ENT_QUOTES) . " <br> ";

      if(is_array($name[$i])){
       $column_opt="";
       $column_opt_id="";
       foreach($_POST[$name][$i] as $option[$i]){
        $q1="SELECT `ID`,`Name` FROM `".$CV_table_name."` WHERE `ID`=".$option[$i];
         $query_q1 = $conn->query($q1);
         $CV_value_data = $query_q1->fetch(PDO::FETCH_ASSOC);
         $CV_value=$CV_value_data['Name'];
         $column_opt=$column_opt.$CV_value.";";
         $column_opt_id=$column_opt_id.$option.";";
       }
       if($event_data[$name][$i]!=$column_opt_id){
         $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $column_opt, ENT_QUOTES) . " <br> ";
       }

     }else{
     $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $val[$i], ENT_QUOTES) . " <br> ";
     }

     
     }
     if($CV_flag==1)
     {
       $q2="SELECT `ID`,`Name` FROM `".$CV_table_name."` WHERE `ID`=".$val[$i];
       $query_q2 = $conn->query($q2);
       $CV_value = $query_q2->fetch(PDO::FETCH_ASSOC);
        if($name[$i] =="personID"){$Display_name['display']="personID";}
       $field=$field.htmlspecialchars($name[$i] . ': ' . $CV_value['Name'], ENT_QUOTES) . " <br> ";


       $field_log=$field_log.htmlspecialchars($Display_name['display'] . ' : ' . $CV_value['Name'], ENT_QUOTES) . " <br> ";
     }
  }   
 }
}
if($field!=""){
 if($name[$i]!="on" || $name[$i]=="0" ){
    $column = htmlspecialchars($val[$i], ENT_QUOTES);
    if($name[$i] !="action"){
     //Update entry
      $sql = "UPDATE `person` SET `".$name[$i]."`=\"".$val[$i]."\" WHERE `personID` = \"".$personID."\"";
      $stmt = $conn->prepare($sql);
      if($stmt->execute() ):
        $message = 1;
      else:
        $message = 2;
      endif;
   
  }
 }
}
}
if($flag==1){
$action="Updated";
   $sql = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$personID."','".$type."','".$TimeDate."','".$RA."','".$field_log."','".$action."')";
    $stmt = $conn->prepare($sql);
    if( $stmt->execute() ):
      $message = 1;

    else:
      $message = 2;
    endif;
}

}
if($countUpdate==0)
  $message = 2;
}
 ?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Regenerated Identites - Home</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!--Load Men and Woment Info and passing to JS-->
</head>

<body id="page_m-top">

<!-- page_m Wrapper -->
  <div id="wrapper">
   <!-- Sidebar menu -->
    <?php require 'utilities/sidebar_menu.php'; ?>
     <!-- Sidebar menu End -->
     <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <?php require 'utilities/topbar.php'; ?>
            <!-- Begin page_m Content -->
            <div class="container-fluid">
            <!-- page_m Heading -->
            <!-- Content Row -->
              <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                  <!-------SPLITING ENTRIES------>
                  <?php


                     // number of rows per page
                     $rowperpage = 10;
                    if(isset($_GET['rowpage'])){
                        $rowperpage = $_GET['rowpage'];

                    }
                    if(empty($_GET['page_m'])){
                      $page_m=1;
                    }else {
                      $page_m=$_GET['page_m'];
                    }
                    if(isset($_POST['num_rows'])){
                        $rowperpage = $_POST['num_rows'];

                    }
                    $start = $rowperpage * ($page_m - 1);//Select number of enties per page_m here
                    $rows = $rowperpage;//Select number of enties per page_m here
                    $search="";
                    if(isset($_GET['search'])){
                      $search="AND `UI` LIKE '%".$_GET['search']."%' OR `Name` LIKE '%".$_GET['search']."%'";
                    }
                    $q1="SELECT count(personID) as counts FROM `person` WHERE `project` LIKE '".$projectID."' ".$search;
                    $query = $conn->query($q1);
                    $query_pro= $query->fetch(PDO::FETCH_ASSOC);
                    $total_news=$query_pro['counts'];
                  ?>
                </div>
                <div class="col-xl-12 col-md-12 mb-12">
                  <div class="card mb-3">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-xl-8 col-md-6 mb-12 " >
                          <?php require 'utilities/database_login.php';
                          $q_projectselect="SELECT * FROM `Project` WHERE `ProjectID` LIKE '".$projectID."'";
                          $query_projectselect = $conn->query($q_projectselect);
                          $projectselect= $query_projectselect->fetch(PDO::FETCH_ASSOC);
                          echo "<h4><a href=\"".$projectselect['Glink']."\" target=\"_blank\"><i class=\"fab fa-google-drive\"></i></a> ".$projectselect['ProjectName']."</h4>";
                          require 'utilities/database_SS.php';
                          ?>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-12 " >
                          <h4 style="text-align: right !important;">Page : </h4>
                        </div>
                        <div class="col-xl-1 col-md-6 mb-12">
                          <?php $max_page_ms=ceil($total_news/$rowperpage); ?>
                          <form action="#" method="GET">
                            <input type="hidden" name="projectID" value="<?php echo $projectID;?>">
                            <input type="hidden" value="<?php echo $rowperpage; ?>" name="rowpage"> </input>
                              <select class="form-control" name="page_m">
                              <?php
                                echo "<option value=\"\" selected disabled hidden>".$page_m."</option>";
                                for($x=1;$x<=$max_page_ms;$x++){
                                  echo "<option value=\"".$x."\">".$x."</option>";
                              }?>
                              </select>
                              </div>
                            <div class="col-xl-1 col-md-6 mb-12 pull-right">
                              <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                              </form>
                            </div>
                        </div>
                        <div class="card-body">
                        <!-- page_ms navigation start-->
                        <table border="0" style="width:100%">
                        <tr>
                         <!-- Previous page_m-->
                          <th>
                          <?php
                            if($page_m!=1){?>
                            <p align=left>
                            <?php if(isset($_GET['search'])){
                              $search_text_p="&search=".$_GET['search'];
                            }else{
                              $search_text_p="";
                            }?>
                            <a href="update_Slavery_Legislation.php?projectID=<?php echo $projectID;?><?php echo $search_text_p;?>&page_m=<?php echo $page_m-1;?>&rowpage=<?php echo $rowperpage;?>"> <i class="fas fa-arrow-circle-left"></i> Previous </a>
                            </p>
                            <?php } ?>
                            <?php if($page_m==1){?>
                            <p align=left>
                            <i class="fas fa-arrow-circle-left"></i> Previous
                            </p>
                            <?php }?>
                            </th>

                            <th>
                            <?php
                            //Calculating page_ms
                            $max_page_ms=ceil($total_news/$rowperpage);//Select number of enties per page_m here
                            if($page_m!=$max_page_ms){?>
                            <p align=right>
                            <?php if(isset($_GET['search'])){
                            $search_text="&search=".$_GET['search'];
                            }else{
                            $search_text="";
                            }?>
                            <a href="update_Slavery_Legislation.php?projectID=<?php echo $projectID;?><?php echo $search_text;?>&page_m=<?php echo $page_m+1;?>&rowpage=<?php echo $rowperpage;?>">Next <i class="fas fa-arrow-circle-right"></i></i></a>
                            </p>
                            <?php } ?>
                            <?php if($page_m==$max_page_ms){?>
                            <p align=right>
                            Next <i class="fas fa-arrow-circle-right"></i>
                            </p>
                            <?php } ?>
                          </th>
                        </tr>
                        </table>


                        <form method = "post" action="update_Slavery_Legislation.php">
                        <input type="hidden" name="action" value="Update">
                        <div class="col-xl-6 col-md-6 mb-3">
                           <button type="submit" class="btn btn-primary">Save <i class="fas fa-save"></i></button>
                        </div>

                        <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                              <tr style="max-width:100%;white-space:nowrap;" >
                                <th>Reg ID</th>
                                <?php 
                                 $q3="SELECT * FROM AL_Person_V1 ";
                                 $query3 = $conn->query($q3);
                                 while($columns= $query3->fetch(PDO::FETCH_ASSOC)){?>
                                   <th><?php echo $columns['display']; ?></th>
                                
                                <?php }?>
                               
                              </tr>
                            </thead>
                             <?php

                           $q1="SELECT * FROM `person` WHERE `project` LIKE '".$projectID."' ".$search." LIMIT ".$start.",".$rows;
                           $query1 = $conn->query($q1);

                           while ($person_data = $query1->fetch(PDO::FETCH_ASSOC)) { ?>
                            <input type="hidden"  id="personID" name="personID[]" value="<?php echo $person_data['personID']; ?>">
                            <?php }?>
                            <tbody>

                            <?php

                           $q1="SELECT * FROM `person` WHERE `project` LIKE '".$projectID."' ".$search." LIMIT ".$start.",".$rows;
                           $query1 = $conn->query($q1);

                           while ($person_data = $query1->fetch(PDO::FETCH_ASSOC)) { ?>

                           <tr  class="pd">
                           <td style="max-width:100%;white-space:nowrap;"  disabled>  <?php echo $person_data['UI'];?> </td>

                            <?php $doctype=$person_data['doctype'];
                            

                              $q3="SELECT * FROM `".$doctype."`";
                              $query3 = $conn->query($q3);
                              while($columns= $query3->fetch(PDO::FETCH_ASSOC)){?>

                                <?php if($columns['FieldType']=="text"){
                                  $txtdata= htmlspecialchars($person_data[$columns['ColumnName']], ENT_QUOTES);;
                                  if($person_data[$columns['ColumnName']]=="0"){$text="Placeholder=\"Type here\"";}else{$text="value=\"".$txtdata."\"";}?>
                                  <td><input type="text" style=" width: 100%;" class="form-control" id="<?php echo $columns['ColumnName'];?>" name="<?php echo $columns['ColumnName'];?>[]"  <?php echo $text;?>></td>
                                <?php }?>

                                <?php if($columns['FieldType']=="dropdown-CV"){

                                  $q4="SELECT `ID`,`Name` FROM ".$columns['Options']." WHERE `Name` LIKE '".$person_data[$columns['ColumnName']]."'";
                                  $query_CL = $conn->query($q4);
                                  $selected_Name = $query_CL->fetch(PDO::FETCH_ASSOC);

                                  // Loading Controlled Vocaublary
                                  $q4="SELECT `ID`,`Name` FROM ".$columns['Options']." WHERE `Status` LIKE '1' ORDER BY `listorder`";
                                  $query_CL = $conn->query($q4); ?>

                                  <td ><select onchange="slection_made()" class="form-control searchdropdown"  name="<?php echo $columns['ColumnName'];?>[]" >

                                    <?php while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){

                                      if($person_data[$columns['ColumnName']]==$selected_word['ID']){
                                       echo "<option value=\"".$selected_word['ID']."\" selected>".$selected_word['Name']."</option>";
                                      }
                                      else {
                                        echo "<option value=\"".$selected_word['ID']."\">".$selected_word['Name']."</option>";
                                      }
                                    } ?>
                                  </select></td>
                                <?php }?>

                                <?php }?>
                        
                    <?php echo "</tr>";
                    }?>
                 </tbody>
            </table>

            <div class="col-md-12 mt-4 text-right"><p><?php echo "Page ".$page_m." of ".$max_page_ms;?></p></div>
          </div>
        </form>
        <form method="post" action="update_Slavery_Legislation.php" id="form">
              <div id="div_pagination">
                 <input type="hidden" name="row" value="<?php echo $row; ?>">
                 <input type="hidden" name="allcount" value="<?php echo $allcount; ?>">

                 <!-- Number of rows -->

                 <div class="divnum_rows row">
                    <div class="col-xl-3 col-md-3 mb-12 " >
                      <h4>Number of rows:</h4>
                    </div>
                   <div class="col-xl-2 col-md-2 mb-12 " >
                    <select  class="form-control"  id="num_rows" name="num_rows">
                      <?php
                      $numrows_arr = array("10","25","50","100","250","500","1000");
                      foreach($numrows_arr as $nrow){
                        if($_GET['rowpage']== $nrow || $_POST['num_rows'] == $nrow){
                            echo '<option value="'.$nrow.'" selected="selected">'.$nrow.'</option>';
                        }else{
                            echo '<option value="'.$nrow.'">'.$nrow.'</option>';
                        }
                      }?>
                    </select>
                   </div>
                 </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
  <!-- End of Main Content -->
    <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <?php require 'utilities/footer.php'; ?>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of page_m Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page_m-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Activating Messages -->
  <a style="display: none !important;" id="Messgae_success_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_success"></a>
  <a style="display: none !important;" id="Messgae_error_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_error"></a>
  <a style="display: none !important;" id="Messgae_error1_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_erro1"></a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Message</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Success Message-->
  <div class="modal fade" id="Message_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-check-circle"></i>&nbsp;&nbsp; Successfully Updated</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           The changes you made were recorded successfully.<br>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>

        </div>
      </div>
    </div>
  </div>



  <!-- Error Message-->
  <div class="modal fade" id="Message_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" style="color: Red !important;" id="MessageModalLabel"> <i class="fas fa-exclamation-circle"></i></i> Error !</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
         No Changes were made to the database. <br><br>
         Did you make any changes? <br>If yes, contact Admin via Group chat.
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>
          <a class="btn btn-secondary" href="chat.php">Group Chat</a>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){

    // Number of rows selection
    $("#num_rows").change(function(){

        // Submitting form
        $("#form").submit();

    });
});
  </script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all page_ms-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- page_m level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- page_m level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>



   <script src="js/jquery-ui.min.js"></script>
   <script src="js/dolly.js"></script>

<script type="text/javascript">
var tableController = {
    onClone: function (el, cloneX, cloneY, indexX, indexY) {
        var row = $(el).closest('tr'),
            dirX = cloneX > 0 ? 1 : -1,
            dirY = cloneY > 0 ? 1 : -1,
            amountX = Math.abs(cloneX),
            amountY = Math.abs(cloneY);
        for (var i = indexY; amountY >= 0; i += dirY, amountY--) {
            var amX = amountX;
            for (var j = indexX; amX >= 0; j += dirX, amX--) {
                this.data[i][j] = this.data[indexY][indexX];
            }
        }
        this.render();
    },

    render: function () {
        var self = this;
        this.element.html("");
        for (var i = 0, len = this.data.length; i < len; i++) {
            var row = $("<tr></tr>");
            for (var j = 0, lenj = this.data[i].length; j < lenj; j++) {
                var cell = $("<td></td");
                cell.html(this.data[i][j]);
                row.append(cell);
            }
            this.element.append(row);
        }
        $("td").dolly({
            cloned: function (event, ui) {
                self.onClone(this, ui.cloneX, ui.cloneY, ui.originX, ui.originY);
            },


        });
    }
};

tableController.element = $(".table-bordered tbody");
tableController.data = [];
tableController.element.find('tr').each(function(i, line) {
    var lineData = [];
    $(line).find('td').each(function(j, cell) {
        lineData.push($(cell).html());
    });
    tableController.data.push(lineData);
});
tableController.render();
</script>


  <?php
  # Success Message box
  if ($message == 1) :
    ?>

    <script>
    $(document).ready(function(e){
    $("#Messgae_success_link").click();
    });
    </script>
  <?php   endif; ?>

  <!--Error Message Display-->
  <?php
  # Error Message box
  if ($message == 2) :
    ?>

    <script>
    $(document).ready(function(e){
    $("#Messgae_error_link").click();
    });
    </script>
  <?php   endif; ?>

  <!--Error1 Message Display-->
  <?php
  # Error Message box
  if ($message == 3) :
    ?>

    <script>
    $(document).ready(function(e){
    $("#Messgae_error1_link").click();
    });
    </script>
  <?php   endif; ?>



  <!--Success Message Display-->

</body>

</html>
<?php else:
header("Location: ../index.php");

   endif; ?>

</html>


