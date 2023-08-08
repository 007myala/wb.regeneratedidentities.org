<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-0">
      <i class="fas fa-id-badge"></i></i>
    </div>
    <div class="sidebar-brand-text mx-3">Regenerated<br>Identities<br></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <div class="sidebar-brand-text mx-3 text-white text-center"><i>W.E.B Du Bois</i></div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <br>

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="mytask.php">
      <i class="fas fa-tasks"></i>
      <span>My Tasks</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Public Website Controls
  </div>

  <div class="overflow-auto scrollbar">
    <?php
    $flag_nowebsitecontrol=0;
    $sectionList_q="SELECT * FROM `sections_list` GROUP BY `GroupName`";
    $sectionList_qy= $conn->query($sectionList_q);
    while ($section= $sectionList_qy->fetch(PDO::FETCH_ASSOC)){
      $flag_nowebsitecontrol=1;

      if($section['GroupName']=='0'){
      //For regular Menu options
      $q_projectselect="SELECT * FROM `sections_list` WHERE `GroupName` LIKE '0'";
      $query_projectselect = $conn->query($q_projectselect);
      while ($section= $query_projectselect->fetch(PDO::FETCH_ASSOC)){
        if($section['subsection']==0){
        ?>
          <!-- Nav Item - Dashboard -->

          <li class="nav-item active">
            <a class="nav-link" href="data_edit.php?table=<?php echo $section['TableName'];?>&id=<?php echo $section['RefID'];?>">
              <i class="far fa-edit"></i>
              <span><?php echo $section['SectionName'];?></span></a>

          </li>

        <?php } else { ?>
          <!-- Nav Item - Dashboard -->

          <li class="nav-item active">
            <a class="nav-link" href="data_list.php?table=<?php echo $section['TableName'];?>">
              <i class="far fa-edit"></i>
              <span><?php echo $section['SectionName'];?></span></a>

          </li>
        <?php }
      }
    } else {
      // For grouped Items
      //Group menu load ?>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?php echo $section['GroupName'];?>" aria-expanded="true" aria-controls="collapse<?php echo $section['GroupName'];?>">
          <i class="fas fa-edit"></i>
          <span><?php echo str_replace('_',' ',$section['GroupName']);?></span>
        </a>
        <div id="collapse<?php echo $section['GroupName'];?>" class="collapse" aria-labelledby="heading<?php echo $section['GroupName'];?>" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <?php $q_projectselect_g="SELECT * FROM `sections_list` WHERE `GroupName` LIKE '".$section['GroupName']."'";
            $query_projectselect_g = $conn->query($q_projectselect_g);
            while ($section_g= $query_projectselect_g->fetch(PDO::FETCH_ASSOC)){
            if($section_g['subsection']==0){ ?>
            <a class="collapse-item" href="data_edit.php?table=<?php echo $section_g['TableName'];?>&id=<?php echo $section_g['RefID'];?>"><?php echo $section_g['SectionName'];?></a>
          <?php } else { ?>
            <a class="collapse-item" href="data_list.php?table=<?php echo $section_g['TableName'];?>"><?php echo $section_g['SectionName'];?></a>
          <?php }
          } ?>

          </div>
        </div>
      </li>

      <?php
      }
    }?>
  </div>

  <?php
  if($flag_nowebsitecontrol==0){ ?>
    <li class="sidebar-heading text-white">
      <br>
    Currently Not Available
    <br><br>
  </li>
  <?php } ?>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Project Controls
  </div>

  <?php
  $data_features="SELECT * FROM `features`";
  $features_data = $conn->query($data_features);
  while($features_load = $features_data->fetch(PDO::FETCH_ASSOC)){
    $features[$features_load['Feature']]=$features_load['Status'];
  }

  $q_projectselect="SELECT * FROM `Project`";
  $query_projectselect = $conn->query($q_projectselect);

  while ($projectselect= $query_projectselect->fetch(PDO::FETCH_ASSOC)){  

    if(isset($results[$projectselect['ProjectID']]) && $results[$projectselect['ProjectID']]==1){
    ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="person.php?projectID=<?php echo $projectselect['ProjectID'];?>">
          <i class="fas fa-database"></i>
          <span>All Legislation</span></a>
      </li>
    <?php } 
  }

  require 'utilities/database_SS.php';?>

  <?php if(isset($results['LA-index']) && $results['LA-index']>0){?>
  <li class="nav-item active">
    <a class="nav-link" href="../FN-index-DOWP">
      <i class="fas fa-fw fa-database"></i>
      <span>Website Edit</span></a>
  </li>
  <?php } ?>

  <!-- Nav Item - Dashboard -->
  <?php if($results['security']>=0){?>
  <li class="nav-item active">
    <a class="nav-link" href="new_entry.php">
      <i class="fas fa-folder-plus"></i>
      <span>New Legislation</span></a>
  </li>
  <?php } ?>

  <!-- Nav Item - Pages Collapse Menu -->
  <?php if($features['Full-source']>0){?>
    <!--
    <li class="nav-item active">
      <a class="nav-link" href="Full_source_list.php">
        <i class="fas fa-file"> </i>
        <span> Full Sources (Collections)</span></a>

    </li>
    -->
  <?php } ?>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-edit"></i>
      <span>Controlled Vocabularies</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <?php if($results['security']>0 && $features['CV-approval']>0){?>
        <a class="collapse-item" href="CV_approval.php">Approve Requests</a>
      <?php } ?>
        <a class="collapse-item" href="CV_tables.php">Edit/Update</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
  
  <?php if($results['WB']>0 && $results['security']>0){?>
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="register.php">
      <i class="fas fa-users"></i>
      <span>Project Users</span></a>
  </li>
  <?php } ?>

  <!-- Nav Item - Dashboard -->
  <?php if($results['security']>0){?>
  <li class="nav-item active">
    <a class="nav-link" href="Definitions.php">
      <i class="fas fa-edit"></i>
      <span>Edit Meta-Fields</span></a>
  </li>
  <?php } ?>

  <!-- Nav Item - Dashboard -->
  <?php if($results['security']>0){?>
  <li class="nav-item active">
    <a class="nav-link" href="export_data.php">
      <i class="fas fa-file-export"></i>
      <span>Export Dataset</span></a>
  </li>
  <?php } ?>

  <?php if($results['WB']>0){?>
  <li class="nav-item active">
    <a class="nav-link" target="_blank" href="https://tickets.regeneratedidentities.org">
      <i class="fas fa-clipboard-list"></i>
      <span>RegID Tickets</span></a>
  </li>
  <?php } ?>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Charts -->
  <!--<li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Charts</span></a>
  </li>-->

  <!-- Nav Item - Tables -->
  <!--<li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="fas fa-fw fa-table"></i>
      <span>Tables</span></a>
  </li>-->

  <!-- Divider -->
  <!--<hr class="sidebar-divider d-none d-md-block">-->

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
