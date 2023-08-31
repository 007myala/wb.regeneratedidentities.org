<?php session_start();
error_reporting(E_ALL);
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

$table=$_GET['table'];
$q6="SELECT * FROM `sections_list` WHERE `TableName` LIKE '".$table."'";
$query6 = $conn->query($q6);
$section_name= $query6->fetch(PDO::FETCH_ASSOC);

require 'utilities/database_SS.php';

$id =$_GET['id'];
$q2="SELECT * FROM `".$table."` WHERE `id` LIKE '".$id."'";
$query2 = $conn->query($q2);
$context= $query2->fetch(PDO::FETCH_ASSOC);

//NEW ENTRY
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
$RA = $results['fname']." ".$results['lname'];
$Log=$date_only." by ".$RA;
$field="";
$k=0;$total_col=0;

//Loading values
if(isset($_GET['action']) && $_GET['action']=="Update"){

$field="";
foreach ($_POST as $name => $val){
  if($name !="id" ){
    $field=$field.htmlspecialchars($name . ': ' . $val, ENT_QUOTES) . " <br> ";
  }
}
if($field!=""){
  foreach ($_POST as $name => $val){
    $column = htmlspecialchars($val, ENT_QUOTES);

    //Update entry
    $sql = "UPDATE `".$table."` SET `".$name."`=\"".$column."\", `Log`=\"".$Log."\" WHERE `id` = \"".$id."\"";
    $stmt = $conn->prepare($sql);

    if( $stmt->execute() ):
      $message = 1;
	  else:
      $message = 2;
    endif;
  }
} else {
  $message=3;
}
//Update entry
  $sql2 = "INSERT INTO `log_front` (`ID`,`TableName`,`Type`,`Log`) VALUES ('".$id."','".$table."','Content Edits','".$Log."')";
  $stmt2 = $conn_login->prepare($sql2);

  if( $stmt2->execute() ){
    $message=1;
  } else {
    $message=2;
  }
}
require 'utilities/database_SS.php';?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Regenerated Identities</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <script src="https://cdn.tiny.cloud/1/d5k8206574e4gmmp6lx46f7efki4zmqhbuy97q6b0ooblrdf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!--Load Men and Woment Info and passing to JS-->

