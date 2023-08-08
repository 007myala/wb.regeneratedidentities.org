<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
$objectID = $_GET['objectID'];

$RA = $results['fname']." ".$results['lname'];
$field="";
$current_URL=$_SERVER['REQUEST_URI'];

//Loading Message
if(isset($_GET['message'])){
$message=$_GET['message'];}
else{
$message=0;
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



            <!--Editing Form -->
            <div class="col-xl-12 col-md-12 mb-12">

                <!--Display Person Information-->



                      <div class="card bg-secondary text-white shadow" style="margin-bottom: 5%;">
                        <div class="card-body">
                            <div class="text-white-50 small">
                              <h3><i class="fas fa-file"></i> Log
                                <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><i class="fas fa-times float-right text-white-50"></i></h3></a>
                                <?php if(!isset($table)){
                                  $table='';
                                }?>
                                <h5><?php echo substr(str_replace("_"," ",$table),3);?></h5>
                            </div>

                        </div>
                      </div>



                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>

                            <th>TimeStamp</th>
                            <th>User Name</th>
                            <th>Action</th>
                            <th>Details</th>


                        </tr>
                      </thead>
                    <tbody>
                  <?php

                  //Loading person data
                  $q2="SELECT * FROM `log` WHERE `type` LIKE 'object' AND `ID` LIKE '".$objectID."' ORDER BY `TimeDate` DESC";
                  $query2 = $conn->query($q2);

                  while ($datas = $query2->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td width=\"100\" ! important>" . $datas['TimeDate'] . "</td>";
                    echo "<td width=\"154\" ! important>" . $datas['RA'] . "</td>";
                    echo "<td width=\"200\" ! important>" . $datas['action'] . "</td>";
                    echo "<td width=\"200\" ! important>" . $datas['field'] . "</td>";
                    echo "</tr>";


                  }




                    ?>
                  </tbody>
                </table>





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

        # Create new Object
        if ($message == 3) :
          require 'utilities/modals/create_object.php';
          endif;


 ?>





</body>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
