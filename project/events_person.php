<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
$personID = $_GET['personID'];
$RA = $results['fname']." ".$results['lname'];
$field="";
$current_URL=$_SERVER['REQUEST_URI'];

//Loading Message
if(isset($_GET['message'])){
$message=$_GET['message'];}
else{
$message=0;
}

//Loading person data
$q2="SELECT * FROM `person` WHERE `personID` LIKE '".$personID."'";
$query2 = $conn->query($q2);
$person_data= $query2->fetch(PDO::FETCH_ASSOC);




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

          <div class="row">

            <!--Person Menu -->
            <div class="col-xl-3 col-md-12 mb-12">
                <?php require('utilities/person-menu.php'); ?>
            </div>

            <!--Editing Form -->
            <div class="col-xl-9 col-md-12 mb-12">

                <!--Display Person Information-->



                      <div class="card bg-warning text-white shadow" style="margin-bottom: 5%;">
                        <div class="card-body">
                            <div class="text-white-50 small">
                              <h3><i class="fas fa-file"></i> Events</h3>

                            </div>
                        </div>
                      </div>
                      <div class="text-white-50 small" style="margin-bottom: 1%;">
                      <a href="<?php echo explode("&message", $current_URL)[0];?>&message=3"><button class="btn btn-success pull-right"><i class="fas fa-plus"> Add Event</i></button></a>
                    </div>



                  <?php

                    require 'utilities/sections/person_event-list.php';

                    ?>
                    <br>





                  <br><br>

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
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="max-width: 500px !important; margin: 1.75rem auto !important;">
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
  <script src="select2/dist/js/select2.min.js"></script>


  <!--Success Message Display-->
  <?php
        # Success Message box
        if ($message == 1) :
          require 'utilities/modals/success.php';
             endif;

       # Object Edit Message box
        if ($message == 2) :
        require 'utilities/modals/error.php';
        endif;

        # Create new event
        if ($message == 3) :
          require 'utilities/modals/create_event.php';
          endif;
          # Create new event
          if ($message == 4) :
            require 'utilities/modals/remove_event.php';
            endif;


 ?>





</body>
<script>
$(document).ready(function(){

  // Initialize select2
  $(".searchdropdown").select2();

  $('.multiselect2').select2();



});

</script>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