</head>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<!-- Sidebar menu -->
  <?php require 'utilities/sidebar_menu.php'; ?>
  <!-- Sidebar menu End -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php require 'utilities/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

            <div class="row">
              <div class="col-xl-12 col-md-12 mb-12">
                <div class="card bg-secondary text-white shadow">
                  <div class="card-body">
                    Section:
                    <div class="text-white-50 small">
                      <h3><?php echo $context['Title'];?><?php echo isset($context['Name']) ? $context['Name'] : '';?>
                      </h3></div>
                      <?php if(isset($context['Name']) || isset($context['Title'])){ ?>
                        <div class="text-white-50 float-right">
                      <a href="data_list.php?table=<?php echo $table;?>">
                        <button class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</button>
                      </a>
                      <?php if($section_name['UploadFile']==1){ ?>
                      <a href="upload_file.php?table=<?php echo $table;?>&id=<?php echo $id;?>">
                        <button class="btn btn-info"><i class="fas fa-upload"></i> Upload Files</button>
                      </a>
                    <?php } ?>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <!-- Content Row -->
            <?php
            require 'utilities/database_SS.php';
            $q1="SELECT * FROM `".$table."` WHERE `id` LIKE '".$id."'";
            $query = $conn->query($q1);
            $context_data = $query->fetch(PDO::FETCH_ASSOC); ?>
              <form action="data_edit.php?table=<?php echo $table;?>&id=<?php echo $id;?>&action=Update" method="POST">
                <div class="row">
                  <div class="col-lg-3 col-md-3 mb-3" >
                  <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Save</button>
                  </div>
                  <div class="col-lg-9 col-md-9 mb-3 text-right" >
                  <i><b>Last Updated on :</b> <br><?php echo $context_data['Log'];?></i>
                  </div>
                  <div class="col-lg-8 col-md-12 mb-12">
                  <!-- Auto load Columns from the table expect id, Image and Other-->
                  <?php
                  $q_column="DESCRIBE `".$table."`";

                  $query_column = $conn->query($q_column);
                  while($column = $query_column->fetch(PDO::FETCH_ASSOC)){
                    if($column['Field']=='Name' || $column['Field']=='id' || $column['Field']=='Title' || $column['Field']=='Image' || $column['Field']=='Other' || $column['Field']=='Log' ){
                      //For above listed  columns - no inputs will load - unless you add code below

                      //For name incase ADDLIST is ON
                      if($section_name['AddList']==1 && ($column['Field']=='Name' || $column['Field']=='Title')){ ?>
                        <div class="col-lg-12 col-md-12 mb-12">
                        <label><?php echo str_replace('_', ' ', $column['Field']);?></label>
                        <?php if($context_data[$column['Field']]=="NA"){$text="Type here";}else{$text=$context_data[$column['Field']];}?>
                        <input class="form-control" name="<?php echo $column['Field'];?>" value="<?php echo $text;?>"><br>
                      </div>
                    <?php }
                    } else {
                      //ADD TEXT AREA COLUMN NAMES HERE-----
                      if($column['Field']=="Content" || $column['Field']=="Main_Text" || $column['Field']=="Read_More" || $column['Field']=="Reference" || $column['Field']=="ImageCap" || $column['Field']=="Transcript"){
                        if($column['Field']=="ImageCap"){
                           $row_num=5;
                        } else {
                           $row_num=20;
                        } ?>
                        <div class="col-lg-12 col-md-12 mb-12">
                          <?php
                          if($column['Field']=="ImageCap"){ ?>
                            <label>Image Caption</label>
                            <p style="font-size:12px"><i>Please reset the font size to 10pts when first editing!</i></p>
                          <?php } else { ?>
                            <label><?php echo str_replace('_', ' ', $column['Field']);?></label>
                          <?php }
                          if($context_data[$column['Field']]=="NA"){$text="Type here";}else{$text=$context_data[$column['Field']];}?>
                          <textarea class="form-control TypeHere" rows="<?php echo $row_num;?>"  name="<?php echo $column['Field'];?>"><?php echo $text;?></textarea><br>
                        </div>
                      <?php } else {

                       //ADD ALL DROP DOWN COLUMN NAMES HERE TO CATCH ON LOAD-----
                        if($column['Field']=="Documents_Db_Category" || $column['Field']=="Source_Type" || $column['Field']=="Country") {
                          //ADD SEPEATYE DOWN COLUMN NAMES HERE WITH OPTIONS----- ?>

                          <?php
                          //Copy from here for importing CV list from regid DB----------
                          if($column['Field']=="Country") {
                          ?>
                          <div class="col-lg-12 col-md-12 mb-12">
                            <label>Country</label>
                          <?php if($context_data[$column['Field']]=="NA"){$text="Click to Select One";}else{$text=$context_data[$column['Field']];} ?>
                            <select class="form-control" name="<?php echo $column['Field'];?>">
                              <option value="<?php echo $text;?>" selected disabled><?php echo $text;?></option>

                          <?php //Call all terms from EW_RegID Db
                          $q_dropdown="SELECT * FROM `CV_Countries`";
                          $query_dropdown = $conn_login->query($q_dropdown);
                          while($dropdown = $query_dropdown->fetch(PDO::FETCH_ASSOC)){ ?>

                              <option value="<?php echo $dropdown['Name'];?>"><?php echo $dropdown['Name'];?></option>
                            <?php } ?>
                          </select><br>

                          </div>
                        <?php }
                        //Copy Till here for importing CV list from regid DB----------
                        //Copy from here for importing CV list from regid DB----------
                        if($column['Field']=="Documents_Db_Category") {
                        ?>
                        <div class="col-lg-12 col-md-12 mb-12">
                          <label>Category</label>
                        <?php if($context_data[$column['Field']]=="NA"){$text="Click to Select One";}else{$text=$context_data[$column['Field']];} ?>
                          <select class="form-control" name="<?php echo $column['Field'];?>">
                            <option value="<?php echo $text;?>" selected disabled><?php echo $text;?></option>

                        <?php //Call all terms from EW_RegID Db
                        $q_dropdown="SELECT * FROM `CV_Documents_Db_Category`";
                        $query_dropdown = $conn_login->query($q_dropdown);
                        while($dropdown = $query_dropdown->fetch(PDO::FETCH_ASSOC)){ ?>

                            <option value="<?php echo $dropdown['Name'];?>"><?php echo $dropdown['Name'];?></option>
                          <?php } ?>
                        </select><br>

                        </div>
                      <?php }
                      //Copy Till here for importing CV list from regid DB----------
                      if($column['Field']=="Source_Type") {
                      ?>
                      <div class="col-lg-12 col-md-12 mb-12">
                        <label><?php echo str_replace('_', ' ', $column['Field']);?></label>
                      <?php if($context_data[$column['Field']]=="NA"){$text="Click to Select One";}else{$text=$context_data[$column['Field']];} ?>
                        <select class="form-control" name="<?php echo $column['Field'];?>">
                          <option value="<?php echo $text;?>" selected disabled><?php echo $text;?></option>

                      <?php //Call all terms from EW_RegID Db
                      $q_dropdown="SELECT * FROM `CV_Source_Type`";
                      $query_dropdown = $conn_login->query($q_dropdown);
                      while($dropdown = $query_dropdown->fetch(PDO::FETCH_ASSOC)){ ?>

                          <option value="<?php echo $dropdown['Name'];?>"><?php echo $dropdown['Name'];?></option>
                        <?php } ?>
                      </select><br>

                      </div>
                    <?php }
                    //Copy till here ---------

                        //PASTE HERE FOR NEXT DROP DOWN COLUMN NAME

                        } else { ?>
                        <div class="col-lg-12 col-md-12 mb-12">
                          <label><?php echo str_replace('_', ' ', $column['Field']);?></label>
                        <?php if($context_data[$column['Field']]=="NA"){$text="Type here";}else{$text=$context_data[$column['Field']];}?>
                        <input class="form-control" name="<?php echo $column['Field'];?>" value="<?php echo $text;?>"><br>

                        </div>

                    <?php   } }
                  }
                     ?>

                   <?php }
                   require 'utilities/database_SS.php';?>

                 </div>
                 <div class="col-lg-4 col-md-12 mb-12 border-left ">
                   <br>
                   <?php if($section_name['UploadFile']==1){
                   //attached files count for users
                   $q_file="SELECT count(`Refid`) as `count` FROM `Upload_RegID`  WHERE `Refid` LIKE '".$id."' AND `TableName` LIKE '".$table."'";
                   $query_file = $conn_login->query($q_file);
                   $file_count = $query_file->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="alert alert-danger" role="alert">
                    <?php echo "Number of files attached to this entry: <b>".$file_count['count']."</b>"; ?>
                    </div>
                    <br>
                  <?php } ?>
                     <p style="font-size:12px;"><i>To edit any of the below fields, please submit a <a href="https://tickets.regeneratedidentities.org" targe="_blank">RegID ticket</a><i></p>
                     <?php
                     if($section_name['AddList']!=1) {
                     if(isset($context_data['Name'])) { ?>
                       <label>Name</label>
                       <input class="form-control"  type="text" value="<?php echo $context_data['Name'];?>" disabled>
                       <br>
                     <?php }?>
                     <?php if(isset($context_data['Title'])) { ?>
                       <label>Title</label>
                       <input class="form-control"  type="text" value="<?php echo $context_data['Title'];?>" disabled>
                       <br>
                     <?php } }?>
                     <?php if(isset($context_data['Other'])) { ?>
                       <label>Other Details</label>
                       <div style="pointer-events: none; cursor: default;">
                         <hr/>
                       <p class="" disabled><?php echo htmlspecialchars_decode($context_data['Other']);?></p>
                      </div>
                       <br>
                     <?php }?>
                     <?php if(isset($context_data['Image'])) { ?>
                       <label>Images/Files</label>
                       <div style="">
                         <p>You may added or edit new files now to this section. But you cannot edit Admin uploaded images or files, or edit placement on the public website via this login.</p>
                         <hr/>
                       </div>
                       <br>
                     <?php }?>

                     <a href="#" target="_blank"><i>Click here to view Home page of <u>W.E.B Du Bois</u></i></a><br>
                     <a href="#" target="_blank"><i>Click here to view Development Node of <u>W.E.B Du Bois</u></i></a>
                 </div>

                   </div>

              </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <?php require 'utilities/footer.php';?>

              </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Activating Messages -->
  <a style="display: none !important;" id="Messgae_success_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_success"></a>
  <a style="display: none !important;" id="Messgae_error_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_error"></a>
  <a style="display: none !important;" id="Messgae_error1_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_error1"></a>

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
          The changes were successfully recorded in the project database.
          <br><span style="color: green;">These edited were also published on the public website!<br>
          <br><span style="color: red;">Please Note : Changes to texual content on this page are not recorded in our logs to optimize storage.
            However, this instance of update was logged with your credentials. We may contact you for details if needed.</span> <br>

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
        <div class="modal-body">There was an error in updating this file. Please contact admin using group chat!   </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>
          <a class="btn btn-secondary" href="chat.php">Group Chat</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Error Message-->
  <div class="modal fade" id="Message_error1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" style="color: Red !important;" id="MessageModalLabel"> <i class="fas fa-exclamation-circle"></i></i> Error !</h3>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">You have made no changes to exisitng data!   </div>
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

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  <script type="application/x-javascript">
  var sessionValue = '<%=Session["fname"]%>'

tinymce.init({
selector: ".TypeHere",  // change this value according to your HTML
plugins: [
  "advlist autolink link charmap print",
  "searchreplace visualblocks fullscreen",
  "lists hr table paste wordcount  code image"
],
toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
content_css: '//www.tiny.cloud/css/codepen.min.css',
images_upload_base_path: 'http://wb.regeneratedidentities.org/project',
images_upload_url: 'plugins/postAcceptor.php',
automatic_uploads: true,
toolbar_mode: 'floating',
tinycomments_mode: 'embedded',
tinycomments_author: "<?php echo $RA;?>",
content_style: 'p { margin: 0px; line-height: 0.9rem;}',
force_br_newlines : true,
force_p_newlines : true,
forced_root_block : '' // Needed for 3.x
});

</script>

<!--Success Message Display-->
<?php
# Success Message box
if (isset($message) && $message == 1) : ?>
  <script>
  $(document).ready(function(e){
  $("#Messgae_success_link").click();
  });
  </script>
<?php endif; ?>

<!--Error Message Display-->
<?php
# Error Message box
if (isset($message) && $message == 2) :?>
  <script>
  $(document).ready(function(e){
  $("#Messgae_error_link").click();
  });
  </script>
<?php endif; ?>

<!--Error1 Message Display-->
<?php
# Error Message box
if (isset($message) && $message == 3) :?>
  <script>
  $(document).ready(function(e){
  $("#Messgae_error1_link").click();
  });
  </script>
<?php endif; ?>

</body>

<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
