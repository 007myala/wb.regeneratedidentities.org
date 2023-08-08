<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
$TimeDate = $date->format('Y-m-d H:i:s');
 require '../database_SS.php';
 require '../user-check-utilities-subfolders.php';
 $table=$_GET['table'];
 $entriesID=$_GET['entriesID'];
 $entriesName=$_GET['name'];

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
   <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="../../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <!-- Custom styles for this template-->
   <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

   <!--Load Men and Woment Info and passing to JS-->

 </head>


 <body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">


     <!-- Content Wrapper -->
     <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content"><br>
         <div class="container-fluid">
           <div class="row">

             <div class="col-xl-12 col-md-12 mb-12">
           <h3><i class="fas fa-info-circle"></i></hr> DOWP - Controlled Vocaublary Logs</h3>
         </div>

         <div class="col-xl-12 col-md-12 mb-12 pt-4">
           <h5><?php echo $table;?></h5>
           <h4 style="color:#4e73df;"><?php echo htmlspecialchars_decode($entriesName);?></h4>
         </div>

           <?php

           $q_log="SELECT * FROM `log` WHERE `type` LIKE '".$table."' AND `ID` LIKE '".$entriesID."' ORDER BY `TimeDate` DESC";
           $query_log = $conn->query($q_log);
           ?>
           <div class="table-responsive">
           <table class="table">
             <thead>
                 <tr>
                   <th >User</th>
                   <th >Date/Time</th>
                   <th >Action</th>

                 </tr>
               </thead>
               <tbody>


           <?php
           while ($log_entries = $query_log->fetch(PDO::FETCH_ASSOC)) {

           ?>
           <tr>
           <td><?php echo htmlspecialchars_decode($log_entries['RA']); ?></td>
           <td><?php echo htmlspecialchars_decode($log_entries['TimeDate']); ?></td>
           <td><?php echo htmlspecialchars_decode($log_entries['field']); ?></td>
           </tr>
         <?php } ?>

           </tbody>
           </table>
         </div>


       </div>
     </div>

         <!-- /.container-fluid -->

       </div>
       <!-- End of Main Content -->



     </div>
     <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->



   <!-- Bootstrap core JavaScript-->
   <script src="../../vendor/jquery/jquery.min.js"></script>
   <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="../../js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="../../vendor/chart.js/Chart.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="../../js/demo/chart-area-demo.js"></script>
   <script src="../../js/demo/chart-pie-demo.js"></script>

 </body>

 </html>


 </html>
