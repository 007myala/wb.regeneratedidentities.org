<?php
session_start();
date_default_timezone_set('America/Toronto');
$date = new DateTime();
	$TimeDate = $date->format('Y-m-d H:i:s');

if( isset($_SESSION['user_id']) ){
	header("Location: project");

}
if(isset($_GET['message']))
{
  $message="Invalid Credentials! Please try again.";
}

require 'database_login.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && $_POST['password']==$results['password'] ){

		$_SESSION['user_id'] = $results['id'];
		$sql =	"INSERT INTO `login_dump` (`Username`, `TimeDate`) VALUES ('".$_POST['email']."', '".$TimeDate."')";



	$stmt = $conn->prepare($sql);


	if( $stmt->execute() ){

		header("Location: project");

		}
		else
		{
		$message = 'Error! Please contact Admin at kartikay.chadha2011@gmail.com.';
		}

	} else {
		$message = 'Incorrect Credentials! Please try again.';
	}

endif;
//$message='This website is under maintenance. Please email root@kartikaychadha.com for any questions.';

 ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Decoding Origins Web Portal</title>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta name="viewport" content="width=device-width"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">



        <!-- Font Awesome Icons -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

        <!-- Plugin CSS -->
        <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

        <!-- Theme CSS - Includes Bootstrap -->
        <link href="css/creative.css" rel="stylesheet">

</head>
<body>
<!-- partial:index.partial.html -->
<nav class="nav">
  <div class="burger">
    <div class="burger__patty"></div>
  </div>

  <ul class="nav__list ">
    <li class="nav__item">
      <a href="#1" class="nav__link c-blue"><i class="fa fa-database"></i></a>
    </li>
    <li class="nav__item">
      <a href="#2" class="nav__link c-yellow scrolly"><i class="fa fa-info-circle"></i></a>
    </li>
    <li class="nav__item">
      <a href="#3" class="nav__link c-red"><i class="fa fa-project-diagram"></i></a>
    </li>
    <li class="nav__item">
      <a href="#4" class="nav__link c-green"><i class="fa fa-people-carry"></i></a>
    </li>
  </ul>
</nav>

<section class="panel login-img" id="1">
  <article class="panel__wrapper">
    <div class="panel__content">
      <p>
        <div class="row">
					<div class="col-3" style="text-align: left !important; color: black !important;">
						<div class="container">
						<!--<div class="card" style="width: 100%; opacity: 0.7; margin-top: 3%; ">
							<div class="card-body">
								<h1 class="card-title">Want to Join?</h1><br>
								<p class="card-text">For free sign-up and access to this portal, please email us your details at:
								<a href="mailto:admin@decodingoriginswebportal.org" class="card-link">admin@decodingoriginswebportal.org</a></p>

							</div>
						</div>-->
						</div>
					</div>
        <div class="col-9" style="text-align: left !important">
					<h1 style="color:black;"></i>Regenerated Identities</h1>

        <form action="index.php" method="POST">
              <label for="exampleInputEmail1">Email address</label>
              <input class="form-control" type="text" placeholder="Enter username" name="email" required ><br>
              <label for="exampleInputEmail1">Password</label>
              <input class="form-control" type="password" placeholder="Enter password" name="password" required ><br>
              <span style="background-color:red;"><?php echo $message."<br><br>";?></span>

              <input class="btn btn-primary" type="submit" ><br>
        <form>
        </div>

      </div>
      </p></div>
  </article>
</section>
<section class="panel b-white" id="2">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-flask"></i>&nbsp;The Research Project</h1>
      <div class="panel__block"></div>
      <p><i>Decoding Origins Web Portal</i> addresses the concerns of accessible
design and deployment of a visual database and an interface which facilitates storage, access, and
analysis of this textual and visual information by scholars of historical and contemporary of Africa. We have developed
this web-based platform and searchable visual database enabling in-depth and accurate analyses
of manuscripts, potentially revealing individual’s identities and origins. In addition, this
web portal will is suuported by machine learning-based virtual mathematical models that are
capable of cross-referencing individuals with all known patterns in the database,
powering the likelihood of identifying kinship and birthplace. This research
work will shed new light on demographic change, individual identities and patterns of slave-taking.
This new interfaces we have designed, giving accessible access to the data visualizations and
the database, will become tools to study familial history as we further refine them.
The digital architecture of the <i>Decoding Origins Web Portal</i>
allows specialists to add and organize information for diverse analyses, and to ideate and
perform research projects based on the curated data. The ultimate goals of this project are to
respect the provenance of important historical and personal data, and to use design, data
gathering, analytics and visualization to join with ongoing efforts to restore and recover African
identities which the slave trade sought to erase.
</p></div>
  </article>
