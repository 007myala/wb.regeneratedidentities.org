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

  <title>Regenerated Identites - Data Export</title>

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
          <div class="card bg-secondary text-white shadow" style="margin-bottom: 5%;">
            <div class="card-body">
                <div class="text-white-50 small">
                  <h3><i class="fas fa-file-export"></i> Export Dataset</h3>

                </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-12 col-md-6 mb-12">
              <div class="card">

                  <div class="card-body">
                    <h5 class="card-title">Steps to export and download dataset in various formats! </h5><br>
                    <p class="card-text">
                      1. Click on the link(s) below to view all dataset in HTML format. <br>
                      <i>Please allow the web-page to load completely. Note
                      that this may take few seconds to few minutes depending on the size of the backend database curated for your
                      project.</i> <br>
                      2. Select all text. Use SELECT + A keys on your keyboard. <br>
                      3. Right click on your mouse and copy the selected values or use Control +
                      C (Windows Keyboards) or Command + (Mac Keyboards) <br>
                      4. Paste the copied values in your desired destination. E.g. Microsoft Excel or Microsoft Word
                      <br><br>
                      <b>If you encounter any errors, please email our technical support team at
                      <a href="mailto:support@regid.ca" target="_blank">support@regid.ca</a> or submit a
                      <a href="https://tickets.regeneratedidentities.org" target="_blank">  RegID Ticket</a>.</b>
                    </p>
                  </div>
                </div>
            </div>


          </div>
          <div class="row pt-4">

            <div class="col-xl-4 col-md-4">
              <a href="utilities/export_data/export_person_data.php" target="_blank">
              <div class="card align-middle" style="height: 10rem;">
                  <div class="card-body">
                    <center>
                    <h1><i class="fas fa-file-export"></i></h1>
                    <h5>Legislation Details (View)</h5>
                  </center>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-xl-4 col-md-4">
              <a href="utilities/export_data/csv_download.php">
              <div class="card align-middle" style="height: 10rem;">
                  <div class="card-body">
                    <center>
                    <h1><i class="fas fa-file-export"></i></h1>
                    <h5>Legislation Details (CSV Download)</h5>
                  </center>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-xl-4 col-md-4">
              <a href="utilities/export_data/export_person-source_data.php" target="_blank">
                <div class="card align-middle" style="min-height: 10rem;">
                  <div class="card-body">
                    <center>
                      <h1><i class="fas fa-file-export"></i></h1>
                      <h5>Legislation Details with Source Details (Custom)</h5>
                    </center>
                  </div>
                </div>
              </a>
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
            <span>This website is created and maintained by <a href="http://kartikaychadha.com" target="_blank">Kartikay Chadha</a>.</span>
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
