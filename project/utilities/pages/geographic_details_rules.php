<script type="text/javascript">
function Onload_Rules(){
  var e = document.getElementById("Type_of_Geographic_Area");
   var type = e.options[e.selectedIndex].value;
   var e = document.getElementById("place_check");
   var x = e.options[e.selectedIndex].value;

   if(type=="Location"){
     document.getElementById("Type_of_Location").style.display= "block";
     document.getElementById("Type_of_Location_label").style.display= "block";
     document.getElementById("Latitude").style.display= "block";
     document.getElementById("Latitude_label").style.display= "block";
     document.getElementById("Longitude").style.display= "block";
     document.getElementById("Longitude_label").style.display= "block";

     document.getElementById("place_check").style.display= "block";
     document.getElementById("place_check_label").style.display= "block";
     if(x == "Yes"){
       document.getElementById("City/Town/Village").style.display= "block"
       document.getElementById("City/Town/Village_label").style.display= "block";
     }
     if(x == "No") {
       document.getElementById("City/Town/Village").style.display= "none";
       document.getElementById("City/Town/Village").value= 0;
       document.getElementById("City/Town/Village_label").style.display= "none";
     }

     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "block";
     document.getElementById("Country/State_(at_the_time)").style.display= "block";
     document.getElementById("Country/State_(at_the_time)_label").style.display= "block";
     document.getElementById("Region").style.display= "block";
     document.getElementById("Region_label").style.display= "block";
     document.getElementById("Continent").style.display= "block";
     document.getElementById("Continent_label").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "block";
     document.getElementById("Country/State_(Modern)").style.display= "block";
     document.getElementById("Country/State_(Modern)_label").style.display= "block";
   } else if(type=="City/Town/Village"){
     document.getElementById("Type_of_Location").style.display= "none";
     document.getElementById("Type_of_Location").value= "0";
     document.getElementById("Type_of_Location_label").style.display= "none";
     document.getElementById("Latitude").style.display= "block";
     document.getElementById("Latitude_label").style.display= "block";
     document.getElementById("Longitude").style.display= "block";
     document.getElementById("place_check").style.display= "none";
     document.getElementById("place_check_label").style.display= "none";
     document.getElementById("Longitude_label").style.display= "block";
     document.getElementById("City/Town/Village").style.display= "none";
     document.getElementById("City/Town/Village").value= "Unknown";
     document.getElementById("City/Town/Village_label").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "block";
     document.getElementById("Country/State_(at_the_time)").style.display= "block";
     document.getElementById("Country/State_(at_the_time)_label").style.display= "block";
     document.getElementById("Region").style.display= "block";
     document.getElementById("Region_label").style.display= "block";
     document.getElementById("Continent").style.display= "block";
     document.getElementById("Continent_label").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "block";
     document.getElementById("Country/State_(Modern)").style.display= "block";
     document.getElementById("Country/State_(Modern)_label").style.display= "block";
   } else if(type=="Province/Colony/Dependency/Emirate"){
     document.getElementById("Type_of_Location").style.display= "none";
     document.getElementById("Type_of_Location_label").style.display= "none";
     document.getElementById("Latitude").style.display= "none";
     document.getElementById("Latitude_label").style.display= "none";
     document.getElementById("Longitude").style.display= "none";
     document.getElementById("Longitude_label").style.display= "none";
     document.getElementById("place_check").style.display= "none";
     document.getElementById("place_check_label").style.display= "none";
     document.getElementById("City/Town/Village").style.display= "none";
     document.getElementById("City/Town/Village_label").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
     document.getElementById("Country/State_(at_the_time)").style.display= "block";
     document.getElementById("Country/State_(at_the_time)_label").style.display= "block";
     document.getElementById("Region").style.display= "block";
     document.getElementById("Region_label").style.display= "block";
     document.getElementById("Continent").style.display= "block";
     document.getElementById("Continent_label").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "block";
     document.getElementById("Country/State_(Modern)").style.display= "block";
     document.getElementById("Country/State_(Modern)_label").style.display= "block";
   } else if(type=="Country/State"){
     document.getElementById("Type_of_Location").style.display= "none";
     document.getElementById("Type_of_Location_label").style.display= "none";
     document.getElementById("Latitude").style.display= "none";
     document.getElementById("Latitude_label").style.display= "none";
     document.getElementById("Longitude").style.display= "none";
     document.getElementById("Longitude_label").style.display= "none";
     document.getElementById("place_check").style.display= "none";
     document.getElementById("place_check_label").style.display= "none";
     document.getElementById("City/Town/Village").style.display= "none";
     document.getElementById("City/Town/Village_label").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
     document.getElementById("Country/State_(at_the_time)").style.display= "none";
     document.getElementById("Country/State_(at_the_time)_label").style.display= "none";
     document.getElementById("Region").style.display= "block";
     document.getElementById("Region_label").style.display= "block";
     document.getElementById("Continent").style.display= "block";
     document.getElementById("Continent_label").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "none";
     document.getElementById("Country/State_(Modern)").style.display= "block";
     document.getElementById("Country/State_(Modern)_label").style.display= "block";
   } else if(type=="Region"){
     document.getElementById("Type_of_Location").style.display= "none";
     document.getElementById("Type_of_Location_label").style.display= "none";
     document.getElementById("Latitude").style.display= "none";
     document.getElementById("Latitude_label").style.display= "none";
     document.getElementById("Longitude").style.display= "none";
     document.getElementById("Longitude_label").style.display= "none";
     document.getElementById("place_check").style.display= "none";
     document.getElementById("place_check_label").style.display= "none";
     document.getElementById("City/Town/Village").style.display= "none";
     document.getElementById("City/Town/Village_label").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
     document.getElementById("Country/State_(at_the_time)").style.display= "none";
     document.getElementById("Country/State_(at_the_time)_label").style.display= "none";
     document.getElementById("Region").style.display= "none";
     document.getElementById("Region_label").style.display= "none";
     document.getElementById("Continent").style.display= "block";
     document.getElementById("Continent_label").style.display= "block";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "none";
     document.getElementById("Country/State_(Modern)").style.display= "none";
     document.getElementById("Country/State_(Modern)_label").style.display= "none";
   } else if(type=="Unknown" || type=="Continent"){
     document.getElementById("Type_of_Location").style.display= "none";
     document.getElementById("Type_of_Location_label").style.display= "none";
     document.getElementById("Latitude").style.display= "none";
     document.getElementById("Latitude_label").style.display= "none";
     document.getElementById("Longitude").style.display= "none";
     document.getElementById("Longitude_label").style.display= "none";
     document.getElementById("place_check").style.display= "none";
     document.getElementById("place_check_label").style.display= "none";
     document.getElementById("City/Town/Village").style.display= "none";
     document.getElementById("City/Town/Village_label").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
     document.getElementById("Country/State_(at_the_time)").style.display= "none";
     document.getElementById("Country/State_(at_the_time)_label").style.display= "none";
     document.getElementById("Region").style.display= "none";
     document.getElementById("Region_label").style.display= "none";
     document.getElementById("Continent").style.display= "none";
     document.getElementById("Continent_label").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "none";
     document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "none";
     document.getElementById("Country/State_(Modern)").style.display= "none";
     document.getElementById("Country/State_(Modern)_label").style.display= "none";

   }
}
function place_known(type) {

  if(type == "Yes"){
    document.getElementById("City/Town/Village").style.display= "block"
    document.getElementById("City/Town/Village_label").style.display= "block";
  }
  if(type == "No"){
    document.getElementById("City/Town/Village").style.display= "none"
    document.getElementById("City/Town/Village_label").style.display= "none";

  }
}