</section>
<section class="panel b-white" id="3">
  <article class="panel__wrapper" style="padding: 20% 20%; margin-top:-10%;">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-project-diagram"></i>&nbsp;Collaborating Projects</h1>
      <div class="panel__block"></div>
      <p >
        <div class="row" style="margin-top: 10%;">
        <div class="col-lg-6" style="text-align: left !important">
          <a href="http://languageofmarks.org"><img src="images/LOM.png" alt="LOM" class="image-logos"></a>
        </div>
        <div class="col-lg-6" style="text-align: left !important; color: black !important;">
          <a href="http://freedomnarratives.org"><img src="images/FN.png" alt="FN" class="image-logos"></a>
        </div>
      </div>




    </p>
      </div>

  </article>
</section>
<section class="panel b-grey" id="4">
  <article class="panel__wrapper">
    <div class="panel__content">
      <h1 class="panel__headline"><i class="fa fa-people-carry"></i>&nbsp;Contributions</h1>
      <div class="panel__block"></div>
      <p>The <i>Decoding Origin Web Portal</i> is developed as part of a collaboration between
        the <i><a href="http://languageofmarks.org">Creating a Visual Language of Marks</a></i> and
        the <i><a href="http://freedomnarratives.org">Freedom Narratives</a></i>
        research projects. <a href="http://kartikaychadha.com">Kartikay Chadha</a>, who is a Researcher in
        <a href="https://www2.ocadu.ca/bio/martha-ladly-1">Dr. Martha Ladly</a>'s research group in the
        Visual Analytics Labratory at OCAD University, and Technical Co-ordinator (Project Direction)
        for <a href="https://profiles.laps.yorku.ca/profiles/plovejoy/">Dr. Paul Lovejoy</a>'s team
        at <a href="https://www.yorku.ca/index.html">York University</a>,
        is the primary developer of this web portal.
        We acknowledge valuable contributions of
        <a href="https://www.trentu.ca/culturalstudies/faculty-research/graduate-faculty/katrina-keefer">Dr.
        Katrina Keefer</a> (Co-PI <i>Creating a Visual Language of Marks</i>, Trent University),
        <a href="https://www.kcl.ac.uk/people/erika-melek-delgado">Dr. Érika Melek Delgado</a>
        (Co-Director <i>Freedom Narratives</i>, Kings College London) and
        our research assistants including Maria Yala (OCAD University),
        Eric Lehman (Trent University) and Michael McGill (Trent University), in development of this web portal.
        <br><br>
        This research is supported by the <a href="https://www.sshrc-crsh.gc.ca/home-accueil-eng.aspx">
        Social Sciences and Humanities Research Council of Canada (SSHRC)</a>,
        <a href="https://brainalliance.ca/en/">Brain Alliance</a>,
        <a href="http://ocadu.ca">OCAD University</a> and <a href="https://www.yorku.ca/index.html">York University</a>.
         We also acknowledge our collaboration with
        <a href="http://www.matrix.msu.edu/">Matrix: The Center For Digital Humanities & Social Sciences</a>,
        as part of the <i><a href="http://enslaved.org">Enslaved: People of the Historic Slave Trade<a></i> project at
         <a href="https://msu.edu/">Michigan State University</a>.
        <br><br>
        <span style="font-size:14px;">
        <b>How to Cite us?</b><br>
        <i>Kartikay Chadha, Katrina Keefer and Martha Ladly, <i>“Decoding Origins Web Portal: Creating a
        Visual Database with Archival Sources from the Era of African Slavery,”</i>. Daryle Williams,
        Walter Hawthorne, and Dean Rehberger, editors. Encoding <i><a href="http://enslaved.org">Enslaved.org</a></i>:
        Slavery, Databases, and Digital Histories. Michigan State UP. Under consideration.</i>
      </span>

        </p>
    </div>
  </article>
</section>
<!--<a href="index.html" class="logo" target="_blank">
 <img class="logo" src="images/logo.png" alt="" />
</a>-->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
