<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session = $_SESSION['patientSession'];
$res2 = mysqli_query($con, "SELECT * from appointment where patientIc =$session");

$res = mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
	JOIN appointment b
		On a.icPatient = b.patientIc
	JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
	WHERE b.patientIc ='$session'");
if (!$res) {
    die("Error running $sql: " . mysqli_error());
}
if (!$res2) {
    die("Error running $sql: " . mysqli_error());
}
$userRow = mysqli_fetch_array($res);
$userRow2 = mysqli_fetch_array($res2);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Make Appoinment</title>
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/material.css" rel="stylesheet">

    <link href="assets/css/default/style.css" rel="stylesheet">
    <link href="assets/css/default/blocks.css" rcel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />

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
    <!-- display appoinment start -->
    <?php


    echo "<div class='container'>";
    echo "<div class='row'>";
    echo "<div class='page-header'>";
    echo "<h1>Your appointment History </h1>";
    echo "</div>";
    echo "<div class='panel panel-primary'>";
    echo "<div class='panel-heading'>List of Appointment</div>";
    echo "<div class='panel-body'>";
    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Appointment Id</th>";
    echo "<th>patient ID </th>";
    echo "<th>Scheduled ID </th>";
    echo "<th>Symptom </th>";
    echo "<th>Comment </th>";

    echo "<th>Hide History</th>";

    echo "</tr>";
    echo "</thead>";
    $res = mysqli_query($con, "SELECT a.*, b.*,c.*
		FROM patient a
		JOIN appointment b
		On a.icPatient = b.patientIc
		JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
		WHERE b.patientIc ='$session'");

    if (!$res) {
        die("Error running $sql: " . mysqli_error());
    }


    while ($userRow2 = mysqli_fetch_array($res2)) {
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $userRow2['appId'] . "</td>";
        echo "<td>" . $userRow2['patientIc'] . "</td>";
        echo "<td>" . $userRow2['scheduleId'] . "</td>";
        echo "<td>" . $userRow2['appSymptom'] . "</td>";
        echo "<td>" . $userRow2['appComment'] . "</td>";

        echo "<th><button id='btn' >Hide History</button> </th>";
    }

    echo "</tr>";
    echo "</tbody>";
    echo "</table>";

    ?>
    </div>
    </div>
    </div>
    </div>
    <!-- display appoinment end -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>