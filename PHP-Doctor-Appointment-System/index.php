<?php
include_once 'assets/conn/dbconnect.php';
// include_once 'assets/conn/server.php';
?>


<!-- login -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
    header("Location: patient/patient.php");
}
if (isset($_POST['login'])) {
    $icPatient = mysqli_real_escape_string($con, $_POST['icPatient']);
    $password  = mysqli_real_escape_string($con, $_POST['password']);

    $res = mysqli_query($con, "SELECT * FROM patient WHERE icPatient = '$icPatient'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    if ($row['password'] == $password) {
        $_SESSION['patientSession'] = $row['icPatient'];
?>
        <script type="text/javascript">
            alert('Login Success');
        </script>
    <?php
        header("Location: patient/patient.php");
    } else {
    ?>
        <script>
            alert('wrong input ');
        </script>
<?php
    }
}
?>
<!-- register -->
<?php
if (isset($_POST['signup'])) {
    $patientFirstName = mysqli_real_escape_string($con, $_POST['patientFirstName']);
    $patientLastName  = mysqli_real_escape_string($con, $_POST['patientLastName']);
    $patientEmail     = mysqli_real_escape_string($con, $_POST['patientEmail']);
    $icPatient     = mysqli_real_escape_string($con, $_POST['icPatient']);
    $password         = mysqli_real_escape_string($con, $_POST['password']);
    $month            = mysqli_real_escape_string($con, $_POST['month']);
    $day              = mysqli_real_escape_string($con, $_POST['day']);
    $year             = mysqli_real_escape_string($con, $_POST['year']);
    $patientDOB       = $year . "-" . $month . "-" . $day;
    $patientGender = mysqli_real_escape_string($con, $_POST['patientGender']);
    //INSERT
    $query = " INSERT INTO patient (  icPatient, password, patientFirstName, patientLastName,  patientDOB, patientGender,   patientEmail )
VALUES ( '$icPatient', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender', '$patientEmail' ) ";
    $result = mysqli_query($con, $query);
    // echo $result;
    if ($result) {
?>
        <script type="text/javascript">
            alert('Register success. Please Login to make an appointment.');
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert('User already registered. Please try again');
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Clinic Appointment Application</title>
    <!-- Bootstrap -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style1.css" rel="stylesheet">
    <link href="assets/css/blocks.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
    <title>Trealop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="patient/trealop/layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link href="assets/css/material.css" rel="stylesheet">
</head>

<body>
    <!-- navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="hospitalinterface.html">Hospitals Login</a></li>
                    <li><a href="adminlogin.php">Doctor's Login</a></li>
                    <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                    <li><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>

                    <li>
                        <p class="navbar-text">Already have an account?</p>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">

                                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="icPatient">Email</label>
                                                <input type="text" class="form-control" name="icPatient" placeholder="IC Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navigation -->

    <!-- modal container start -->
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
                <!-- ################################################################################################ -->
                <h1><a href="index.html">White Vision</a></h1>
                <!-- ################################################################################################ -->
            </div>
            <nav id="mainav" class="fl_right">
                <!-- ################################################################################################ -->
                <ul class="clear">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a class="drop" href="#">Appointment</a>

                    </li>
                    <li><a class="drop" href="#">E-Med</a>
                    <li><a class="drop" href="colorlib-regform-5\index.php">E-Card Registration</a>

                    </li>
                    <li><a href="#">Hospitals</a>


                    </li>
                    <li><a href="patient/emerg.php">Emergency</a></li>

                </ul>
                <!-- ################################################################################################ -->
            </nav>
        </header>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- modal content -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Sign Up</h3>
                </div>
                <!-- modal body start -->
                <div class="modal-body">

                    <!-- form start -->
                    <div class="container" id="wrap">
                        <div class="row">
                            <div class="col-md-6">

                                <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                    <h4>It's free and always will be.</h4>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <input type="text" name="patientFirstName" value="" class="form-control input-lg" placeholder="First Name" required />
                                        </div>
                                        <div class="col-xs-6 col-md-6">
                                            <input type="text" name="patientLastName" value="" class="form-control input-lg" placeholder="Last Name" required />
                                        </div>
                                    </div>

                                    <input type="text" name="patientEmail" value="" class="form-control input-lg" placeholder="Your Email" required />
                                    <input type="number" name="icPatient" value="" class="form-control input-lg" placeholder="Your IC Number" required />


                                    <input type="password" name="password" value="" class="form-control input-lg" placeholder="Password" required />

                                    <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Confirm Password" required />
                                    <label>Birth Date</label>
                                    <div class="row">

                                        <div class="col-xs-4 col-md-4">
                                            <select name="month" class="form-control input-lg" required>
                                                <option value="">Month</option>
                                                <option value="01">Jan</option>
                                                <option value="02">Feb</option>
                                                <option value="03">Mar</option>
                                                <option value="04">Apr</option>
                                                <option value="05">May</option>
                                                <option value="06">Jun</option>
                                                <option value="07">Jul</option>
                                                <option value="08">Aug</option>
                                                <option value="09">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <select name="day" class="form-control input-lg" required>
                                                <option value="">Day</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <select name="year" class="form-control input-lg" required>
                                                <option value="">Year</option>

                                                <option value="1981">1981</option>
                                                <option value="1982">1982</option>
                                                <option value="1983">1983</option>
                                                <option value="1984">1984</option>
                                                <option value="1985">1985</option>
                                                <option value="1986">1986</option>
                                                <option value="1987">1987</option>
                                                <option value="1988">1988</option>
                                                <option value="1989">1989</option>
                                                <option value="1990">1990</option>
                                                <option value="1991">1991</option>
                                                <option value="1992">1992</option>
                                                <option value="1993">1993</option>
                                                <option value="1994">1994</option>
                                                <option value="1995">1995</option>
                                                <option value="1996">1996</option>
                                                <option value="1997">1997</option>
                                                <option value="1998">1998</option>
                                                <option value="1999">1999</option>
                                                <option value="2000">2000</option>
                                                <option value="2001">2001</option>
                                                <option value="2002">2002</option>
                                                <option value="2003">2003</option>
                                                <option value="2004">2004</option>
                                                <option value="2005">2005</option>
                                                <option value="2006">2006</option>
                                                <option value="2007">2007</option>
                                                <option value="2008">2008</option>
                                                <option value="2009">2009</option>
                                                <option value="2010">2010</option>
                                                <option value="2011">2011</option>
                                                <option value="2012">2012</option>
                                                <option value="2013">2013</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label>Gender : </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="patientGender" value="male" required />Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="patientGender" value="female" required />Female
                                    </label>
                                    <br />
                                    <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>

                                    <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Create my account</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <!-- modal container end -->

    <!-- 1st section start -->
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
                <!-- ################################################################################################ -->
                <h1><a href="index.html">White Vision</a></h1>
                <!-- ################################################################################################ -->
            </div>
            <nav id="mainav" class="fl_right">
                <!-- ################################################################################################ -->
                <ul class="clear">
                    <li class="active"><a href="index.html">Home</a></li>
                    <li><a class="drop" href="#">Appointment</a>

                    </li>
                    <li><a class="drop" href="patient/emed/log.php">E-Med</a>
                    <li><a class="drop" href="colorlib-regform-5\index.php">E-Card Registration</a>
                    </li>
                    <li><a href="#">Hospitals</a>
                        <ul>
                            <li><a href="patient/location.html">Nearby Hospital</a></li>
                            <li><a class="drop" href="patient/insurance.html">Insurance</a>

                            </li>

                        </ul>

                    </li>
                    <li><a href="patient/emerg.php">Emergency</a></li>

                </ul>
                <!-- ################################################################################################ -->
            </nav>
        </header>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper bgded overlay gradient" style="background-image:url('patient/images/QRY7MJ.jpeg');">
        <div id="pageintro" class="hoc clear">
            <!-- ################################################################################################ -->
            <article>
                <p>Book apointments online</p>
                <h3 class="heading">Find nearby Hospitals</h3>
                <p>Experience taught us that working families are often just one pay check away from economic disaster.<br> And it
                    showed us first-hand the importance of every family having access to good health care.</p>
                <footer>
                    <ul class="nospace inline pushright">
                        <li><a class="btn" href="#">Book appointment</a></li>
                        <li><a class="btn inverse" href="patient/location.html">Hospitals near by</a></li>
                    </ul>
                </footer>
            </article>
            <!-- ################################################################################################ -->
        </div>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper row2">
        <section class="hoc container clear">
            <!-- ################################################################################################ -->
            <div class="sectiontitle">
                <h6 class="heading">Book an appointment for an in-clinic consultation</h6>
                <p>Find experienced doctors across all specialties</p>
            </div>
            <ul class="nospace group prices">
                <li class="one_third">
                    <article><img src="patient/images/dentist.jpeg" alt="">
                        <h6 class="heading">Dentist</h6>
                        <p>Teeth problems? Schedule a dental checkup</p>

                        <footer><a class="btn" href="#">Details</a></footer>
                    </article>
                </li>
                <li class="one_third">
                    <article><img src="patient/images/nutrition.jpeg" alt="">
                        <h6 class="heading">Nutritionist</h6>
                        <p>Maintain your proper health eat proper food</p>

                        <footer><a class="btn" href="#">Details</a></footer>
                    </article>
                </li>
                <li class="one_third">
                    <article><img src="patient/images/surgeon.jpeg" alt="">
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
                    <figure><a class="imgover" href="#"><img src="patient/images/cold.jpeg" alt=""></a>
                        <figcaption>Cold and Cough</figcaption>
                    </figure>
                </li>
                <li class="one_third">
                    <figure><a class="imgover" href="#"><img src="patient/images/painrelief.jpeg" alt=""></a>
                        <figcaption>Pain Relief</figcaption>
                    </figure>
                </li>
                <li class="one_third">
                    <figure><a class="imgover" href="#"><img src="patient/images/skin.jpeg" alt=""></a>
                        <figcaption>Skin Care</figcaption>
                    </figure>
                </li>
            </ul>
            <footer class="block center"><a class="btn" href="#">Pharmacy</a></footer>
            <!-- ################################################################################################ -->
        </section>
    </div>
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">
        <div class="hoc container testimonial clear">
            <!-- ################################################################################################ -->
            <article><img src="patient/images/buddha.jpeg" alt="">
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