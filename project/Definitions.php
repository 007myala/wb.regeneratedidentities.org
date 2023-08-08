<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$RA=$results['fname']." ".$results['lname'];
$updated_ID="";
if(isset($_POST["update"])){
   $id=$_POST['id'];
   $tblname=$_POST['tblname'];
   $display=$_POST['display'];
   $definitions=htmlspecialchars($_POST['definitions'], ENT_QUOTES);
   $technical=htmlspecialchars($_POST['technical'], ENT_QUOTES);
   //$credits=$_POST['credits'];
   $action='Meta-field Updated: '.$display.
          '<br>Meta-Field List: '.$tblname.
          '<br>Definition: '.$definitions.
          '<br>Technical Instructions: '.$technical;

   $sql = "UPDATE `" . $tblname . "` SET Definitions = '$definitions',Technical = '$technical',display = '$display'  WHERE id = '$id'";

   $stmt = $conn->prepare($sql);

// execute the query
   $stmt->execute();

// echo a message to say the UPDATE succeeded
   $count=$stmt->rowCount() ;
   if($count>='1'){
     $sql_log = "INSERT INTO `log` (`ID`,`type`,`TimeDate`,`RA`,`field`,`action`) VALUES ('".$id."','Meta-Field Updated','".$TimeDate."','".$RA."','".$tblname."','".$action."')";
     $stmt_log = $conn->prepare($sql_log);
     //Updating Log
     if( $stmt_log->execute() ){
       $updated_ID=$id;
       $flag=1;
       }
       else{
       $updated_ID=$id;
       $flag=0;
       }
//exit();
} else{
  $updated_ID=$id;
  $flag=0;
}
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

  <title>Regenerate Identites - Home</title>

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
          <div class="card bg-warning text-white shadow" style="margin-bottom: 1%;">
            <div class="card-body">
                <div class="text-white-50 small">
                  <h3><i class="fas fa-users"></i> Definitions of Meta-Fields </h3>
                </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-xl-12 col-md-12 mb-12">
                    <div class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Meta-Field List
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >

                        <?php
                       $sql = "SELECT * FROM document_type";
                       $query = $conn->query($sql);
                       $default_table="";
                       while($row = $query->fetch(PDO::FETCH_ASSOC)){
                         echo '<a class="dropdown-item" href="Definitions.php?tblname='. $row['Type'] .'">'. $row['Display'] .'</a>';
                         $default_table=$row['Type'];
                       }?>

                     </div>
                    </div>
                  </div>

                    <div class="col-xl-6 col-md-6 mb-12 pt-4">
                      <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                          <div class="text-white-50 small">Selected Meta-Field List Name:</div>
                          <?php
                          if(isset($_GET["tblname"])){
                            $q = $_GET['tblname'];
                           }else{
                            $q = $default_table;
                           }
                          $assign_tag_query="SELECT * FROM `document_type` WHERE `Type` LIKE '".$q."'";
                          $assign_tag_conn = $conn->query($assign_tag_query);
                          $assign_tag= $assign_tag_conn->fetch(PDO::FETCH_ASSOC);
                          ?>
                          <b><h6><?php echo $assign_tag['Display'];?></b></h6>
                        </div>
                        <a class="btn btn-dark col-xl-6 col-md-6" href="log_Definitions.php?tblname=<?php echo $q;?>">View Log</a>

                      </div>
                    </div>


            <div class="col-xl-12 col-md-12 mb-12 pt-4">


   <?php


    $sql = "SELECT * FROM `{$q}`";
    $query = $conn->query($sql);?>
    <div class="panel panel-primary">
    <table class="table table-responsive">
      <thead>
         <tr class="table-primary">
          <td><h6><b>Field Name</b></h6></td>
          <td><h6><b>Field Definition</b></h6></td>
          <td><h6><b>Technical Instructions</b></h6></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
      </tr>
    </thead>

    <?php while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $row_class="";
      if(isset($updated_ID) & isset($flag))
      { if($updated_ID==$row['id']){
            if($flag==1){
              $row_class='table-success';
              echo '<td id="'.$updated_ID.'" class="table-success"><b>Entry and Log was successfully updated!</b></td>';
            }else{
              $row_class='table-danger';
              echo '<td id="'.$updated_ID.'"  class="table-danger"><b>Opps! An Error occur. Contact Support now and let them know what happened. Use RegID Ticket button in the left navigation bar.</b></td>';
            }
      }
      }
      ?>
    <form action ="#<?php echo $row['id'];?>" method="post">
       <tr class="<?php echo $row_class;?>" id="<?php echo $row['id'];?>">
           <td width="290px"><p><b><?php echo $row['display'];?></b><br><input type="text"  name="display" value="<?=$row['display']?>"></p></td>
           <td><h5><textarea  cols="40" rows="8" name="definitions"><?php echo $row['Definitions'];?></textarea></h5></td>
           <td><h5><textarea  cols="40" rows="8" name="technical"><?php echo $row['Technical'];?></textarea></h5></td>
           <td><button type="submit" name="update" id="update" class="btn btn-primary">Save</button></td>
           <td><h5><input type="hidden"  name="id" value="<?=$row['id']?>"></h5></td>
           <td><h5></h5></td>
           <td> <h5><input type="hidden" name="tblname" value="<?=$q?>"></h5></td>
       </tr>
    </form>
    <?php }?>
   </table>
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
            <span>This website is created and maintaied by <a href="http://kartikaychadha.com" target="_blank">Kartikay Chadha</a>.</span>
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
          <a class="btn btn-primary" href="../decodingorigins-login/logout.php">Logout</a>
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
