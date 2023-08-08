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



          <!-- Content Row -->
          <div class="row">


                            <div class="col-md-12 col-lg-12 col-sm-12">
                              <!-------SPLITING ENTRIES------>
                                          <?php


                                          if(empty($_GET['page_m']))
                                          {
                                            $page_m=1;
                                          }
                                          else {
                                            $page_m=$_GET['page_m'];
                                          }



                                          $start = 10 * ($page_m - 1);//Select number of enties per page_m here
                                          $rows = 10;//Select number of enties per page_m here

                                          $q1="SELECT count(personID) as counts FROM `person` WHERE `assignedto` = '".$results['email']."'";
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
                  <h4> My Tasks </h4>
                </div>
              <div class="col-xl-2 col-md-6 mb-12 " >
                <h4 style="text-align: right !important;">Page : </h4>
                </div>
              <div class="col-xl-1 col-md-6 mb-12">
                <?php $max_page_ms=ceil($total_news/10); ?>
                <form action="#" method="GET">
                  <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';?>">
                  <input type="hidden" name="folder" value="<?php echo isset($_GET['folder']) ? $_GET['folder'] : '';?>">

                  <select class="form-control" name="page_m">
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
              <div class="card-body">
                <!-- page_ms navigation start-->

                <table border="0" style="width:100%">
                  <tr>

                      <!-- Previous page_m-->
                    <td>
                      <?php

                      if($page_m!=1){?>
                      <p align=left>
                        <a href="mytask.php?page_m=<?php echo $page_m-1;?>"> <i class="fas fa-arrow-circle-left"></i> Previous </a>
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
                    $max_page_ms=ceil($total_news/10);//Select number of enties per page_m here

                    if($page_m!=$max_page_ms){?>
                    <p align=right>
                      <a  href="mytask.php?page_m=<?php echo $page_m+1;?>">Next <i class="fas fa-arrow-circle-right"></i></i></a>
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

                          <th>Database ID</th>
                          <th>Name</th>

                          <th>Online Status</th>

                          <th>Message From</th>


                          <th> </th>
                          <th> </th>

                      </tr>
                    </thead>
                  </tbody>

                <?php

                $q1="SELECT * FROM `person` WHERE `assignedto` = '".$results['email']."' LIMIT ".$start.",".$rows;
                $query = $conn->query($q1);


                while ($datas = $query->fetch(PDO::FETCH_ASSOC)) {

                echo "<tr>";
                echo "<td width=\"200\" ! important>" . $datas['UI'] . "</td>";
                echo "<td width=\"200\" ! important>" . $datas['Name'] . "</td>";



                ?>


                <td width="200">
                  <?php if($datas['online']>0){ ?>
                    <p style="color: #1a936f; font-size:16px;"><i class="fas fa-signal"></i> Publication Queued</p>
                  <?php } else { ?>
                    <p style="color: #f8961e; font-size:16px;"><i class="fas fa-globe-americas"></i> Offline</p>
                  <?php }?>
                  </td>


                <?php



                echo "<td width=\"154\" ! important>" . $datas['assignedby'] . "</td>";

                if($datas['doctype']=="NA"){
                  $doctype="NoSelection";
                }else{
                  $doctype=$datas['doctype'];
                }
                echo "<td width=\"154\" ! important><a href=\"person_edit.php?&personID=".$datas['personID']."\" class=\"btn btn-success btn-block waves-effect waves-light\">Update</a></td>";
                echo "<td width=\"154\" ! important><a  href=\"?personID=".$datas['personID']."\" class=\"btn btn-info btn-block waves-effect waves-light\" data-toggle=\"modal\" data-target=\"#forward_msg".$datas['personID']."\">Message</a></td>";
                ?>
                <!-- Forward Meesage View Modal-->

                <div class="modal fade" id="forward_msg<?php echo $datas['personID'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <a class="btn btn-success" href="person_edit.php?personID=<?php echo $datas['personID'];?>">Update Entry <i class="fas fa-pen"></i></a>
                        <a class="btn btn-info" href="forward.php?personID=<?php echo $datas['personID'];?>">Reply <i class="fas fa-share"></i></a>
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
            <p> <?php echo "Page ".$page_m." of ".$max_page_ms;?></p>

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
  <!-- End of page_m Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page_m-top">
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
  <?php   endif; ?>

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
  <?php   endif; ?>

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
  <?php   endif; ?>



</body>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
