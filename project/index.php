<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
require 'utilities/database_regid.php';
 ?>
 <!DOCTYPE html>
<html lang="en" manifest="catch.mf">

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

          <!-- Page Heading -->


          <!-- Content Row -->
          <div class="row">
            <?php
            if($results['FirstTime']==0){ ?>
              <div class="alert alert-warning" role="alert" style="width: 100%;">
                <b><i class="fas fa-exclamation-triangle"></i> Update Password Now!</b> <br /><br />
                Our records indicate that either you are still using system generated password or your current password has expired!
                <br><a href="profile.php">Click here</a> to update your password now.<br><br>
              </div>
            <?php } ?>

            <div class="col-xl-6 col-md-6 mb-12 pb-5" >
              <div class="card" >
                  <div class="card-header">
                    Notifications
                  </div>
                  <div class="card-body overflow-auto" style="max-height: 500px !important;">
                    <h5 class="card-title">Messages from Administrator:</h5><br>
                    <?php
                    $dashboard="SELECT * FROM `Dashboard` ORDER BY `TimeStamp` DESC";
                    $dashboard_q = $conn_regid->query($dashboard);
                   while($dashboardData = $dashboard_q->fetch(PDO::FETCH_ASSOC)){
                     if(isset($results[$dashboardData['Project']]) && $results[$dashboardData['Project']]>0 ||  $dashboardData['Project']=="%"){ ?>

                      <?php if($dashboardData['Project']=="%")
                       {
                         $project_name="All Network Broadcast";
                       } else{
                         $project_name=$dashboardData['Project']."-Message-Posted";
                       }
                       ?>
                       <div class="card p-2">
                         <div class="card-body">

                           <?php if($dashboardData['new']==1){ ?>
                           <sup><img class="float-right" src="img/upcoming.gif" alt="upcoming"></sup><br>
                        <?php  }?>
                          <?php if($dashboardData['new']==2){ ?>
                          <sup><img class="float-right" src="img/new1.gif" alt="upcoming"></sup><br>
                        <?php }?>
                         <p> <?php echo $project_name." : ".$dashboardData['TimeStamp'];?>(EST)</p>
                           <p class="card-text" style="Color: red"><i class="fas fa-hand-point-right"></i>
                            <b> <?php echo $dashboardData['Title'];?></b><br>
                             <span style="Color: #2F7BD0">
                               <?php echo $dashboardData['Message'];?>
                             </span>
                           </p>
                           <i>Posted by : <?php echo $dashboardData['PostedBy'];?></i>
                           </div>
                           </div>
                           <br>

                       <?php


                     }

                   }

                    ?>


                  </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-12">


                <div class="card">
                    <div class="card-header">
                      Your Projects / Tasks
                    </div>
                    <div class="card-body">
                    <div class="row">
                      <?php require 'utilities/menu_cards.php'; ?>
                    </div>
                  </div>
            </div>
            <br />
            <div class="card">
                    <div class="card-header">
                       <b>Google API Installed </b><br> Now translate <i>Regenerated Identites</i> in a language of your choice!
                                </div>
                                <div class="card-body">
                                <div class="row p-1">
                                    <div id="google_translate_element"></div>
                                    <br/><br/>
                                    <p>We are currently testing this plugin. Please email us feedback at <a href="mailto:support@regid.ca">support@regid.ca</a></p>
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
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
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

</body>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>