function Type_of_Geographic_Area_Rules(type) {
  var e = document.getElementById("place_check");
  var x = e.options[e.selectedIndex].value;

  if(type=="Location"){
    document.getElementById("Type_of_Location").style.display= "block";
    document.getElementById("Type_of_Location_label").style.display= "block";
    document.getElementById("Latitude").style.display= "block";
    document.getElementById("Latitude_label").style.display= "block";
    document.getElementById("Longitude").style.display= "block";
    document.getElementById("Longitude_label").style.display= "block";

    document.getElementById("place_check").style.display= "block";
    document.getElementById("place_check_label").style.display= "block";
    if(x == "Yes"){
      document.getElementById("City/Town/Village").style.display= "block"
      document.getElementById("City/Town/Village_label").style.display= "block";
    }
    if(x == "No") {
      document.getElementById("City/Town/Village").style.display= "none";
      document.getElementById("City/Town/Village_label").style.display= "none";
    }

    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "block";
    document.getElementById("Country/State_(at_the_time)").style.display= "block";
    document.getElementById("Country/State_(at_the_time)_label").style.display= "block";
    document.getElementById("Region").style.display= "block";
    document.getElementById("Region_label").style.display= "block";
    document.getElementById("Continent").style.display= "block";
    document.getElementById("Continent_label").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "block";
    document.getElementById("Country/State_(Modern)").style.display= "block";
    document.getElementById("Country/State_(Modern)_label").style.display= "block";
  } else if(type=="City/Town/Village"){
    document.getElementById("Type_of_Location").style.display= "none";
    document.getElementById("Type_of_Location_label").style.display= "none";
    document.getElementById("Latitude").style.display= "block";
    document.getElementById("Latitude_label").style.display= "block";
    document.getElementById("Longitude").style.display= "block";
    document.getElementById("place_check").style.display= "none";
    document.getElementById("place_check_label").style.display= "none";
    document.getElementById("Longitude_label").style.display= "block";
    document.getElementById("City/Town/Village").style.display= "none";
    document.getElementById("City/Town/Village_label").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "block";
    document.getElementById("Country/State_(at_the_time)").style.display= "block";
    document.getElementById("Country/State_(at_the_time)_label").style.display= "block";
    document.getElementById("Region").style.display= "block";
    document.getElementById("Region_label").style.display= "block";
    document.getElementById("Continent").style.display= "block";
    document.getElementById("Continent_label").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "block";
    document.getElementById("Country/State_(Modern)").style.display= "block";
    document.getElementById("Country/State_(Modern)_label").style.display= "block";
  } else if(type=="Province/Colony/Dependency/Emirate"){
    document.getElementById("Type_of_Location").style.display= "none";
    document.getElementById("Type_of_Location_label").style.display= "none";
    document.getElementById("Latitude").style.display= "none";
    document.getElementById("Latitude_label").style.display= "none";
    document.getElementById("Longitude").style.display= "none";
    document.getElementById("Longitude_label").style.display= "none";
    document.getElementById("place_check").style.display= "none";
    document.getElementById("place_check_label").style.display= "none";
    document.getElementById("City/Town/Village").style.display= "none";
    document.getElementById("City/Town/Village_label").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
    document.getElementById("Country/State_(at_the_time)").style.display= "block";
    document.getElementById("Country/State_(at_the_time)_label").style.display= "block";
    document.getElementById("Region").style.display= "block";
    document.getElementById("Region_label").style.display= "block";
    document.getElementById("Continent").style.display= "block";
    document.getElementById("Continent_label").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "block";
    document.getElementById("Country/State_(Modern)").style.display= "block";
    document.getElementById("Country/State_(Modern)_label").style.display= "block";
  } else if(type=="Country/State"){
    document.getElementById("Type_of_Location").style.display= "none";
    document.getElementById("Type_of_Location_label").style.display= "none";
    document.getElementById("Latitude").style.display= "none";
    document.getElementById("Latitude_label").style.display= "none";
    document.getElementById("Longitude").style.display= "none";
    document.getElementById("Longitude_label").style.display= "none";
    document.getElementById("place_check").style.display= "none";
    document.getElementById("place_check_label").style.display= "none";
    document.getElementById("City/Town/Village").style.display= "none";
    document.getElementById("City/Town/Village_label").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
    document.getElementById("Country/State_(at_the_time)").style.display= "none";
    document.getElementById("Country/State_(at_the_time)_label").style.display= "none";
    document.getElementById("Region").style.display= "block";
    document.getElementById("Region_label").style.display= "block";
    document.getElementById("Continent").style.display= "block";
    document.getElementById("Continent_label").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "none";
    document.getElementById("Country/State_(Modern)").style.display= "block";
    document.getElementById("Country/State_(Modern)_label").style.display= "block";
  } else if(type=="Region"){
    document.getElementById("Type_of_Location").style.display= "none";
    document.getElementById("Type_of_Location_label").style.display= "none";
    document.getElementById("Latitude").style.display= "none";
    document.getElementById("Latitude_label").style.display= "none";
    document.getElementById("Longitude").style.display= "none";
    document.getElementById("Longitude_label").style.display= "none";
    document.getElementById("place_check").style.display= "none";
    document.getElementById("place_check_label").style.display= "none";
    document.getElementById("City/Town/Village").style.display= "none";
    document.getElementById("City/Town/Village_label").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
    document.getElementById("Country/State_(at_the_time)").style.display= "none";
    document.getElementById("Country/State_(at_the_time)_label").style.display= "none";
    document.getElementById("Region").style.display= "none";
    document.getElementById("Region_label").style.display= "none";
    document.getElementById("Continent").style.display= "block";
    document.getElementById("Continent_label").style.display= "block";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "none";
    document.getElementById("Country/State_(Modern)").style.display= "none";
    document.getElementById("Country/State_(Modern)_label").style.display= "none";
  } else if(type=="Unknown" || type=="Continent"){
    document.getElementById("Type_of_Location").style.display= "none";
    document.getElementById("Type_of_Location_label").style.display= "none";
    document.getElementById("Latitude").style.display= "none";
    document.getElementById("Latitude_label").style.display= "none";
    document.getElementById("Longitude").style.display= "none";
    document.getElementById("Longitude_label").style.display= "none";
    document.getElementById("place_check").style.display= "none";
    document.getElementById("place_check_label").style.display= "none";
    document.getElementById("City/Town/Village").style.display= "none";
    document.getElementById("City/Town/Village_label").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)_label").style.display= "none";
    document.getElementById("Country/State_(at_the_time)").style.display= "none";
    document.getElementById("Country/State_(at_the_time)_label").style.display= "none";
    document.getElementById("Region").style.display= "none";
    document.getElementById("Region_label").style.display= "none";
    document.getElementById("Continent").style.display= "none";
    document.getElementById("Continent_label").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)").style.display= "none";
    document.getElementById("Province/Colony/Dependency/Emirate_(Modern)_label").style.display= "none";
    document.getElementById("Country/State_(Modern)").style.display= "none";
    document.getElementById("Country/State_(Modern)_label").style.display= "none";

  }

}

</script>
