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

  <title>Regenerated Identites - My Tasks</title>

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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">West African Research</h1>
            <a href="javascript:history.back()" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left"></i> Back</a>
          </div>
          <?php if(!empty($_GET[folder])): ?>
          <div class="d-sm-flex align-items-center justify-content-between mb-4" style="border:2px !important; background-Color: #DCDEDF !important;height:40px !important; padding: 10px !important;">

            <?php
            $path=str_replace("/"," / ",$_GET['folder']);
            echo $path; ?>


          </div>
        <?php endif; ?>


          <!-- Content Row -->
          <div class="row">


                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <!-------SPLITING ENTRIES------>
                                          <?php


                                          if(empty($_GET['page']))
                                          {
                                            $page=1;
                                          }
                                          else {
                                            $page=$_GET['page'];
                                          }

                                          if(empty($_GET['search'])){
                                          $search="";
                                        }
                                        else{

                                          $search=$_GET['search'];

                                        }
                                          $start = 10 * ($page - 1);//Select number of enties per page here
                                          $rows = 10;//Select number of enties per page here
                                          $columns = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = 'object' AND TABLE_SCHEMA = 'ScarificationSources'";
                                          $query = $conn->query($columns);
                                          //put each like clause in an array
                                          $queryLikes = array();
                                          while ($column = $query->fetch(PDO::FETCH_ASSOC)) {
                                              $queryLikes[] = $column['COLUMN_NAME'] . " LIKE '%$search%'";
                                          }


                                          if(empty($_GET['folder'])){
                                            $query = "SELECT count(ObjectID) as counts FROM object WHERE " . implode(" OR ", $queryLikes);
                                          }
                                          else{
                                            if(empty($_GET['search'])){
                                              $query = "SELECT count(ObjectID) as counts FROM object WHERE `new_name` LIKE '%".$_GET['folder']."%' ";
                                            }else{
                                            $query = "SELECT count(ObjectID) as counts FROM object WHERE (" . implode(" OR ", $queryLikes).") AND `new_name` LIKE '%".$_GET['folder']."%' ";
                                          }
                                        }


                                          $query = $conn->query($query);
                                          $query_pro= $query->fetch(PDO::FETCH_ASSOC);
                                          $total_news=$query_pro['counts'];


                                          ?>


                                          <!-- Pages navigation end -->

                            </div>
            <div class="col-xl-12 col-md-12 mb-12">
            <div class="card mb-3">
              <div class="card-header">
              <?php require 'utilities/menu_cards.php'; ?>
              <div class="card-body">
                <!-- Pages navigation start-->

                <table border="0" style="width:100%">
                  <tr>

                      <!-- Previous page-->
                    <td>
                      <?php

                      if($page!=1){?>
                      <p align=left>
                        <a href="search.php?page=<?php echo $page-1;?>&search=<?php echo $_GET['search']?>&folder=<?php echo $_GET['folder']?>"> <i class="fas fa-arrow-circle-left"></i> Previous </a>
                      </p>
                      <?php } ?>
                      <?php if($page==1){?>
                      <p align=left>
                         <i class="fas fa-arrow-circle-left"></i> Previous
                      </p>
                      <?php } ?>
                    </td>
                    <!-- Previous page END-->


                    <!-- Next page-->
                  <td>
                    <?php

                    //Calculating pages
                    $max_pages=ceil($total_news/10);//Select number of enties per page here

                    if($page!=$max_pages){?>
                    <p align=right>
                      <a  href="search.php?page=<?php echo $page+1;?>&search=<?php echo $_GET['search']?>&folder=<?php echo $_GET['folder']?>">Next <i class="fas fa-arrow-circle-right"></i></i></a>
                    </p>
                    <?php } ?>
                    <?php if($page==$max_pages){?>
                    <p align=right>
                        Next <i class="fas fa-arrow-circle-right"></i>
                    </p>
                    <?php } ?>
                  </td>
                  <!-- Next page END-->


                  </tr>
                </table>

                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>

                        <th>Manual ID</th>
                        <th>Title</th>
                        <th>Researcher</th>
                        <th>Progress %</th>
                        <th>Creator</th>


                          <th> </th>


                      </tr>
                    </thead>
                  </tbody>

                <?php
                $columns = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = 'object' AND TABLE_SCHEMA = 'ScarificationSources'";
                $query = $conn->query($columns);
                //put each like clause in an array
                $queryLikes = array();
                while ($column = $query->fetch(PDO::FETCH_ASSOC)) {
                    $queryLikes[] = $column['COLUMN_NAME'] . " LIKE '%$search%'";
                }

                if(empty($_GET['folder'])){
                  $query = "SELECT * FROM object WHERE " . implode(" OR ", $queryLikes)." LIMIT ".$start.",".$rows;

                  }
                else{
                  if(empty($_GET['search'])){
                    $query = "SELECT * FROM object WHERE  `new_name` LIKE '%".$_GET['folder']."%' LIMIT ".$start.",".$rows;
                  }else{

                  $query = "SELECT * FROM object WHERE (" . implode(" OR ", $queryLikes).") AND `new_name` LIKE '%".$_GET['folder']."%' LIMIT ".$start.",".$rows;
                }
                }



                $query = $conn->query($query);


                while ($datas = $query->fetch(PDO::FETCH_ASSOC)) {

                echo "<tr>";
                echo "<td width=\"200\" ! important>" . $datas['FN_Title'] . "</td>";
                echo "<td width=\"200\" ! important>" . $datas['Title'] . "</td>";
                echo "<td width=\"200\" ! important>" . $datas['Researcher'] . "</td>";



                ?>


                <td width="200">
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class=" mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $datas['Complete'];?>%</div>
                    </div>
                    <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $datas['Complete'];?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>

                  </td>


                <?php


                echo "<td width=\"154\" ! important>" . $datas['Creator'] . "</td>";

                if($datas['doctype']=="NA"){
                  $doctype="NoSelection";
                }else{
                  $doctype=$datas['doctype'];
                }
                echo "<td width=\"154\" ! important><a href=\"object_edit.php?search=",$_GET[search],"&folder=".$_GET['folder']."&request=2&page=".$page."&objectID=".$datas['objectID']."&doctype=".$doctype."\" class=\"btn btn-success btn-block waves-effect waves-light\">Update</a></td>";
                  ?>
                <!-- Forward Meesage View Modal-->

                <div class="modal fade" id="forward_msg<?php echo $datas['objectID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" style="color: Purple !important;" id="exampleModalLabel"><i class="fas fa-comment-alt"></i>&nbsp; Message</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <b>From : </b><?php echo $datas['assignedby'];?><br>
                        <b>Message  : <br></b><?php echo $datas['message'];?><br>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-success" href="object_edit.php?request=2&page=<?php echo $page;?>&objectID=<?php echo $datas['objectID'];?>&doctype=<?php echo $doctype;?>">Update Entry <i class="fas fa-pen"></i></a>
                        <a class="btn btn-info" href="forward.php?request=2&page=<?php echo $page;?>&objectID=<?php echo $datas['objectID'];?>&doctype=<?php echo $doctype;?>">Reply <i class="fas fa-share"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <?php



                echo "</tr>";
                }
                ?>
              </tbody>
            </table>
            <p> <?php echo "Page ".$page." of ".$max_pages;?></p>

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
          The following fields are now updated and log is updated.<br>
          <?php echo $field;?>

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

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
