<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (!isset($_SESSION['patientSession'])) {
	header("Location: ../index.php");
}

$usersession = $_SESSION['patientSession'];


$res = mysqli_query($con, "SELECT * FROM patient WHERE icPatient=" . $usersession);

if ($res === false) {
	echo mysql_error();
}

$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Patient Dashboard</title>
	<!-- Bootstrap -->
	<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="assets/css/material.css" rel="stylesheet">
	<link href="assets/css/default/style.css" rel="stylesheet">
	<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
	<link href="assets/css/default/blocks.css" rel="stylesheet">
	<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
	<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
	<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
	<!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> -->
	<!--Font Awesome (added because you use icons in your prepend/append)-->
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
	<link href="trealop\layout\styles\layout.css" rel="stylesheet" type="text/css" media="all">

</head>

<body>

	<!-- navigation -->
	<nav class="navbar navbar-default " role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="patient.php"><img alt="Brand" src="assets/img/logo.png" height="40px"></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<ul class="nav navbar-nav">
						<li><a href="patient.php">Home</a></li>
						<!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->
						<li><a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>">Appointment</a></li>
						<li><a href="emed\home.html">Emed</a></li>
						<li><a href="emerg.php">SOS</a></li>

						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hospital<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="location.html"><i class="fa fa-fw fa-ambulance"></i> NearBy Hospitals</a>
									</li>
									<li>
										<a href="insurance.html"><i class="glyphicon glyphicon-file"></i>Insurance</a>
									</li>


								</ul>
							</li>
						</ul>

					</ul>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
							</li>
							<li>
								<a href="patientapplist.php?patientId=<?php echo $userRow['icPatient']; ?>"><i class="glyphicon glyphicon-file"></i> Appointment</a>
							</li>

							<li class="divider"></li>
							<li>
								<a href="patientlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- navigation -->

	<!-- 1st section start -->
	<section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8">


					<?php if ($userRow['patientMaritialStatus'] == "") {
						// <!-- / notification start -->
						echo "<div class='row'>";
						echo "<div class='col-lg-12'>";
						echo "<div class='alert alert-danger alert-dismissable'>";
						echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
						echo " <i class='fa fa-info-circle'></i>  <strong>Please complete your profile.</strong>";
						echo "  </div>";
						echo "</div>";
						// <!-- notification end -->

					} else {
					}
					?>
					<!-- notification end -->
					<h2>Hello <?php echo $userRow['patientFirstName']; ?> <?php echo $userRow['patientLastName']; ?>. Looking for a doctor?</h2>
					<div class="input-group" style="margin-bottom:10px;">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d") ?>" onchange="showUser(this.value)" />
					</div>
				</div>
				<!-- date textbox end -->
				<!-- script start -->
				<script>
					function showUser(str) {

						if (str == "") {
							document.getElementById("txtHint").innerHTML = "No data to be shown";
							return;
						} else {
							if (window.XMLHttpRequest) {
								// code for IE7+, Firefox, Chrome, Opera, Safari
								xmlhttp = new XMLHttpRequest();
							} else {
								// code for IE6, IE5
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange = function() {
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
								}
							};
							xmlhttp.open("GET", "getschedule.php?q=" + str, true);
							console.log(str);
							xmlhttp.send();
						}
					}
				</script>

				<!-- script start end -->

				<!-- table appointment start -->
				<!-- <div class="container"> -->
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<div id="txtHint"></div>
						</div>
					</div>
				</div>
				<!-- </div> -->
				<!-- table appointment end -->
			</div>
		</div>
		<!-- /.row -->
		</div>
	</section>
	<div class="wrapper row2">
		<section class="hoc container clear">
			<!-- ################################################################################################ -->
			<div class="sectiontitle">
				<h6 class="heading">Book an appointment for an in-clinic consultation</h6>
				<p>Find experienced doctors across all specialties</p>
			</div>
			<ul class="nospace group prices">
				<li class="one_third">
					<article><img src="images/dentist.jpeg" alt="">
						<h6 class="heading">Dentist</h6>
						<p>Teeth problems? Schedule a dental checkup</p>

						<footer><a class="btn" href="#">Details</a></footer>
					</article>
				</li>
				<li class="one_third">
					<article><img src="images/nutrition.jpeg" alt="">
						<h6 class="heading">Nutritionist</h6>
						<p>Maintain your proper health eat proper food</p>

						<footer><a class="btn" href="#">Details</a></footer>
					</article>
				</li>
				<li class="one_third">
					<article><img src="images/surgeon.jpeg" alt="">
						<h6 class="heading">General Surgeon</h6>
						<p>Want to get operated visit a nearby surgeon</p>

						<footer><a class="btn" href="#">Details</a></footer>
					</article>
				</li>
			</ul>
			<!-- ################################################################################################ -->
		</section>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<div class="wrapper coloured">
		<article class="hoc cta clear">
			<!-- ################################################################################################ -->
			<h6 class="three_quarter first">Want to get reward by walking?</h6>
			<footer class="one_quarter"><a class="btn" href="https://www.stepsetgo.com/">See how</a></footer>
			<!-- ################################################################################################ -->
		</article>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<div class="wrapper row3">
		<main class="hoc container clear">
			<!-- main body -->
			<!-- ################################################################################################ -->
			<section id="introblocks">
				<div class="sectiontitle">
					<h6 class="heading">Read health articles</h6>
					<p>These will you to acheive your health goals</p>
				</div>
				<ul class="nospace group">
					<li class="one_third first">
						<article><a href="#"></a>
							<h6 class="heading">COVID Patients Face Higher Risk for Stroke</h6>
							<p>A new study adds to mounting evidence that COVID patients have an added risk of stroke [&hellip;]</p>
							<footer><a class="btn" href="https://www.webmd.com/lung/news/20210319/covid-patients-face-higher-risk-for-stroke">Read More</a></footer>
						</article>
					</li>
					<li class="one_third">
						<article><a href="#"></a>
							<h6 class="heading">Keep Heart Healthy now to Help Cognitive Ability Later</h6>
							<p>Managing risk factors in young adulthood has affect on late-life cognitive abilities. [&hellip;]</p>
							<footer><a class="btn" href="https://www.healthline.com/health-news/staying-heart-healthy-in-your-20s-may-help-cognitive-ability-later-on">Read More</a></footer>
						</article>
					</li>
					<li class="one_third">
						<article><a href="#"></a>
							<h6 class="heading">Long-Haul COVID Symptoms May Appear in This Order</h6>
							<p>The first symptoms to emerge are often flu-like: fatigue, headache, fever, and chills. [&hellip;]</p>
							<footer><a class="btn" href="https://www.healthline.com/health-news/long-haul-covid-19-symptoms-may-appear-in-this-order">Read More</a></footer>
						</article>
					</li>
				</ul>
			</section>
			<!-- ################################################################################################ -->
			<!-- / main body -->
			<div class="clear"></div>
		</main>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<div class="wrapper row2">
		<section id="latest" class="hoc container clear">
			<!-- ################################################################################################ -->
			<div class="sectiontitle">
				<h6 class="heading">Tell us the problem you are facing</h6>
				<p>We will help you suggesting medicines verified for by our doctors</p>
			</div>
			<ul class="nospace group">
				<li class="one_third">
					<figure><a class="imgover" href="emed/cold.php"><img src="images/cold.jpeg" alt=""></a>
						<figcaption>Cold and Cough</figcaption>
					</figure>
				</li>
				<li class="one_third">
					<figure><a class="imgover" href="emed/cardio.php"><img src="images/painrelief.jpeg" alt=""></a>
						<figcaption>Pain Relief</figcaption>
					</figure>
				</li>
				<li class="one_third">
					<figure><a class="imgover" href="emed/covid.php"><img src="images/skin.jpeg" alt=""></a>
						<figcaption>Skin Care</figcaption>
					</figure>
				</li>
			</ul>
			<footer class="block center"><a class="btn" href="emed/log.php">Pharmacy</a></footer>
			<!-- ################################################################################################ -->
		</section>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">
		<div class="hoc container testimonial clear">
			<!-- ################################################################################################ -->
			<article><img src="images/buddha.jpeg" alt="">
				<blockquote>To keep the body in good health is a duty, for otherwise we shall not be able to trim the lamp of wisdom, and keep our mind string and clear.</blockquote>
				<h6 class="heading font-x1">Gautama Buddha</h6>
				<em>Philosopher</em>
			</article>
			<!-- ################################################################################################ -->
		</div>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<div class="wrapper row3">
		<section id="cta" class="hoc container clear">
			<!-- ################################################################################################ -->
			<ul class="nospace clear">
				<li class="one_quarter first">
					<div class="block clear"><a href="#"><i class="fas fa-info"></i></a> <span><strong>For more information:</strong></span></div>
				</li>
				<li class="one_quarter">
					<div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Send us a mail:</strong> whitevision@gmail.com</span></div>
				</li>
				<li class="one_quarter">
					<div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong> Call us:</strong> 9876543210</span></div>
				</li>
				<li class="one_quarter">
					<div class="block clear"><a href="#"><i class="fas fa-map-marker-alt"></i></a> <span><strong>Headquaters:</strong> 1600 Amphitheatre Parkway, Mountain View, California, United States</span></div>
				</li>
			</ul>
			<!-- ################################################################################################ -->
		</section>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<div class="wrapper row4">
		<footer id="footer" class="hoc clear">
			<!-- ################################################################################################ -->
			<div class="one_quarter first">
				<h6 class="heading">About</h6>
				<p>We are a healthcare website assessing health issues, finding the right doctor, booking diagnostic tests, obtaining medicines, storing health records or learning new ways to live healthier.</p>
				<p class="btmspace-30">We try to help millions of patients and thousands of doctors with a simpler, a easier and a user friendly healthcare experience. [<a href="#"><i class="fas fa-arrow-right"></i></a>]</p>
				<ul class="faico clear">
					<li><a class="faicon-facebook" href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
					<li><a class="faicon-google-plus" href="https://web.archive.org/web/*/http://plus.google.com/"><i class="fab fa-google-plus-g"></i></a></li>
					<li><a class="faicon-linkedin" href="https://in.linkedin.com/"><i class="fab fa-linkedin"></i></a></li>
					<li><a class="faicon-twitter" href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
					<li><a class="faicon-vk" href="https://vk.com/"><i class="fab fa-vk"></i></a></li>
				</ul>
			</div>
			<div class="one_quarter">
				<h6 class="heading">Blog</h6>
				<ul class="nospace linklist">
					<li>
						<article>
							<p class="nospace btmspace-10"><a href="#">Deconstructing India’s COVID-19 vaccine journey with White Vision&hellip;</a></p>
							<time class="block font-xs" datetime="2045-04-06">Saturday, 6<sup>th</sup> March 2021</time>
						</article>
					</li>
					<li>
						<article>
							<p class="nospace btmspace-10"><a href="#">Building access to quality healthcare: COVID-19 and beyond&hellip;</a></p>
							<time class="block font-xs" datetime="2045-04-05">Thursday, 4<sup>th</sup> March 2021</time>
						</article>
					</li>
				</ul>
			</div>
			<div class="one_quarter">
				<h6 class="heading">More</h6>
				<ul class="nospace linklist">
					<li><a href="#">Help</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Terms and Conditions</a></li>
					<li><a href="#">Developers</a></li>
					<li><a href="#">Providers</a></li>
				</ul>
			</div>
			<div class="one_quarter">
				<h6 class="heading">Comment</h6>
				<p class="nospace btmspace-15">Leave your reviews about us here.</p>
				<form method="post" action="#">
					<fieldset>
						<legend>Comment:</legend>
						<input class="btmspace-15" type="text" value="" placeholder="Name">
						<input class="btmspace-15" type="text" value="" placeholder="Comment">
						<button type="submit" value="submit">Comment</button>
					</fieldset>
				</form>
			</div>
			<!-- ################################################################################################ -->
		</footer>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<div class="wrapper row5">
		<div id="copyright" class="hoc clear">
			<!-- ################################################################################################ -->
			<p class="fl_left">Copyright &copy; 2021 - All Rights Reserved - <a href="#">White Vision</a></p>
			<p class="fl_right"><a target="_blank" href="#" title="">White Vision</a></p>
			<!-- ################################################################################################ -->
		</div>
	</div>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
	<!-- JAVASCRIPTS -->
	<script src="layout/scripts/jquery.min.js"></script>
	<script src="layout/scripts/jquery.backtotop.js"></script>
	<script src="layout/scripts/jquery.mobilemenu.js"></script>
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<!-- ################################################################################################ -->
	<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
	<!-- JAVASCRIPTS -->
	<script src="layout/scripts/jquery.min.js"></script>
	<script src="layout/scripts/jquery.backtotop.js"></script>
	<script src="layout/scripts/jquery.mobilemenu.js"></script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/date/bootstrap-datepicker.js"></script>
	<script src="assets/js/moment.js"></script>
	<script src="assets/js/transition.js"></script>
	<script src="assets/js/collapse.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function() {
			$('#myInput').focus()
		})
	</script>
	<!-- date start -->

	<script>
		$(document).ready(function() {
			var date_input = $('input[name="date"]'); //our date input has the name "date"
			var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			})
		})
	</script>
	<!-- date end -->


</body>

</html>