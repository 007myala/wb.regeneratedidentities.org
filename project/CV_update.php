<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

$date = new DateTime();
$table=$_GET['table'];
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

  <title>Decoding Origins - Home</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

  <!--Load Men and Woment Info and passing to JS-->

</head>


<body id="page-top" onload="Onload_Rules()">

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




                      <div class="card text-white shadow" style="margin-bottom: 5%;">

                        <div class="card-body bg-danger">
                            <div class="text-white-50 small">
                              <h3><i class="fas fa-edit"></i> Controlled Vocabularies - Tables</h3>
                              <?php if(substr(str_replace("_"," ",$table),0,2)=="CV"){?>
                              <h5><?php echo substr(str_replace("_"," ",$table),3);?></h5>
                            <?php }else{?>
                              <h5><?php echo substr(str_replace("_"," ",$table),0);?></h5>
                            <?php }?>

                            </div>
                        </div>


                          <a class="btn btn-secondary float-right" href="CV_tables.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                          <a class="btn btn-warning float-right"href="<?php echo explode("&message", $current_URL)[0];?>&message=5"><i class="fas fa-plus-square"></i> Add New</a>
                            <?php if($results['security']>0){ ?>
                          <a class="btn btn-primary float-right"href="utilities/commands_external/CV_reorder.php?table=<?php echo $table;?>"><i class="fas fa-sort-amount-up-alt"></i> Re-order (Alphabetically)</a>
                        <?php } ?>
                        </div>








                <div class="accordion" id="accordionExample">


                  <?php
                        //Get Max Lst order
                        $q3="SELECT MAX(`listorder`) AS 'MAX_listorder' FROM `".$table."`";
                        $query3 = $conn->query($q3);
                        $MAX_listorder_data = $query3->fetch(PDO::FETCH_ASSOC);
                        $MAX_listorder_data =$MAX_listorder_data['MAX_listorder'];
                        //Get Min List order
                        $q3="SELECT MIN(`listorder`) AS 'MIN_listorder' FROM `".$table."`";
                        $query3 = $conn->query($q3);
                        $MIN_listorder_data = $query3->fetch(PDO::FETCH_ASSOC);
                        $MIN_listorder_data =$MIN_listorder_data['MIN_listorder'];

                      $q3="SELECT * FROM `".$table."` ORDER BY `listorder` ";
                      $query3 = $conn->query($q3);
                      ?>

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <?php if($results['security']>1){ ?>
                                <th> Re-Order</th>
                              <?php }?>
                                <th>Name</th>
                                <th>Submited By</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Log</th>
                                <th> </th>
                              <?php if($results['security']>1){ ?>
                                <th> </th>
                              <?php }?>

                            </tr>
                          </thead>
                      <?php

                      while ($entries = $query3->fetch(PDO::FETCH_ASSOC)) {


                        echo "<tbody><tr>";
                        if($results['security']>1){
                        if($entries['listorder']==$MIN_listorder_data){
                          echo "<td width=\"150\" ! important><h4><a href=\"utilities/commands_external/move_down_CV.php?table=".$table."&listID=".$entries['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-down\"></i></a></h4></td>";
                        }elseif ($entries['listorder']==$MAX_listorder_data) {
                          echo "<td width=\"150\" ! important><h4><a href=\"utilities/commands_external/move_up_CV.php?table=".$table."&listID=".$entries['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-up\"></i></a></h4></td>";
                        }else{
                          echo "<td width=\"150\" ! important><h4><a href=\"utilities/commands_external/move_up_CV.php?table=".$table."&listID=".$entries['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-up\"></i></a><a href=\"utilities/commands_external/move_down_CV.php?table=".$table."&listID=".$entries['ID']."\" class=\"primary waves-effect waves-light\" ><i class=\"fas fa-arrow-circle-down\"></i></a></h4></td>";
                        }
                      }



                        if($entries['Name']=='0'){
                            echo "<td width=\"150\" ! important></td>";
                        }else{
                            echo "<td width=\"150\" ! important>" . htmlspecialchars_decode($entries['Name']) . "</td>";
                        }
                        if($entries['Submitby']=='0'){
                            echo "<td width=\"154\" ! important></td>";
                        }else{
                            echo "<td width=\"154\" ! important>" . $entries['Submitby'] . "</td>";
                        }
                        if($entries['Message']=='0'){
                            echo "<td width=\"300\" ! important></td>";
                        }else{
                            echo "<td width=\"300\" ! important>" . htmlspecialchars_decode($entries['Message']) . "</td>";
                        }

                        if($entries['Status']==0){
                            echo "<td width=\"150\" ! important><i class=\"fas fa-exclamation-circle\"></i>Pending</td>";
                          }else{
                            echo "<td width=\"150\" ! important><i class=\"fas fa-check-circle\"></i>Approved</td>";
                          }

                          $link="utilities/pages/log_CV.php?table=".$table."&entriesID=".$entries['ID']."&name=".$entries['Name'];
                          ?>
                          <td width="150">
                            <button type="button" class="btn btn-warning" onclick="window.open('<?php echo $link;?>',
                                                     'newwindow',
                                               'width=500,height=500');
                                         return false;" >
                            View Log

                            </button>



                          </td>
                          <?php
                        echo "<td width=\"154\" ! important><a href=\"CV_update.php?message=3&table=".$table."&CV_ID=".$entries['ID']."\" class=\"btn btn-primary btn-block waves-effect waves-light\" >Update</a></td>";
                        if($results['security']>0){
                        echo "<td width=\"154\" ! important><a href=\"utilities/commands_external/delete_CV.php?table=".$table."&CV_ID=".$entries['ID']."\" class=\"btn btn-danger btn-block waves-effect waves-light\" >Delete</a></td>";
                        }


                        echo "</tr></tbody>";

                      }
                      echo "</table>";




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

          # Control Vocaublary Submission Box
          if ($message == 5) :
            require 'utilities/modals/add_CV.php';
            endif;




 ?>





</body>

</html>
<?php else:
header("Location: ../decodingorigins-login/index.php");

	 endif; ?>

</html>
