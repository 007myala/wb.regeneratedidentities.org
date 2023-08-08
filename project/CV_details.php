<?php session_start();
date_default_timezone_set('America/Toronto');
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
$CV=$_GET['type'];

//Loading Instructions data
$q2="SELECT * FROM `".$CV."` WHERE `Status`=1 ORDER BY `listorder`";
$query2 = $conn->query($q2);



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


<body id="page-top" >

  <!-- Page Wrapper -->
  <div id="wrapper">


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content"><br>


        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12 col-md-12 mb-12">
            <h2><i class="fas fa-info-circle"></i></hr> RegID - Controlled Vocaublaries</h2>
            <br>
            <div class="card" >

              <div class="card-body">
                <p class="card-text"><b>Table Name:</b><br>  <?php echo $CV;?></p>

              </div>
            </div>
              <br><br>
            <div class="card" >
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search for terms here..">

                  <div class="table-responsive" style="height:500px !important;">
                                     <table class="table table-hover table-bordered" id="myTable">
                                          <thead class="thead-dark">
                                            <tr>
                                              <th style="width:20% !important">Name</th>
                                              <th style="width:40% !important">Variations</th>
                                              <th style="width:40% !important">Used in Database</th>
                                              <th style="width:40% !important">Region</th>
                                            </tr>

                                          </thead>
                                          <tbody>

                                     <?php while($info= $query2->fetch(PDO::FETCH_ASSOC)){

                                         ?>

                                                <tr>

                                                  <td ><?php echo $info['Name'];?></td>
                                                  <td ><?php
                                                  $values="";
                                                  if($info['Variations']!="0"){
                                                  $values=$values.$info['Variations'].";";
                                                  }
                                                  echo $values;?>
                                                </td>
                                                <td >

                                                  <?php
                                                  $values="";
                                                  //Searching all tables for Variations
                                                  $q1="SELECT * FROM `document_type`";
                                                  $query1 = $conn->query($q1);
                                                  while($doc_type= $query1->fetch(PDO::FETCH_ASSOC)){
                                                    $q3="SELECT * FROM `".$doc_type['Type']."` WHERE `Options` LIKE '".$CV."' AND `FieldType` LIKE 'text-dependent'";
                                                    $query3 = $conn->query($q3);

                                                    $q5="SELECT * FROM `".$doc_type['Type']."` WHERE `Options` LIKE '".$CV."' AND `FieldType` LIKE 'dropdown-CV'";
                                                    $query5 = $conn->query($q5);
                                                    $term_field_data=$query5->fetch(PDO::FETCH_ASSOC);
                                                    $term_field=$term_field_data['ColumnName'];

                                                    while($fields= $query3->fetch(PDO::FETCH_ASSOC)){
                                                      $q4="SELECT DISTINCT `".$fields['ColumnName']."` AS `variations` FROM `".$doc_type['Sheet']."` WHERE `".$term_field."` LIKE '".$info['ID']."'";

                                                      $query4 = $conn->query($q4);
                                                      while($variations= $query4->fetch(PDO::FETCH_ASSOC)){
                                                        if($variations['variations']!="0"){
                                                          $values=$values.$variations['variations'].";";
                                                        }
                                                      }

                                                    }

                                                  }
                                                  echo $values;
                                                  ?>

                                                  </td>
                                                  <td ><?php echo $info['Region'];?></td>



                                                  </tr>

                                     <?php } ?>

                                   </tbody>
                                 </table>
                               </div>
                             </div>
            <br><br>

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
  <script>
  function myFunction() {

    // Declare variables
    var input = document.getElementById("myInput");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("myTable");
    var trs = table.tBodies[0].getElementsByTagName("tr");

    // Loop through first tbody's rows
    for (var i = 0; i < trs.length; i++) {

      // define the row's cells
      var tds = trs[i].getElementsByTagName("td");

      // hide the row
      trs[i].style.display = "none";

      // loop through row cells
      for (var i2 = 0; i2 < tds.length; i2++) {

        // if there's a match
        if (tds[i2].innerHTML.toUpperCase().indexOf(filter) > -1) {

          // show the row
          trs[i].style.display = "";

          // skip to the next row
          continue;

        }
      }
    }

  }
  </script>


</body>

</html>


</html>
