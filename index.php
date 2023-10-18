<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
	$TimeDate = $date->format('Y-m-d H:i:s');

if( isset($_SESSION['user_id']) ){
	if(isset($_GET['redirect'])){
		header('Location: '.$_GET['redirect']);
  }else {
    header("Location: project");
  }
}

if(isset($_GET['message'])){
  $message="Invalid Credentials! Please try again.";
}

require 'database_login.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'],$results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		$sql =	"INSERT INTO `login_dump` (`Username`, `TimeDate`) VALUES ('".$_POST['email']."', '".$TimeDate."')";

	$stmt = $conn->prepare($sql);

	if( $stmt->execute() ){
		if(isset($_GET['redirect'])){
			header('Location: '.$_GET['redirect']);
	}else {
		header("Location: project");
	}

		}
		else
		{
		$message = 'Error! Please contact Admin at admin@regid.ca.';
		}

	} else {
		$message = 'Incorrect Credentials! Please try again.';
	}

endif;
//$message='This website is under maintenance. Please email root@kartikaychadha.com for any questions.';

 ?>
 <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Regenerated Identites - Login Gateway</title>

  <!-- Font Awesome Icons -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="css/creative.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="mobile" class="alert alert-danger" role="alert">
  For best interactive experience please use Google Chrome on your desktop!
</div>


  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center">
        <div class="col-lg-7">

        </div>
      </div>
    </div>
  </header>

  <section id="form1">
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center">
      <div class="col-lg-7">
        <div class="card" id="card1">
          <div class="card-body" >
            <center><img style="width:60%; height:auto; position: center;" src="img/regid_logo.png">
            <hr />
            <i>US Anti-Slavery Laws Archive</i>
            <hr />
					<?php
					if(isset($_GET['redirect'])){
						$redirect="?redirect=".$_GET['redirect'];
					} else{
						$redirect="";
					}
					?>
            </center>
          <form action="index.php<?php echo $redirect;?>" method="POST" autocomplete="off">
            <div class="container h-100">
                <center><span style="background-color:red;">
                  <?php
                  if(isset($message) && $message != ""){
                    echo $message."<br><br>";
                  } else {
                    echo "<br>";
                  }?>
              </span></center>
              <div class="row h-100 align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="form-group">
                      <input name="email" type="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type username...">
                    </div>
                    <div class="form-group">
                      <input name="password" type="password" class="form-control " id="exampleInputPassword1" placeholder="Type password...">
                    </div>
                </div>
            </div>
            <br>
          </div>
          <center><button type="submit" class="btn btn-lg btn-outline-danger" style="width: 5.5rem;">login</button></center>
        </form>
      </div>
    </div>
      </div>
    </div>
  </div>
</section>


  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container text-center">

      <span >Created by <a href="http://kartikaychadha.com" target="_blank">Kartikay Chadha</a>.</span>

    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/creative.min.js"></script>

</body>

</html>
