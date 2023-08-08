<script type="text/javascript" language="javascript" >
function EnableDisableTextBox(str) {
  var e = document.getElementById("Type_of_Geographic_Area");
   var type = e.options[e.selectedIndex].value;
   var m = document.getElementById("place_check");
    var x = m.options[m.selectedIndex].value;

  var field_name=['Latitude','Longitude','City/Town/Village','Province/Colony/Dependency/Emirate_(at_the_time)','Country/State_(at_the_time)','Region','Continent','Province/Colony/Dependency/Emirate_(Modern)','Country/State_(Modern)'];

  if(str != 0){

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var myarray=JSON.parse(this.responseText);
    for(let i=0;i<field_name.length;i++){

    var abc = myarray[field_name[i]];
    if(abc=='0' || abc===""){
      abc="Unknown";
    }
    if(type=="Location" & x=="Yes" & field_name[i]=="City/Town/Village"){
      document.getElementById("City/Town/Village").value =  myarray["Name"];

    } else if(type=="Location" & x=="No" & field_name[i]=="Province/Colony/Dependency/Emirate_(at_the_time)"){
      document.getElementById("Province/Colony/Dependency/Emirate_(at_the_time)").value =  myarray["Name"];

    }else{
    //document.getElementById(field_name[i]).disabled = true;
    document.getElementById(field_name[i]).placeholder = "Enter Here";
    document.getElementById(field_name[i]).value =  abc;
  }
    }


    }
  };
  xhttp.open("GET", "utilities/modals/modal_section_place.php?id="+str+"&table_name=CV_Geographic_Details", true);
  xhttp.send();

} else {
for(let i=0;i<field_name.length;i++){
  //document.getElementById(field_name[i]).disabled = false;
  document.getElementById(field_name[i]).placeholder = "Enter Here";
}

}


}

</script>
