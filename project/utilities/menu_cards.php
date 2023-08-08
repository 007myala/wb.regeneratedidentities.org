
  <div class="col-xl-4 col-md-6 mb-12">
    <a href="mytask.php" style="text-decoration: none !important;">
    <div class="card bg-info text-white shadow">
      <div class="card-body">
        My Tasks:
        <?php
        $assign_tag_query="SELECT count(personID) as counts FROM `person` WHERE `assignedto` LIKE '".$results['email']."'";
        $assign_tag_conn = $conn->query($assign_tag_query);
        $assign_tag= $assign_tag_conn->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="text-white-50 small">Total Entries : <?php echo $assign_tag['counts'];?></div>
      </div>
    </div>
  </a>
  </div>

  <?php
  require 'utilities/database_login.php';
  $q3_project="SELECT * FROM `Project`";

  $query3_project = $conn->query($q3_project);
  while ($Project = $query3_project->fetch(PDO::FETCH_ASSOC))
  {

    if(isset($results[$Project['ProjectID']]) && $results[$Project['ProjectID']]==1){
      require 'utilities/database_SS.php';
      $q3="SELECT count(personID) as counts FROM `person` WHERE `project` LIKE '".$Project['ProjectID']."'";
      $query3 = $conn->query($q3);
      $query_pro1= $query3->fetch(PDO::FETCH_ASSOC);
      $total_news1=$query_pro1['counts'];

      ?>
      <div class="col-xl-4 col-md-6 mb-12">
        <a href="person.php?projectID=<?php echo $Project['ProjectID'];?>" style="text-decoration: none !important;">
        <div class="card bg-danger text-white shadow">
          <div class="card-body">
            <?php echo $Project['ProjectName']; ?>
            <div class="text-white-50 small">Total Entries : <?php echo $total_news1;?></div>
          </div>
        </div>
      </a>
      </div>

    <?php
    }

  }

 require 'utilities/database_SS.php';
  ?>




  <?php if(!empty($_GET['search']) || !empty($_GET['folder'])){ ?>
  <div class="col-xl-3 col-md-6 mb-12">
    <a href="#" style="text-decoration: none !important;">
    <div class="card bg-secondary text-white shadow">
      <div class="card-body">
        Searched for:


        <div class="text-white-50 small"><?php if(empty($_GET['search'])){echo "Enter Search Keywords";}else{echo $_GET['search'];} ?></div>
      </div>
    </div>
  </a>
  </div>
  <div class="col-xl-1 col-md-6 mb-12">
    </div>
<?php }else{ ?>
  <div class="col-xl-4 col-md-6 mb-12">
    </div>
  <?php } ?>
