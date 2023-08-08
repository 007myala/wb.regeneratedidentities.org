<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
$table=$_GET['table'];

$q6="SELECT * FROM `sections_list` WHERE `TableName` LIKE '".$table."'";
$query6 = $conn->query($q6);
$section_name= $query6->fetch(PDO::FETCH_ASSOC);

require 'utilities/database_SS.php';

//NEW ENTRY
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
$date_only = $date->format('Y-m-d');
$RA = $results['fname']." ".$results['lname'];
$Log=$date_only." by ".$RA;
$field="";
$k=0;$total_col=0;


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

  <title>Regenerated Identities</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <script src="https://cdn.tiny.cloud/1/d5k8206574e4gmmp6lx46f7efki4zmqhbuy97q6b0ooblrdf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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

            <div class="row">
            <div class="col-xl-12 col-md-12 mb-12">

              <div class="card bg-secondary text-white shadow">
                <div class="card-body">
                  Database:
                  <div class="text-white-50 small"><h3><?php echo $section_name['SectionName'];?></h3></div>
                </div>
              </div>

            </div>

        </div>
        <br>
        <?php if($section_name['AddList']==1){ ?>
        <a href="utilities/commands_external/add_to_list.php?table=<?php echo $table;?>&RA=<?php echo $RA;?>"><button type="button" class="col-3 btn btn-info btn-block waves-effect waves-light p-2">Add new entry to this list</button></a>
        <br>
        <?php } ?>
          <!-- Content Row -->
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>

                  <th>Name/Title</th>
                  <th>Latest Log Record</th>
                  <th> </th>

              </tr>
            </thead>
          </tbody>
          <?php
          require 'utilities/database_SS.php';
          $q1="SELECT * FROM `".$table."`";
          $query = $conn->query($q1);
          while($context_data = $query->fetch(PDO::FETCH_ASSOC)){
            if(isset($context_data['Name'])){
              $head=$context_data['Name'];
            }
            if(isset($context_data['Title'])){
              $head=$context_data['Title'];
            }


          echo "<tr>";
          echo "<td width=\"600\" ! important>" .$head . "</td>";
          echo "<td width=\"600\" ! important>" .$context_data['Log'] . "</td>";
          echo "<td width=\"154\" ! important><a href=\"data_edit.php?table=".$table."&id=".$context_data['id']."\" class=\"btn btn-success btn-block waves-effect waves-light\">Edit Section</a></td>";





          echo "</tr>";
          }
          ?>
        </tbody>
      </table>

        <?php
          require 'utilities/database_SS.php';

             ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <?php require 'utilities/footer.php';?>

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
          The changes were successfully recorded in the project database.
          <br><span style="color: green;">These edited were also published on the public website!<br>
          <br><span style="color: red;"> Please note that no log is maintained for this section.</span> <br>

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
        <div class="modal-body">You have made no changes to exisitng data!   </div>
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
  <script type="application/x-javascript">
  var sessionValue = '<%=Session["fname"]%>'

tinymce.init({
  selector: "#TypeHere",  // change this value according to your HTML
  plugins: [
   "advlist autolink link charmap print",
   "searchreplace visualblocks fullscreen",
   "lists hr table paste wordcount image "
 ],
 toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
 content_css: '//www.tiny.cloud/css/codepen.min.css',
 images_upload_base_path: 'http://ew.regeneratedidentities.org/project',
 images_upload_url: 'plugins/postAcceptor.php',
 automatic_uploads: true,
 toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: "<?php echo $RA;?>"




});

</script>

  <!--Success Message Display-->
  <?php
  # Success Message box
  if ($message == 1) :
    ?>

    <script>
    $(document).ready(function(e){
    $("#Messgae_success_link").click();
    });
    </script>
  <?php   endif; ?>

  <!--Error Message Display-->
  <?php
  # Error Message box
  if ($message == 2) :
    ?>

    <script>
    $(document).ready(function(e){
    $("#Messgae_error_link").click();
    });
    </script>
  <?php   endif; ?>

  <!--Error1 Message Display-->
  <?php
  # Error Message box
  if ($message == 3) :
    ?>

    <script>
    $(document).ready(function(e){
    $("#Messgae_error1_link").click();
    });
    </script>
  <?php   endif; ?>




</body>


<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
