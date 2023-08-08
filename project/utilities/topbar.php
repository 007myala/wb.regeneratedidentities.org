<link href="select2/dist/css/select2.css" rel="stylesheet" />



<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

<?php if(isset($_GET['projectID'])){?>
  <!-- Topbar Search -->
  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="<?php echo $_SERVER['REQUEST_URI'];?>">
    <div class="input-group">
      <input type="hidden" name="projectID" value="<?php echo $_GET['projectID'];?>">

      <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search by ID number or Names" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';?>" aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
  </form>
<?php } ?>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">


    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a>
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Nav Item - Task -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-tasks fa-fw"></i>
        <!-- Counter - Task -->
        <?php
        $q1="SELECT count(personID) as count FROM `person` WHERE `assignedto` LIKE '".$results['email']."'";
        $query = $conn->query($q1);
        $person= $query->fetch(PDO::FETCH_ASSOC);
         ?>
        <span class="badge badge-danger badge-counter"><?php if($person['count']>0){echo $person['count'];};?></span>
      </a>
      <!-- Dropdown - Task -->

      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Your Tasks
        </h6>
        <?php
        $q1="SELECT * FROM `person` WHERE `assignedto` LIKE '".$results['email']."' ORDER BY `assigneddate` DESC LIMIT 0,5";
        $query = $conn->query($q1);
        while($person= $query->fetch(PDO::FETCH_ASSOC))
        {
         ?>
        <a class="dropdown-item d-flex align-items-center" href="person_edit.php?personID=<?php echo $person['personID'];?>&doctype=<?php echo $person['doctype'];?>">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="fas fa-file-alt text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500"><?php echo $person['assigneddate'];?></div>
            <span class="font-weight-bold"><?php echo $person['assignedby'];?></span>
            <p><?php echo implode(' ', array_slice(explode(' ', $person['message']), 0, 10))."...";?></p>
          </div>
        </a>
      <?php } ?>

        <a class="dropdown-item text-center small text-gray-500" href="mytask.php">Show All Tasks</a>
      </div>
    </li>

    <!-- Nav Item - Group Chat -->
    <li class="nav-item dropdown no-arrow mx-1">

      <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Group Chat -->
        <?php
        $q1="SELECT count(sender) as chat FROM `chat`";
        $query = $conn->query($q1);
        $person= $query->fetch(PDO::FETCH_ASSOC);
         ?>
        <span class="badge badge-danger badge-counter"><?php if($results['chat']>0){echo $results['chat'];} ?></span>
      </a>
      <!-- Dropdown - Group Chat -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
          Group Chat
        </h6>
        <?php
        $q1="SELECT * FROM `chat` ORDER BY `timestamp` DESC LIMIT 0,5";
        $query = $conn->query($q1);
        while($person= $query->fetch(PDO::FETCH_ASSOC))
        {
         ?>
        <a class="dropdown-item d-flex align-items-center" href="chat.php">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="fas fa-user text-white"></i>
            </div>
          </div>
          <div class="font-weight-bold">
            <div class="text-truncate"><?php echo $person['message'];?></div>
            <div class="small text-gray-500"><?php echo $person['sender'];?> · <?php echo $person['timestamp'];?></div>
          </div>
        </a>
      <?php } ?>


        <a class="dropdown-item text-center small text-gray-500" href="chat.php">Read Older Messages</a>
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $results['fname']." ".$results['lname']; ?></span>
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <?php if(!empty($results['img'])){ ?>
            <img class="icon-circle" src="<?php echo $results['img'];?>" alt="User Image">
          <?php } else {?>
            <i class="fas fa-user text-white"></i>

          <?php }?>

          </div>
        </div>
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <!--<div class="dropdown-divider"></div>-->
        <a class="dropdown-item" href="profile.php" >
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>


        <!--<div class="dropdown-divider"></div>-->
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>

      </div>
    </li>

  </ul>

</nav>
<!-- End of Topbar -->

<!--Google Traslate API call-->
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
  }
  </script>

  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
