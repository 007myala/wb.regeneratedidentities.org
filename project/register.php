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
          <div class="row">
            <div class="col-xl-12 col-md-6 mb-12">
              <div class="card bg-warning text-white shadow" >
                <div class="card-body">
                  <div class="text-white-50 small">
                    <h3><i class="fas fa-users"></i> Project Users</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 border-left border-bottom overflow-auto" style="height: 560px;">
              <br /><br />
              <h3><i class="fas fa-user-plus"></i> Add new User</h3>
              <hr />
              <div class="alert alert-warning" role="alert">
                <b>Highlights:</b> <br />
                1. To change access level for a user : Delete and add them again. <br/>
                2. No log is recorded for your actions on this page.<br/>
                3. For Admin accounts please contact <i><a href="mailto:admin@regid.ca" target="_blank">admin@regid.ca</a></i>.
              </div>
              <form class="user" action="utilities/commands_external/register.php" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="fname" type="text" class="form-control" id="exampleFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input name="lname" type="text" class="form-control " id="exampleLastName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control " id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="form-group">
                  <input name="Organization" type="text" class="form-control " id="exampleInputEmail" placeholder="University/Organization">
                </div>
                <div class="form-group">
                  <select class="form-control" name="security" id="exampleFormControlSelect1">
                    <option value="0" selected>Researcher</option>
                    <option value="1">Project Director</option>
                  </select>
                </div>
                <?php
                if(isset($_GET['message'])) {
                  if($_GET['message']==1) {
                    echo "<p style=\"color:red;\">Error! It seems you already have an account. Please request admin for password reset. </p>";
                  } else if($_GET['message']==2) {
                    echo "<p style=\"color:green;\">New account is now created and the credentials were emailed to the new user! Their account is now active on <i>Renegerated Identities</i>.  </p>";
                  }
                } ?>
                <div class="form-group">
                  <button class="btn btn-primary  btn-block" type="submit">
                    Create New Account
                  </button>
                </div>
              </form>
            </div>
            <div class="col-6 border-left border-bottom overflow-auto" style="height: 560px;">
              <br /><br />
              <h3><i class="fas fa-users"></i> Existing Users</h3>
              <hr />
              <?php
                if(isset($_GET['message'])) {
                  if($_GET['message']==3){ ?>
                    <div class="alert alert-danger" role="alert">
                      The user's account was deactivated and deleted! They won't be able to log into <i>Regenerated Identites</i> any more.
                    </div>
                  <?php }
                  if($_GET['message']==4){ ?>
                    <div class="alert alert-warning" role="alert">
                      The system recorded an error! Please contact support.
                    </div>
                  <?php }
                } ?>
              <br />
              <div class="row ">
                <?php
                $q1="SELECT * FROM `users` WHERE `security` < 2";
                $query = $conn->query($q1);
                while(  $user_data = $query->fetch(PDO::FETCH_ASSOC)){ ?>
                  <div class="col-6 p-2">
                    <div class="card mx-auto d-block" style="width: 18rem;">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $user_data['fname']. " ".$user_data['lname'] ;?><span class="float-right"><a href="utilities/commands_external/delete_user.php?id=<?php echo $user_data['id'];?>" style="color: red;"><i class="fas fa-trash-alt"></i></a><span></h5>
                        <?php if($user_data['security']==0) { ?>
                          <h6 class="card-subtitle mb-2 text-muted">Researcher</h6>
                        <?php } ?>
                        <?php if($user_data['security']==1) { ?>
                          <h6 class="card-subtitle mb-2 text-muted">Project Director</h6>
                        <?php } ?>
                        <?php if($user_data['security']==2) { ?>
                          <h6 class="card-subtitle mb-2 text-muted">Administrator</h6>
                        <?php } ?>

                        <p class="card-text">
                          <b>Affiliation: </b><br><?php echo $user_data['Organization'];?><br/>
                          <b>Email:</b><br> <?php echo $user_data['email'];?>
                        </p>

                      </div>
                    </div>
                  </div>
                <?php } ?>
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
