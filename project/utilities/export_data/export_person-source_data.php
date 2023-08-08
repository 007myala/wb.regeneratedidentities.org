<?php
require '../database_SS.php';


   /* if(empty($_GET['projectID'])){
    $projectID="%";
    }
    else {
    $projectID=$_GET['projectID'];
    }*/
    $projectID="AL";
    echo "<table>";
    //Print Headers
    $q_person_header="SELECT * FROM AL_Person_V1"; //Person Meta-fields
    $query_person_header = $conn->query($q_person_header);

     echo "<tr>";
      echo "<td><b>RegID</b></td>";
     while($person_header = $query_person_header->fetch(PDO::FETCH_ASSOC))
     {
       echo "<td><b>".$person_header['display']."</b></td>";
     }

     $q_source_header="SELECT * FROM AL_Object_V1
                      WHERE `display` LIKE 'Primary Source' OR `display` LIKE '%Notes%' OR `display` LIKE 'Title' OR `display` LIKE 'Date'  OR `display` LIKE 'Location'"; //Sources Meta-fields
     $query_source_header = $conn->query($q_source_header);

      while($source_header = $query_source_header->fetch(PDO::FETCH_ASSOC))
      {
        echo "<td><b>".$source_header['display']."</b></td>";
      }

     echo "</tr>";


    $q_person_data="SELECT * FROM `person` WHERE `project` LIKE '".$projectID."'";
    $query_person_data = $conn->query($q_person_data);

    //while run for person one by one
    while ($person_data = $query_person_data->fetch(PDO::FETCH_ASSOC)) {

      //Loading number of sources i., equal to number of lines for each person
      $q_person_object="SELECT * FROM `objects_person` WHERE `personID` LIKE '".$person_data['personID']."'";
      $query_person_object = $conn->query($q_person_object);

      //default assuming no sources are attached
      $HasSources=0;
      while ($person_object = $query_person_object->fetch(PDO::FETCH_ASSOC)) {
          //While executes only if atleast one source is attached
          $HasSources=1; //updated value

          echo "<tr>";
          echo "<td>".$person_data['UI']."</td>";
        //Loading meta-fields for person dataset
          $q_person_fields="SELECT * FROM AL_Person_V1";
          $query_person_fields = $conn->query($q_person_fields);

          // while run for every meta-field
           while($person_fields = $query_person_fields->fetch(PDO::FETCH_ASSOC))
          {
            if($person_fields['FieldType']=="dropdown-CV") // checking for fields with dropdown
            {
              $q_CV_person_fields = "SELECT x.* FROM " . $person_fields['Options'] . " x WHERE ID=" . $person_data[$person_fields['ColumnName']] . " limit 1;";
              $query_CV_person_fields = $conn->query($q_CV_person_fields);
              $CV_person_fields = $query_CV_person_fields->fetch(PDO::FETCH_ASSOC);
              echo "<td>".$CV_person_fields['Name']."</td>";
            }else{
              echo "<td>".$person_data[$person_fields['ColumnName']]."</td>";
            }
          }

          //Loading Source Dataset
          $q_source_data="SELECT * FROM `object` WHERE `objectID` LIKE '".$person_object['objectID']."'";
          $query_source_data = $conn->query($q_source_data);
          while ($source_data = $query_source_data->fetch(PDO::FETCH_ASSOC)) {

            //Loading metafields for source dataset
              $q_source_fields="SELECT * FROM AL_Object_V1
                                WHERE `display` LIKE 'Primary Source' OR `display` LIKE '%Notes%' OR `display` LIKE 'Title' OR `display` LIKE 'Date' OR `display` LIKE 'Location'";
              $query_source_fields = $conn->query($q_source_fields);

               while($source_fields = $query_source_fields->fetch(PDO::FETCH_ASSOC))
              {

                if($source_fields['FieldType']=="dropdown-CV")
                {
                  $q_CV_source_fields = "SELECT x.* FROM " . $source_fields['Options'] . " x WHERE ID=" . $source_data[$source_fields['ColumnName']] . " limit 1;";
                  $query_CV_source_fields = $conn->query($q_CV_source_fields);
                  $CV_source_fields = $query_CV_source_fields->fetch(PDO::FETCH_ASSOC);
                  echo "<td>".$CV_source_fields['Name']."</td>";

                } else if($source_fields['FieldType']=="dropdown-CV-multi"){
                  //Extract all IDS saved in source metafield column
                  $selectedoptions=$source_data[$source_fields['ColumnName']];
                  $selectedoptions_Array = explode(';', trim($selectedoptions,';'));

                  $q_CV_source_fields1= "SELECT `ID`,`Name` FROM `".$source_fields['Options']."`";
                  $query_CV_source_fields1 = $conn->query($q_CV_source_fields1);
                  echo "<td>";
                  while($CV_source_fields1 = $query_CV_source_fields1->fetch(PDO::FETCH_ASSOC)){
                    foreach($selectedoptions_Array as $opt_selected){
                      if($opt_selected==$CV_source_fields1['ID']){
                        echo $CV_source_fields1['Name'].";";
                      }
                    }
                  }
                  echo "<td>";

                }else{
                  echo "<td>".$source_data[$source_fields['ColumnName']]."</td>";
                }
              }

          }



          echo "</tr>";
  }
        if($HasSources==0)
        {
          echo "<tr>";
          echo "<td>".$person_data['UI']."</td>";
        //Loading Value for Key in Person Table
          $q1_person1="SELECT * FROM AL_Person_V1";
          $query_CL1 = $conn->query($q1_person1);

           while($CV_identifer1 = $query_CL1->fetch(PDO::FETCH_ASSOC))
          {

            if($CV_identifer1['FieldType']=="dropdown-CV")
            {
              $sql5 = "SELECT x.* FROM " . $CV_identifer1['Options'] . " x WHERE ID=" . $person_data[$CV_identifer1['ColumnName']] . " limit 1;";
              $query5 = $conn->query($sql5);
              $dynamic5 = $query5->fetch(PDO::FETCH_ASSOC);
              echo "<td>".$dynamic5['Name']."</td>";
            }else{
              echo "<td>".$person_data[$CV_identifer1['ColumnName']]."</td>";
            }
          }
          echo "</tr>";
        }
}
echo "</table>";

?>
