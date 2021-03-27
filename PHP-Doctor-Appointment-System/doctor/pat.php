<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$id = 1234;
/*
$res = mysqli_query($con, "SELECT a.*, b.*,c.* FROM patient a
	JOIN appointment b
		On a.icPatient = b.patientIc
	JOIN doctorschedule c
		On b.scheduleId=c.scheduleId
	WHERE b.patientIc ='$session'");
if (!$res) {
    die("Error running $sql: " . mysqli_error());
}
$userRow = mysqli_fetch_array($res);
*/
$res = mysqli_query($con, "SELECT * FROM patient WHERE icPatient=$id");
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
$res2 = mysqli_query($con, "SELECT * FROM treatment WHERE patientIc=$id");
$userRow2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);


?>
<?php


if (isset($_POST['submit'])) {
    //variables

    $symptoms = $_POST['symptoms'];
    $disease = $_POST['disease'];
    $suggestion = $_POST['suggestion'];

    // mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
    $res3 = mysqli_query($con, "UPDATE treatment SET symptoms='$symptoms', disease='$disease', suggestion='$suggestion' WHERE patientIc=$id");
    // $userRow=mysqli_fetch_array($res);
    header('Location: pat.php');
}

if (isset($_POST['hide'])) {
    //variables

    $symptoms = $_POST['symptoms'];
    $disease = $_POST['disease'];
    $suggestion = $_POST['suggestion'];

    // mysqli_query("UPDATE blogEntry SET content = $udcontent, title = $udtitle WHERE id = $id");
    $res3 = mysqli_query($con, "UPDATE treatment SET flag2='1' WHERE symptoms='$symptoms' AND disease='$disease' AND suggestion='$suggestion'AND patientIc=$id");
    // $userRow=mysqli_fetch_array($res);
    header('Location: pat.php');
}


