<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

$q2="SELECT * FROM `person` WHERE `personID` LIKE '".$_GET['personID']."'";
$query2 = $conn->query($q2);
$person= $query2->fetch(PDO::FETCH_ASSOC);
$doctype=$person['doctype'];

$q1="SELECT * FROM `".$doctype."`";
$query1 = $conn->query($q1);

//NEW ENTRY
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
$personID = $_GET['personID'];
$RA = $results['fname']."".$results['lname'];
$field="";
$k=0;$total_col=0;

// Get the previous page
if(isset($_GET['page_m'])){
  $page_m = $_GET['page_m'];
} else {
  $page_m = 1;
}

// Get the set entries per page
if(isset($_GET['pCnt'])){
  $pCnt = $_GET['pCnt'];
} else {
  $pCnt = 10;
}

$pID = $_GET['pID'];

//***************************************************
// Update Assignedto
if(isset($_GET['action']) && $_GET['action']=="forward" ){
  $personID = $_GET['personID'];
  $assignedto = $_POST['assignedto'];
  $message =$_POST['message'];
  $field="Forwarded To : ".$assignedto."<br>Message : ".$message;
  $date = new DateTime();
  $TimeDate = $date->format('Y-m-d H:i:s');
  $date_only = $date->format('Y-m-d');
  $RA = $results['fname']." ".$results['lname'];

  //Update entry
  $sql = "UPDATE `person` SET `assigneddate`=\"".$TimeDate."\",`assignedto`=\"".$assignedto."\",`message` =\"".$message."\",`assignedby` = \"".$RA."\" WHERE `personID` = \"".$personID."\"";
  $stmt = $conn->prepare($sql);

  if($stmt->execute()):
    $action="Task Forwarded";
    $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$personID."','person','".$TimeDate."','".$RA."','".$field."','".$action."')";
    $stmt_log = $conn->prepare($sql_log);
    if( $stmt_log->execute() ){
      $message = 1;
    } else {
      $message = 3;
    }
  else:
    $message = 2;
  endif;
  //End of Update Entry
} ?>

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
          <!-- Content Row -->
          <?php
          $q1="SELECT * FROM `person` WHERE `personID` LIKE '".$_GET['personID']."'";
          $query = $conn->query($q1);
          $person_data = $query->fetch(PDO::FETCH_ASSOC);
          $assignedto=$person_data['assignedto'];?>
          <div class="row">
            <div class="col-xl-12 col-md-12 mb-12">
              <div class="card mb-3">
                <div class="card-header">
                  <div class="row">
                    <div class="col-xl-9 col-md-6 mb-12">
                    <h3> <?php if($person_data['Name']=="NA"){echo "Unkown";}else{echo $person_data['Name'];} ?> </h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <b>Database Identifier : </b><?php echo $person_data['UI']; ?><br>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-6 col-md-6 mb-12">
            <div class="col-xl-8 col-md-6 mb-12">
              <h4>Assignment Form</h4>
              <form action="forward.php?page_m=<?php echo $page_m;?>&pCnt=<?php echo $pCnt;?>&pID=<?php echo $pID;?>&personID=<?php echo $_GET['personID'];?>&doctype=<?php echo $doctype;?>&action=forward" method="POST">

              <input name="action" value="forward" type=hidden>

              <div class="form-group">
                <label for="exampleInputEmail1">Assign To:</label>
                <?php
                require 'utilities/database_login.php';
                $q1="SELECT * FROM `users` WHERE `email` LIKE '".$assignedto."'";
                $query_user = $conn->query($q1);
                $assign_flag= $query_user->fetch(PDO::FETCH_ASSOC);
                $assign=(isset($assign_flag['fname']) ? $assign_flag['fname'] : '') ." ". (isset($assign_flag['lname']) ? $assign_flag['lname'] : '');

                $q1="SELECT * FROM `users` WHERE `".$person_data['project']."`=1";
                $query1 = $conn->query($q1);?>

                <select class="form-control" name="assignedto">
                  <?php while($user= $query1->fetch(PDO::FETCH_ASSOC)){
                    if($user['email']==$person_data['assignedto']){
                      # Continue; ##Restricting Self-assignment
                      echo "<option value=\"".$user['email']."\">".$user['fname']." ".$user['lname']."</option>";
                    } else {
                      echo "<option value=\"".$user['email']."\">".$user['fname']." ".$user['lname']."</option>";
                    }
                  } ?>
                </select>
              </div>
            </div>

            <div class="col-xl-9 col-md-6 mb-12 pull-right">
              <textarea rows="8" class="form-control" id="message" name="message"  placeholder="Type here" ></textarea>
              <br>
              <div class="row">
                <div class="col-xl-4 col-md-6 mb-12 pull-right">
                <button type="submit" class="btn btn-success">Assign <i class="fas fa-check"></i></button>
              </div>
              </form>
              <div class="col-xl-5 col-md-6 mb-12 pull-right">
                <a href="person_edit.php?&personID=<?php echo $_GET['personID'];?>&page_m=<?php echo $page_m;?>&pCnt=<?php echo $pCnt;?>&pID=<?php echo $pID;?>" class="btn btn-secondary">Back <i class="fas fa-times"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-12">
          <div class="col-xl-8 col-md-6 mb-12">
            <h4>Current Status</h4>
            <form action="forward.php?page_m=<?php echo $page_m;?>&pCnt=<?php echo $pCnt;?>&pID=<?php echo $pID;?>&personID=<?php echo $_GET['personID'];?>&doctype=<?php echo $doctype;?>&action=forward" method="POST">

            <input name="action" value="forward" type=hidden>

            <div class="form-group">
              <label for="exampleInputEmail1">Assigned To:</label>
              <input type="text" class="form-control" value="<?php echo $assign; ?>" disabled>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Assigned By:</label>
              <input type="text" class="form-control" value="<?php if($person_data['assignedby']!=="NA"){echo $person_data['assignedby'];} ?>" disabled>
            </div>
          </div>
          <div class="col-xl-9 col-md-6 mb-12 pull-right">
            <label for="exampleInputEmail1">Message:</label>
            <textarea rows="5" class="form-control" id="message" name="message" disabled><?php if($person_data['message']!="NA"){echo $person_data['message'];}?> </textarea>
          </div>
        </div>
      </div>
      <br>
      <br><br>
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
          The following fields are now updated and log is updated.<br>
          <?php echo $field;?>

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
        <div class="modal-body">The file was updated but there was an error in updating the log. Please contact admin using group chat!   </div>
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

  <!--Success Message Display-->
  <?php
  # Success Message box
  if (isset($message) && $message == 1): ?>
    <script>
    $(document).ready(function(e){
      $("#Messgae_success_link").click();
      });
    </script>
  <?php endif; ?>

  <!--Error Message Display-->
  <?php
  # Error Message box
  if (isset($message) && $message == 2): ?>
    <script>
    $(document).ready(function(e){
      $("#Messgae_error_link").click();
      });
    </script>
  <?php endif; ?>

  <!--Error1 Message Display-->
  <?php
  # Error Message box
  if (isset($message) && $message == 3): ?>
    <script>
    $(document).ready(function(e){
      $("#Messgae_error1_link").click();
      });
    </script>
  <?php endif; ?>
</body>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
