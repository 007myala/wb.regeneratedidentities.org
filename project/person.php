<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';

    if(empty($_GET['projectID'])){
    $projectID="%";
    }
    else {
    $projectID=$_GET['projectID'];
    }

    if(isset($_GET['statusOnline'])){
      $statusO = $_GET['statusOnline'];
    } else {
      $statusO=""; // To be able to show both online & offline
    }

    if(isset($_GET['pCnt'])){
      $pCnt = $_GET['pCnt'];
    } else {
      $pCnt = 10;
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

  <style>
    #select2-page-select-container {
      padding:0.2rem 0.75rem;
    }
    .select2-container--default .select2-selection--single {
      height:100%!important;
    }
  </style>

</head>


<body id="page_m-top">

  <!-- page_m Wrapper -->
  <div id="wrapper">

<!-- Sidebar menu -->
  <?php require 'utilities/sidebar_menu.php'; ?>
  <!-- Sidebar menu End -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php require 'utilities/topbar.php'; ?>

        <!-- Begin page_m Content -->
        <div class="container-fluid">
          <!-- page_m Heading -->
          <!-- Content Row -->
          <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
              <!-------SPLITING ENTRIES------>
              <?php
              if(empty($_GET['page_m'])){
                $page_m=1;
              } else {
                $page_m=$_GET['page_m'];
              }

              $start = $pCnt * ($page_m - 1);//Select number of enties per page_m here
              $rows = $pCnt;//Select number of enties per page_m here
              $search="";
              if(isset($_GET['search'])){
                $search="AND `UI` LIKE '%".$_GET['search']."%' OR `Name` LIKE '%".$_GET['search']."%'";
              }
              if($statusO=='0'){
                $search .= " AND `online` != '1'";
              } else if($statusO=='1') {
                $search .= " AND `online` = '1'";
              }
              $q1="SELECT count(personID) as counts FROM `person` WHERE `project` LIKE '".$projectID."' ".$search;
              $query = $conn->query($q1);
              $query_pro= $query->fetch(PDO::FETCH_ASSOC);
              $total_news=$query_pro['counts'];
              ?>
              <!-- page_ms navigation end -->
            </div>
            <div class="col-xl-12 col-md-12 mb-12">
              <div class="card mb-3">
                <div class="card-header">
                  <div class="row">
                    <div class="col-xl-8 col-md-6 mb-12 " >
                      <?php
                      require 'utilities/database_login.php';

                      $q_projectselect="SELECT * FROM `Project` WHERE `ProjectID` LIKE '".$projectID."'";

                      $query_projectselect = $conn->query($q_projectselect);
                      $projectselect= $query_projectselect->fetch(PDO::FETCH_ASSOC);
                      echo "<h4><a href=\"".$projectselect['Glink']."\" target=\"_blank\"><i class=\"fab fa-google-drive\"></i></a> ".$projectselect['ProjectName']."</h4>";
                      require 'utilities/database_SS.php';
                      ?>
                    </div>
                    <div class="col-xl-2 col-md-6 mb-12">
                      <h4 style="text-align: right !important;">Page : </h4>
                    </div>
                    <div class="col-xl-1 col-md-6 mb-12">
                      <?php $max_page_ms=ceil($total_news/$pCnt); ?>
                      <form action="#" method="GET">
                        <input type="hidden" name="projectID" value="<?php echo $projectID;?>">
                        <input type="hidden" name="statusOnline" value="<?php echo $statusO;?>">
                        <input type="hidden" name="pCnt" value="<?php echo $pCnt; ?>">
                        <select id="page-select" class="form-control" name="page_m" style="padding:0.375rem 0.75rem">
                          <?php
                            echo "<option value=\"\" selected disabled hidden>".$page_m."</option>";
                            for($x=1;$x<=$max_page_ms;$x++){
                              echo "<option value=\"".$x."\">".$x."</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="col-xl-1 col-md-6 mb-12 pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                        </form>
                      </div>
                  </div>
                </div>
                <div class="card-body">
                  <!-- page_ms navigation start-->
                  <table border="0" style="width:100%">
                    <tr class="pb-3">
                      <td>
                        <a class="btn btn-warning" style="margin-bottom:16px;margin-left:8px;" href="person.php?projectID=<?php echo $projectID;?>&statusOnline=0"> <i class="fas fa-database"></i> View Offline Records </a>

                        <a class="btn btn-success" style="margin-bottom:16px;margin-left:8px;" href="person.php?projectID=<?php echo $projectID;?>&statusOnline=1"> <i class="fas fa-database"></i> View Online Records </a>
                      </td>
                    </tr>
                    <tr>
                      <!-- Previous page_m-->
                      <td>
                        <?php
                        if($page_m!=1){?>
                        <p align=left>
                          <?php if(isset($_GET['search'])){
                            $search_text_p="&search=".$_GET['search'];
                          } else {
                            $search_text_p="";
                          }
                          $search_text_p .= "&statusOnline=".$statusO;
                          ?>
                          <a href="person.php?projectID=<?php echo $projectID;?><?php echo $search_text_p;?>&pCnt=<?php echo $pCnt;?>&page_m=<?php echo $page_m-1;?>&pID=<?php echo $pID;?>"> <i class="fas fa-arrow-circle-left"></i> Previous </a>
                        </p>
                        <?php } ?>
                        <?php if($page_m==1){?>
                        <p align=left>
                          <i class="fas fa-arrow-circle-left"></i> Previous
                        </p>
                        <?php } ?>
                      </td>
                      <!-- Previous page_m END-->

                      <!-- Next page_m-->
                      <td>
                        <?php
                        //Calculating page_ms
                        $max_page_ms=ceil($total_news/$pCnt);//Select number of enties per page_m here

                        if($page_m!=$max_page_ms){?>
                          <p align=right>
                            <?php if(isset($_GET['search'])){
                              $search_text="&search=".$_GET['search'];
                            } else {
                              $search_text="";
                            }
                            $search_text .= "&statusOnline=".$statusO;
                            ?>
                            <a href="person.php?projectID=<?php echo $projectID;?><?php echo $search_text;?>&pCnt=<?php echo $pCnt;?>&page_m=<?php echo $page_m+1;?>&pID=<?php echo $projectID;?>">Next <i class="fas fa-arrow-circle-right"></i></i></a>
                          </p>
                        <?php } ?>
                        <?php if($page_m==$max_page_ms){?>
                        <p align=right>
                            Next <i class="fas fa-arrow-circle-right"></i>
                        </p>
                        <?php } ?>
                      </td>
                      <!-- Next page_m END-->
                    </tr>
                  </table>

                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Reg ID</th>
                          <th>Name</th>
                          <th>Assigned To</th>
                          <th>Online Status</th>
                          <th> </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $q1="SELECT * FROM `person` WHERE `project` LIKE '".$projectID."' ".$search." LIMIT ".$start.",".$rows;
                        $query = $conn->query($q1);

                        while ($datas = $query->fetch(PDO::FETCH_ASSOC)) {
                          echo "<tr>";
                          echo "<td width=\"200\" ! important>" . $datas['UI'] . "</td>";
                          echo "<td width=\"154\" ! important>" . $datas['Name'] . "</td>";
                          require 'utilities/database_login.php';
                          $q1="SELECT * FROM `users` WHERE `email` LIKE '".$datas['assignedto']."'";
                          $query_user = $conn->query($q1);
                          $assign_flag= $query_user->fetch(PDO::FETCH_ASSOC);
                          $assign=(isset($assign_flag['fname']) ? $assign_flag['fname'] : '') ." ". (isset($assign_flag['lname']) ? $assign_flag['lname'] : '');

                          echo "<td width=\"200\" ! important>" . $assign . "</td>";
                          require 'utilities/database_SS.php';
                        ?>

                          <td width="200">
                            <?php if($datas['online']>0){ ?>
                              <p style="color: green; font-size:16px;"><i class="fas fa-signal"></i> Online</p>
                            <?php } else { ?>
                              <p style="color: #f8961e; font-size:16px;"><i class="fas fa-globe-americas"></i> Offline</p>
                            <?php }?>
                          </td>

                          <?php
                          if($datas['doctype']=="NA"){
                            $doctype="";
                          }else{
                            $doctype=$datas['doctype'];
                          }
                          echo "<td width=\"154\" ! important><a href=\"person_edit.php?&personID=".$datas['personID']."&page_m=".$page_m."&pID=".$projectID."&pCnt=".$pCnt."\" class=\"btn btn-success btn-block waves-effect waves-light\">Update</a></td>";
                          echo "</tr>";
                        } ?>
                      </tbody>
                    </table>
                    <div class="row" style="margin-left:0;margin-right:0;">
                      <div class="col-md-6 pb-3 text-left">
                        <p> <?php echo "Page ".$page_m." of ".$max_page_ms;?></p>
                      </div>
                      <div class="col-md-6 pb-3 text-right">
                        <form action="#" method="GET">
                          <input type="hidden" name="projectID" value="<?php echo $projectID;?>">
                          <input type="hidden" name="page_m" value="<?php echo $page_m;?>">
                          <label for="pCnt-select">Entries per page:</label>
                          <select id="pCnt-select" class="form-control" name="pCnt" style="padding:0.375rem 0.75rem; max-width:80px;display:inline;">
                            <?php 
                              $pOptions = array("10","25","50","100","250","500","1000");
                              foreach($pOptions as $pOpt):
                                $selected = "selected";?>
                                <option value="<?php echo $pOpt; ?>" <?php echo $pCnt == $pOpt ? $selected : ''; ?>><?php echo $pOpt; ?></option>
                            <?php 
                              endforeach;
                            ?>
                          </select>
                          <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-7 col-md-12 mb-12">
            </div>

            <div class="col-xl-5 col-md-10 mb-12">
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
  <!-- End of page_m Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page_m-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Activating Messages -->
  <a style="display: none !important;" id="Messgae_success_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_success"></a>
  <a style="display: none !important;" id="Messgae_error_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_error"></a>
  <a style="display: none !important;" id="Messgae_error1_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_erro1"></a>

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
          The following fields are now updated and log is updated.<br>
          <?php echo isset($field) ? $field : '';?>
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
        <div class="modal-body">The file was updated but there was an error in updating the log. Please contact admin using group chat!   </div>
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

  <!-- Custom scripts for all page_ms-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- page_m level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- page_m level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <!--Select2 Dropdown-->
  <link href="vendor/select2/select2.min.css" rel="stylesheet" />
  <script src="vendor/select2/select2.min.js"></script>

  <!--Handle Dropdown Search-->
  <script>
    $(document).ready(function(e){
      $('#page-select').select2();
    });

    $(document).ready(function(e){
      //$('#pCnt-select').select2();
    });
  </script>

  <!--Success Message Display-->
  <?php
  # Success Message box
  if (isset($message) && $message == 1) :
    ?>

    <script>
    $(document).ready(function(e){
      $("#Messgae_success_link").click();
      });
    </script>
  <?php endif; ?>

  <!--Error Message Display-->
  <?php
  # Error Message box
  if (isset($message) && $message == 2) :
    ?>
    <script>
      $(document).ready(function(e){
      $("#Messgae_error_link").click();
      });
    </script>
  <?php endif; ?>

  <!--Error1 Message Display-->
  <?php
  # Error Message box
  if (isset($message) && $message == 3) :
    ?>
    <script>
      $(document).ready(function(e){
      $("#Messgae_error1_link").click();
      });
    </script>
  <?php endif; ?>

</body>

</html>
<?php else:
  header("Location: ../index.php");
	endif; ?>

</html>