if (isset($_POST['addtreatment'])) {

    $patientIc       = $id;
    $name            = mysqli_real_escape_string($con, $_POST['name']);
    $symptoms        = mysqli_real_escape_string($con, $_POST['symptoms']);
    $disease            = mysqli_real_escape_string($con, $_POST['disease']);
    $suggestion           = mysqli_real_escape_string($con, $_POST['suggestion']);
    $flag           = 1;
    $flag2 = 0;
    //INSERT
    $query = " INSERT INTO treatment (  patientIc, name, symptoms, disease,  suggestion, flag ,flag2)
    VALUES ( '$patientIc', '$name', '$symptoms', '$disease','$suggestion', $flag, $flag2 ) ";
    $result = mysqli_query($con, $query);
    // echo $result;
    if ($result) {
?>
        <script type="text/javascript">
            alert('Record has Been Added Successfully');
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert('Updation Error!!');
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

    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/material.css" rel="stylesheet">

    <link href="assets/css/default/style.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />

    <title>Patient Info</title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
    <link href="assets/css/default/blocks.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    <!-- <link href="assets/css/material.css" rel="stylesheet"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent;
        }


        header {
            background-color: #181b1e;
            width: 100%;
            height: 15em;
        }

        header h1 {
            color: white;
            text-align: center;
            line-height: 5em;
            font-size: 3em;
        }

        ul {

            list-style: none;
            margin: 0;
            padding: 0;
        }

        #hehe {
            background-color: #181b1e;
        }

        ul li {
            display: block;
            float: left;
            width: 25%;
            text-align: center;
            line-height: 2.5em;
            color: black;

        }

        ul li ul li {
            display: none;
        }

        ul li:hover {

            opacity: 0.7;
        }

        ul li:hover ul li {
            display: block;
            width: 100%;
        }

        #new-mentee-form {
            padding-top: 3em;
            color: black;
            background-color: wheat;
            width: 20em;
            height: 40em;
            margin-top: 9em;
            border-radius: 2em;
            display: none;
        }

        nav {
            background-color: brown;
        }

        input,
        textarea {
            padding: 0.5em;
            color: white;
        }

        #submit {
            border-radius: 2em;
        }

        #submit:hover {
            background-color: #18e288;
        }

        textarea {
            resize: none;
        }

        #mentees {
            color: white;
            size: 6em;
        }
    </style>


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

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <ul class="nav navbar-nav">
                        <li><a href="doctordashboard.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
                        <!-- <li><a href="profile.php?patientId=<?php echo $userRow['icPatient']; ?>" >Profile</a></li> -->

                    </ul>
                </ul>


            </div>
        </div>
    </nav>
    <!-- navigation -->
    <!-- display appoinment start -->

    <div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <!-- start -->
                <!-- USER PROFILE ROW STARTS-->
                <div class="row">

                    <header>
                        <h1>Treatment Details</h1>
                    </header>
                    <nav>
                        <ul id="hehe">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mydata11">Add Record</button>
                        </ul>
                    </nav>
                    <div id="mentees">
                    </div>
                    <center>


                        <?php

                        echo "<table class='table table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Patient Id</th>";
                        echo "<th>Patient Name </th>";
                        echo "<th>Symptoms </th>";
                        echo "<th>Disease </th>";
                        echo "<th>Suggestion </th>";
                        echo "</tr>";
                        echo "</thead>";
                        $res4 = mysqli_query($con, "SELECT * FROM treatment WHERE patientIc =$id and ( flag2=0)");

                        if (!$res4) {
                            die("Error running $sql: " . mysqli_error());
                        }


                        while ($userRow4 = mysqli_fetch_array($res4)) {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $userRow4['patientIc'] . "</td>";
                            echo "<td>" . $userRow4['name'] . "</td>";
                            echo "<td>" . $userRow4['symptoms'] . "</td>";
                            echo "<td>" . $userRow4['disease'] . "</td>";
                            echo "<td>" . $userRow4['suggestion'] . "</td>";
                            echo "<td><ul id='hehe'>";
                            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#mytreatment11'>Hide Record</button>";

                            echo "</ul></td>";
                        }

                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";

                        ?>

                    </center>

                </div>
                <!-- USER PROFILE ROW END-->

            </div>
            <!-- USER PROFILE ROW END-->
            <!-- end -->
            <div class="col-md-4">

                <!-- Large modal -->

                <!-- Modal -->
                <div class="modal fade" id="mytreatment11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Hide Confirmation</h4>
                            </div>
                            <div class="modal-body">
                                <!-- form start -->
                                <form action="<?php $_PHP_SELF ?>" method="post">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td>IC Number:</td>
                                                <td><?php echo $userRow['icPatient']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Name:</td>
                                                <td><?php echo $userRow2['name']; ?></td>
                                            </tr>
                                            <!-- radio button -->

                                            <!-- radio button end -->

                                            <tr>
                                                <td>Symptoms</td>
                                                <td><input type="text" class="form-control" name="symptoms" value="<?php echo $userRow2['symptoms']; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td>Disease</td>
                                                <td><input type="text" class="form-control" name="disease" value="<?php echo $userRow2['disease']; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td>Suggestion</td>
                                                <td><textarea class="form-control" name="suggestion"><?php echo $userRow2['suggestion']; ?></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="submit" name="hide" class="btn btn-info" value="Hide Info">
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>



                                </form>
                                <!-- form end -->
                            </div>

                        </div>
                    </div>
                </div>
                <br /><br />
            </div>



            <!-- end -->
            <div class="col-md-4">

                <!-- Large modal -->

                <!-- Modal -->
                <div class="modal fade" id="myModal11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <!-- form start -->
                                <form action="<?php $_PHP_SELF ?>" method="post">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td>IC Number:</td>
                                                <td><?php echo $userRow['icPatient']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Name:</td>
                                                <td><?php echo $userRow2['name']; ?></td>
                                            </tr>
                                            <!-- radio button -->

                                            <!-- radio button end -->

                                            <tr>
                                                <td>Symptoms</td>
                                                <td><input type="text" class="form-control" name="symptoms" value="<?php echo $userRow2['symptoms']; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td>Disease</td>
                                                <td><input type="text" class="form-control" name="disease" value="<?php echo $userRow2['disease']; ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td>Suggestion</td>
                                                <td><textarea class="form-control" name="suggestion"><?php echo $userRow2['suggestion']; ?></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="submit" name="submit" class="btn btn-info" value="Update Info">
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>



                                </form>
                                <!-- form end -->
                            </div>

                        </div>
                    </div>
                </div>
                <br /><br />
            </div>
            <!-- insert-->
            <div class="col-md-4">

                <!-- Large modal -->

                <!-- Modal -->
                <div class="modal fade" id="mydata11" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">New Treatment</h4>
                            </div>
                            <div class="modal-body">
                                <!-- form start -->
                                <form action="<?php $_PHP_SELF ?>" method="post">
                                    <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td>IC Number:</td>
                                                <td><?php echo $id ?></td>
                                            </tr>
                                            <tr>
                                                <td>Name:</td>
                                                <td><input type="text" class="form-control" name="name" value="" /></td>
                                            </tr>
                                            <!-- radio button -->

                                            <!-- radio button end -->

                                            <tr>
                                                <td>Symptoms</td>
                                                <td><input type="text" class="form-control" name="symptoms" value="" /></td>
                                            </tr>
                                            <tr>
                                                <td>Disease</td>
                                                <td><input type="text" class="form-control" name="disease" value="" /></td>
                                            </tr>
                                            <tr>
                                                <td>Suggestion</td>
                                                <td><textarea class="form-control" name="suggestion"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="submit" name="addtreatment" class="btn btn-info" value="Add Info">
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>



                                </form>
                                <!-- form end -->
                            </div>

                        </div>
                    </div>
                </div>
                <br /><br />
            </div>


    </div>
    <!-- ROW END -->
    </section>
    <!-- SECTION END -->
    </div>
    <!-- CONATINER END -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#patientDOB').datetimepicker();
        });
    </script>
    <!-- display appoinment end -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>