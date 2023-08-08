<div class="card bg-secondary text-white shadow">
  <div class="card-body">
      <div class="text-white-50 small">
        <h5>Your Projects: </h5>
        <?php
        require 'database_login.php';
        $authorized_projects="";
        $authorized_projects_names="";
        //Loading All Projects
        $q_projects="SELECT * FROM `Project`";
        $query_projects = $conn->query($q_projects);
        while($project = $query_projects->fetch(PDO::FETCH_ASSOC)){

          if($results[$project['ProjectID']]==1)
          {
            $authorized_projects=$authorized_projects." `project` LIKE '".$project['ProjectID']."' OR";
            $authorized_projects_names=$authorized_projects_names.$project['ProjectName']."<br>";
          }
        }
        $authorized_projects=substr($authorized_projects,0,-2);


        require 'database_SS.php';
        echo $authorized_projects_names;
        ?>


      </div>
  </div>
</div>
<!-- Basic Card Example -->
<div class="card shadow mb-4">
  <br>

  <div class="card-body overflow-auto" style="height: 500px;">
    <?php
    // Loading Collection Names
    $q_collection="SELECT DISTINCT `CollectionName` FROM `object` WHERE (".$authorized_projects.")  AND `CollectionName` != '0'";

    $query_collection = $conn->query($q_collection);
    while($collection = $query_collection->fetch(PDO::FETCH_ASSOC)){
    ?>
      <a style="width: 160px !important;" href="Full_source_list.php?collectionName=<?php echo $collection['CollectionName'];?>"><?php echo $collection['CollectionName'];?></a>
      <br>
    <?php } ?>
  </div>
</div>
