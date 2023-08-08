<?php session_start();
date_default_timezone_set('America/Toronto');
if( isset($_SESSION['user_id']) ):
require 'utilities/user-check.php';
require 'utilities/database_SS.php';
 ?>
 <!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Decoding Origins Web Portal - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger">

  <div class="container pt-1">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900"><b>Decoding Origins Web Portal</b></h1>
                <p><i>for Enslaved Afrians in Early Ontario</i></p>
                <h3 class="h4 text-gray-900 mb-4">Create an Account!</h3>
                <hr>
                <div class="">
                  <p class="small" style="color: red;">
                    <b>You have been re-directed to the <i>Decoding Origins Web Portal Servers</i>.</b><br>
                    New accounts, logins and security for <i>Regenerated Identites</i> is currently managed by the <i>Decoding Origins Web Portal</i>.
                    Using the form below you may add new Researchers to your project. Please contact Administrator to add Project Directors.
                  </div>
                <hr>

              </div>
              <form class="user pt-5" action="utilities/commands_external/register.php" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="fname" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input name="lname" type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="form-group">
                  <input name="Organization" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="University/Organization">
                </div>
                <div class="form-group">

                    <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">

                </div>
                <?php
                if(isset($_GET['message']))
                {
                  if($_GET['message']==1)
                  echo "<p style=\"color:red;\">Error! It seems you already have an account. Please request admin for password reset. </p>";
                }
                {
                  if($_GET['message']==2)
                  echo "<p style=\"color:green;\">New account is now created! Please share the credentials you created with the new user! They will now be able to login from your project URL to <i>Renegerate Identities</i>s.  </p>";
                }
                ?>
                <button class="btn btn-primary btn-user btn-block" type="submit">
                  Register Account
                </button>

                <a href="index.php" class="btn btn-danger btn-user btn-block">
                  Go back to <i>Regenerated Identites</i>
                </a>


              </form>

            </div>
          </div>
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

</body>

</html>
<?php else:
header("Location: ../index.php");

	 endif; ?>
