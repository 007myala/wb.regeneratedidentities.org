<?php session_start();
error_reporting(0);
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
 

$q_source_data="SELECT * FROM `object`";
$query_source_data = $conn->query($q_source_data);
while ($source_data = $query_source_data->fetch(PDO::FETCH_ASSOC)) {

    
    //Extract all IDS saved in source metafield column
    $selectedoptions=$source_data['Field27'];
    $selectedoptions_Array = explode(';', trim($selectedoptions,';'));

    $q_CV_source_fields1= "SELECT * FROM CV_Location";
    $query_CV_source_fields1 = $conn->query($q_CV_source_fields1);
                  
      while($CV_source_fields1 = $query_CV_source_fields1->fetch(PDO::FETCH_ASSOC)){
        foreach($selectedoptions_Array as $opt_selected){
          if($opt_selected==$CV_source_fields1['ID']){
            $locationsname[]= $CV_source_fields1['Name'];
            $latitudedata[]=$CV_source_fields1['y_coordinate'];
            $longitudedata[]=$CV_source_fields1['x_coordinate'];
            $sourcedata[]=$source_data['Field5'];
            
           
            $q_person_fields1= "select person.Name as Name,person.Field1 as Title,person.Field2 as Nationality,person.Field3 as Language from person, object, objects_person where person.personID=objects_person.personID and objects_person.objectID=object.objectID and object.objectID = '".$source_data['objectID']."'";
            $query_person_fields1 = $conn->query($q_person_fields1);
             //echo $source_data['objectID'];     
            while($CV_person_fields1 = $query_person_fields1->fetch(PDO::FETCH_ASSOC)){

              $pName[]=$CV_person_fields1['Name'];
              $pTitle[]= $CV_person_fields1['Title'];

              $q5="SELECT `ID`,`Name` FROM CV_Nationality WHERE `ID` LIKE '".$CV_person_fields1['Nationality']."'";
              $query_CL = $conn->query($q5); 
              while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){
                $pNationality[]=$selected_word['Name'];
              }
              
              $q6="SELECT `ID`,`Name` FROM CV_Language WHERE `ID` LIKE '".$CV_person_fields1['Language']."'";
              $query_CL = $conn->query($q6); 
              while($selected_word = $query_CL->fetch(PDO::FETCH_ASSOC)){
                $pLanguage[]=$selected_word['Name'];
              }
            }
                
                 
              if(empty($pName)){
                $personName[]="Person Name Not Found";
                $personTitle[]="Person Title Not Found";
                $personNationality[]="Person Nationality Not Found";
                $personLanguage[]="Person Language Not Found";
              }else{
                $personName[]=implode('<br>', $pName);
                unset($pName);
                $personTitle[]=implode('<br>', $pTitle);
                unset($pTitle);
                $personNationality[]=implode('<br>', $pNationality);
                unset($pNationality);
                $personLanguage[]=implode('<br>', $pLanguage);
                unset($pLanguage);
              }
          }
        }
      }
    }?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Regenerated Identites - Map</title>

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
          
          <div class="card " style="margin-bottom: 5%;">
            <div class="card-header">
                <div class=" small">
                  <h3><i class="fas fa-map-marker-alt"></i> Map</h3>
                </div>
            </div>
          </div>

           <!-- Content Row -->
          <div class="row">
            <div class="col-xl-12 col-md-6 mb-12">
               <div id="map" class="p-5" style="height: 500px; width: auto;" ></div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
      <link rel="stylesheet" href="https://regid.ca/10Sept2021_AL/MarkerCluster.css" />
      <link rel="stylesheet" href="https://regid.ca/10Sept2021_AL/MarkerCluster.Default.css" />
      <script src="https://regid.ca/10Sept2021_AL/leaflet.js"></script>
      <script src="https://regid.ca/10Sept2021_AL/markercluster.js"></script>
      
     <script type="text/javascript">
      var locations = <?php echo json_encode($locationsname); ?>;
      var latitude = <?php echo json_encode($latitudedata); ?>;
      var longitude = <?php echo json_encode($longitudedata); ?>;
      var source = <?php echo json_encode($sourcedata); ?>;
      var pname = <?php echo json_encode($personName); ?>;
      var ptitle = <?php echo json_encode($personTitle); ?>;
      var pNationality = <?php echo json_encode($personNationality); ?>;
      var pLanguage = <?php echo json_encode($personLanguage); ?>;
  

      var map = L.map('map').setView([5.208570, -4.420624], 2);
      //http://{s}.tile.osm.org/{z}/{x}/{y}.png
      //https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}
      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      var markers = L.markerClusterGroup();

      for (var i = 0; i < latitude.length; i++) {
 
        var title = locations[i];
        var marker = L.marker(new L.LatLng(latitude[i], longitude[i]), {
        title: title
        });
        
        if(pname[i]=='Person Name Not Found'){
          var content="</br> <h6><b>Location</b></h6><h6>" + locations[i] + "</h6><h6><b>Primary Source</b></h6><h6>" + source[i] + "</h6> " ;
        
        }
        else{
          var content="</br> <h6><b>Location</b></h6><h6>" + locations[i] + "</h6><h6><b>Primary Source</b></h6><h6>" + source[i] + "</h6> <h6><b>Person Name</b></h6><h6>" + pname[i] + "</h6> <h6><b>Person Title</b></h6><h6>" + ptitle[i] + "</h6> <h6><b>Person Nationality</b></h6><h6>" + pNationality[i] + "</h6> <h6><b>Person Language</b></h6> <h6>" + pLanguage[i] + "</h6>" ;
        
        }
        marker.bindPopup(content, {
          'maxWidth': '250',
          'maxHeight':'250',
          'minWidth': '250',
          'minHeight':'250'
        });
  
        markers.addLayer(marker);
      }
       map.addLayer(markers);
    </script>

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
  
</body>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>

</html>
