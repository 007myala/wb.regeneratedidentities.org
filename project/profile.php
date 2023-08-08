<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';

require 'utilities/database_SS.php';
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
          <div class="card bg-warning text-white shadow" style="margin-bottom: 5%;">
            <div class="card-body">
                <div class="text-white-50 small">
                  <h3><i class="fas fa-user"></i> User Profile</h3>

                </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-8 col-md-6 mb-12">
              <div class="card">
                <?php
                if($results['FirstTime']==0){ ?>
                  <div class="alert alert-warning" role="alert">
                    <b><i class="fas fa-exclamation-triangle"></i> Update Password Now!</b> <br />
                    Our records indicate that either you are still using system generated password or your current password has expired!
                      </div>
                <?php }
                if(isset($_GET['message']))
                {
                  if($_GET['message']==1)
                  { ?>
                    <div class="alert alert-success" role="alert">
                      <b><i class="fas fa-exclamation-triangle"></i> Message</b> <br />
                      Your password was successfully updated! <a href="index.php">Click here</a> to return to Dashboard.
                    </div>

                  <?php }
                  if($_GET['message']==2)
                  { ?>
                    <div class="alert alert-danger" role="alert">
                    <b><i class="fas fa-exclamation-triangle"></i> Message</b> <br />
                    Your password was not updated due to technical difficulties. Please contact support at <i><a href="mailto:support@regid.ca" target="_blank">support@regid.ca</a></i>.
                    </div>

                <?php   }
                }?>

                  <div class="card-body">
                    <h4><?php echo $results['fname']." <span style=\"font-size:35px !important;\">".$results['lname'];?></span></h4><br>
                    <form class="user" action="utilities/commands_external/update_password.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $results['id'];?>">
                      <input type="hidden" name="email" value="<?php echo $results['email'];?>">

                        <div class="form-group">
                          <label for="exampleInputPassword1">Username/Email</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" disabled value="<?php echo $results['email'];?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Affiliation</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" disabled value="<?php echo $results['Organization'];?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Update New Password</label>
                          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="New Password" >
                        </div><br>
                        <button type="submit" class="btn btn-primary" >Update</button>

                      </form>
                  </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-12">
              <div class="card" style="width: 18rem;">
                    <?php if(!empty($results['img'])){ ?>
                    <img class="card-img-top" src="<?php echo $results['img'];?>" alt="User Image">
                  <?php } else {?>
                    <img class="card-img-top" src="img/user/notfound.png" alt="No Image Available">

                  <?php }?>
                  </div>

                  <div class="card-body">
                    <small id="emailHelp" class="form-text text-muted">Access Level</small>
                    <?php if($results['security']==0){ ?>
                    <h5 class="card-title">Researcher</h5>
                  <?php } if($results['security']==1){?>
                    <h5 class="card-title">Project Director</h5>
                  <?php } if($results['security']==2){?>
                    <h5 class="card-title">Administrator</h5>

                  <?php }?>

                  <?php

                  require 'utilities/database_login.php';

                  $q2="SELECT MAX(`TimeDate`) AS `TimeDate` FROM `login_dump` where `Username`='".$results['email']."'";
                  $query2 = $conn_login->query($q2);
                  $log_last = $query2->fetch(PDO::FETCH_ASSOC);

                  ?>
                  <b>Last Login:</b> <?php echo $log_last['TimeDate'];?>


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

</html>
