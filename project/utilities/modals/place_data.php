<a style="display: none !important;" id="Messgae"class="dropdown-item" href="#" data-toggle="modal" data-target="#Message"></a>

<script>
$(document).ready(function(e){
$("#Messgae").click();
});
</script>

<!-- Success Message-->
<div class="modal fade" id="Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height:450px !important;">
      <div class="modal-header">
        <h3 class="modal-title" style="color: green !important;" id="MessageModalLabel"> <i class="fas fa-map-marker-alt"></i></i>&nbsp;&nbsp; Place Data</h3>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">


      <div class="row">

          <div class="col-md-6">
        <?php
        $placeID=$_GET['place'];
        $q1="SELECT * FROM `CV_Place` WHERE `ID` LIKE '".$placeID."'";
        $query = $conn->query($q1);
        $place_data= $query->fetch(PDO::FETCH_ASSOC);

        //Extract Column Names

        $q1="DESCRIBE `CV_Place`";
        $query_CL = $conn->query($q1);

        while($Available_Names = $query_CL->fetch(PDO::FETCH_ASSOC)){
          if($Available_Names['Field']=="ID" || $Available_Names['Field']=="Status" ||$Available_Names['Field']=="Message" ||$Available_Names['Field']=="Submitby"){

            }else{
              if($place_data[$Available_Names['Field']]!="0"){
                $f_name="<b>".str_replace("_"," ",$Available_Names['Field'])."</b>";
                echo $f_name." : ".$place_data[$Available_Names['Field']]."<br>";
            }

        }}?>



  </div>
  <div class="col-md-6">
    <?php if($place_data['Latitude']!=0 & $place_data['Longitute']!=0){ ?>
    <iframe width="100%"
  height="250px"
  frameborder="0"
  scrolling="no"
  marginheight="0"
  marginwidth="0" src = "https://maps.google.com/maps?q=<?php echo $place_data['Latitude']; ?>,<?php echo $place_data['Longitute']; ?>&hl=es;z=14&amp;output=embed"></iframe>
<?php } else {
  echo "<p style=\"color: red !important\"><i class=\"fas fa-exclamation-circle\"></i> Lattitude or Longitude Data required to generate Map!</p>";
}?>
  </div>
    </div>

       </div>
      <div class="modal-footer">

        <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
