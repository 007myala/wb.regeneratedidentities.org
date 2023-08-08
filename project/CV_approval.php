<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
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
                              <h3><i class="fas fa-edit"></i> Controlled Vocabulary - Approve New Submissions</h3>

                            </div>
                        </div>
                      </div>
                      <h5> Data Fields</h5>


                <div class="accordion" id="accordionExample">


                  <?php


                  $q1="SELECT * FROM `CV_tables` ORDER BY `TableName`";
                  $query1 = $conn->query($q1);
                  $consolidated="";

                    while ($tables = $query1->fetch(PDO::FETCH_ASSOC)) {

                      $q3="SELECT * FROM `".$tables['TableName']."` WHERE `Status` LIKE '0'";
                      $query3 = $conn->query($q3);

                      $entry_count=0;
                      while ($entries = $query3->fetch(PDO::FETCH_ASSOC)) {
                        $entry_count=$entry_count+1;

                      }
                      $consolidated=$consolidated.$tables['Display']." : ".$entry_count."<br>";

                      ?>
                      <div class="card">
                        <div class="card-header" id="headingOne<?php echo $tables['TableName'];?>">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne<?php echo $tables['ID'];?>" aria-expanded="true" aria-controls="collapseOne<?php echo $tables['ID'];?>">
                              <h5 class="m-0 font-weight-bold text-primary"><?php echo $tables['Display'];?><sup> <?php echo $entry_count;?></sup></h5>


                            </button>
                          </h2>
                        </div>

                        <div id="collapseOne<?php echo $tables['ID'];?>" class="collapse" aria-labelledby="headingOne<?php echo $tables['ID'];?>" data-parent="#accordionExample">
                          <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>

                                <th>Name</th>
                                <th>Submited By</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th> </th>

                            </tr>
                          </thead>
                      <?php
                      $q4="SELECT * FROM `".$tables['TableName']."` WHERE `Status` LIKE '0'";
                      $query4 = $conn->query($q4);
                      while ($entries_data = $query4->fetch(PDO::FETCH_ASSOC)) {


                        echo "<tbody><tr>";
                        echo "<td width=\"200\" ! important>" . $entries_data['Name'] . "</td>";
                        echo "<td width=\"154\" ! important>" . $entries_data['Submitby'] . "</td>";
                        echo "<td width=\"200\" ! important>" . $entries_data['Message'] . "</td>";
                        if($entries_data['Status']==0){
                            echo "<td width=\"200\" ! important>Pending</td>";
                          }else{
                            echo "<td width=\"200\" ! important>Approved</td>";
                          }
                        echo "<td width=\"154\" ! important><a href=\"CV_approval.php?message=3&table=".$tables['TableName']."&CV_ID=".$entries_data['ID']."\" class=\"btn btn-primary btn-block waves-effect waves-light\" >Update</a></td>";

                        echo "</tbody>  </tr>";


                      }
                      echo "</table>";
                      echo "</div>";
                      echo "</div>";
                      echo "</div>";
                      echo "</div>";


                    }
                    echo "<br>";
                    echo $consolidated;
                    ?>







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

       # Error Message
        if ($message == 2) :
        require 'utilities/modals/error.php';
        endif;

        # Update CV
        if ($message == 3) :
          require 'utilities/modals/update_CV.php';
          endif;


 ?>





</body>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
