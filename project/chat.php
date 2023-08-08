<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';


require 'utilities/database_login.php';
$chat=0;
$addmessage_query="UPDATE `users` SET `chat`='".$chat."' WHERE `email` = '".$results['email']."'";
$addmessage_query_conn = $conn->prepare($addmessage_query);

if( $addmessage_query_conn->execute() ):
endif;
if(!empty($_POST['message']) ):


  $addmessage_query1="SELECT MAX(`chat`) as `max` from `users`";
  $addmessage_query_conn1 = $conn->query($addmessage_query1);
  $max_message = $addmessage_query_conn1->fetch(PDO::FETCH_ASSOC);
  $chat=$max_message['max']+1;



  $addmessage_query="UPDATE `users` SET `chat`='".$chat."' WHERE `email` != '".$results['email']."'";
  $addmessage_query_conn = $conn->prepare($addmessage_query);
  if( $addmessage_query_conn->execute() ):
		$message = 1;
	else:
		$message = 2;
	endif;




require 'utilities/database_SS.php';
	// Enter the new user in the database
	$sql = "INSERT INTO chat (sender,timestamp, message) VALUES (:sender, :timestamp, :message)";
	$stmt = $conn->prepare($sql);
	$sender=$results['fname']." ".$results['lname'];
        $date = new DateTime();
        $last_update = $date->format('Y-m-d H:i:s');
	$stmt->bindParam(':sender', $sender);
	$stmt->bindParam(':timestamp', $last_update);
	$stmt->bindParam(':message', $_POST['message']);


	if( $stmt->execute() ):
		$message = 1;
	else:
		$message = 2;
	endif;

endif;
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

  <title>Regenerated Identites - Chat</title>

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
                  <h3><i class="fas fa-comment"></i> Group Chat</h3>

                </div>
            </div>
          </div>




        <div class="row">
          <div class="col-xl-12 col-md-12 mb-12">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <!-------SPLITING ENTRIES------>
                            <?php


                            if(empty($_GET['page']))
                            {
                              $page=1;
                            }
                            else {
                              $page=$_GET['page'];
                            }



                            $start = 4 * ($page - 1);//Select number of enties per page here
                            $rows = 4;//Select number of enties per page here

                            $q1="SELECT count(sender) as counts FROM `chat`";
                            $query = $conn->query($q1);
                            $query_pro= $query->fetch(PDO::FETCH_ASSOC);
                            $total_news=$query_pro['counts'];


                            ?>


                            <!-- Pages navigation end -->
                            <table border="0" style="width:100%">
                              <tr>

                                  <!-- Previous page-->
                                <td>
                                  <?php

                                  if($page!=1){?>
                                  <p align=left>
                                    <a href="chat.php?page=<?php echo $page-1;?>"> <i class="fas fa-arrow-circle-left"></i> Previous </a>
                                  </p>
                                  <?php } ?>
                                  <?php if($page==1){?>
                                  <p align=left>
                                     <i class="fas fa-arrow-circle-left"></i> Newer Messages
                                  </p>
                                  <?php } ?>
                                </td>
                                <!-- Previous page END-->


                                <!-- Next page-->
                              <td>
                                <?php

                                //Calculating pages
                                $max_pages=ceil($total_news/4);//Select number of enties per page here

                                if($page!=$max_pages){?>
                                <p align=right>
                                  <a  href="chat.php?page=<?php echo $page+1;?>">Older Messages <i class="fas fa-arrow-circle-right"></i></i></a>
                                </p>
                                <?php } ?>
                                <?php if($page==$max_pages){?>
                                <p align=right>
                                    Older Messages <i class="fas fa-arrow-circle-right"></i>
                                </p>
                                <?php } ?>
                              </td>
                              <!-- Next page END-->


                              </tr>
                            </table>




          <div class="table-responsive">
            <table class="table table-bordered" id="ChatTable" width="100%" cellspacing="0">
              <thead>
                  <tr>


                      <th>FROM</th>
                      <th>DATE/TIME</th>
                      <th>Message</th>



                  </tr>
              </thead>


                  <?php
                  $query = $conn->query("SELECT * FROM `chat` order by timestamp desc LIMIT ".$start.",".$rows);

                  while ($datas = $query->fetch(PDO::FETCH_ASSOC)) { ?>


                            <tbody>
                            <?php

                  echo "<tr>";
                  echo "<td width=15% ! important>" . $datas['sender'] . "</td>";
                  echo "<td width=20% ! important>" . $datas['timestamp'] . "</td>";
                  echo "<td width=65% ! important>" . $datas['message'] . "</td>";
                  echo "</tr>";
                  ?>

                  <?php


                  }
                  ?>
                  </tbody>

          </table>

        </div>
      </div>
        <p> <?php echo "Page ".$page." of ".$max_pages;?></p>

      </div>

    </div>


  </div>


        </div>
        <br><br>

        <!-- Content Row -->
        <div class="row">


         <div class="col-xl-10 col-md-10 mb-10">
         <form class="form-horizontal form-material" action="chat.php" method="post">

              <textarea name="message" rows="4" type="text" placeholder="Type your message here..." class="form-control form-control-line"></textarea>
              <!--<div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Textarea WYSIWYG</label>
                <div class="controls">
                <textarea class="cleditor" id="textarea2" rows="3"></textarea>
                </div>
              </div>-->
        </div>
        <div class="col-xl-2 col-md-2 mb-2">

             <div class="form-group">
                 <div class="col-sm-12">
                <input type="submit" class="btn btn-success" value="Send Message"></input>  <br><br><br>
                  <P> </p>
                 </div>
             </div>


         </form>
        </div>



      </div>
      <br><br>



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

    <!-- Success Message-->
    <div class="modal fade" id="Message_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-check-circle"></i>&nbsp;&nbsp; Message Successfully Sent!</h3>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            Your message was successfully added to the group chat.<br>
            <?php echo $field;?>

           </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>

          </div>
        </div>
      </div>
    </div>
    <!-- Activating Messages -->
    <a style="display: none !important;" id="Messgae_success_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_success"></a>
    <a style="display: none !important;" id="Messgae_error_link"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message_error"></a>


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
          <div class="modal-body">There was an error sending your message! Please contact admin.s   </div>
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
  	<script src="js/jquery.cleditor.min.js"></script>
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
