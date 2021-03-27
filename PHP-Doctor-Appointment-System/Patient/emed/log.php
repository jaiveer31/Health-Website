<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'emed');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
?>
<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 

    $myusername = mysqli_real_escape_string($db, $_POST['id']);
    $mypassword = mysqli_real_escape_string($db, $_POST['pass']);

    $sql = "SELECT * FROM logi WHERE name = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if ($row['name'] == $myusername && $row['password'] == $mypassword) {

        $_SESSION['login_user'] = $myusername;

        header("location: home.html");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Login-Page</title>
    <link rel="stylesheet" href="stylelog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body background="images/daniel-frank-wKbWAMlHgNo-unsplash.jpg">
    <table class="tab" style="width: 100%;">
        <tr>
            <td id="name">
                <i class="fa fa-ambulance" aria-hidden="true"></i>
                <h2>Emed-Login</h2>
            </td>
        </tr>
        <center>
    </table>
    <section>
        <h3>Login in to your account</h3>
        <form action="" method="post">
            <table id="tab">
                <tr>
                    <td rowspan="4" class="num">
                        <a class="a" href="signup.html">Forgot password?</a>
                    </td>
                </tr>
                <tr>
                    <td class="field">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <input class="text" name="id" placeholder="Enter username" style="font-size: 15px" required>
                    </td>
                </tr>
                <tr>
                    <td class="field">
                        <i class="fa fa-key" aria-hidden="true"></i>

                        <input class="password" name="pass" type="password" placeholder="enter password" style="font-size: 15px" required>
                    </td>
                </tr>
                <tr>
                    <td class="field">
                        <input class="btn" type="submit" name="submit" value="submit">
                    </td>
                </tr>

            </table>
            </center>
        </form>

        <br><br>
        <h5 style="text-align: center; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size: 1.2em;">
            Don't
            Have account?</h5>
        <center>
            <button class="btn" style="width: 15%;"><a class="a" href="signup.php">Signup</a></button>
        </center>
    </section>

    <footer>
        <h2>About</h2>
        This is a medical store website developed using html and css
        <br>
        <p>for more information contact us:<br> Medicalstore@gmail.com

            <br>Mobileno-98246XXXXX
        </p>
        <marquee scrollamount="15">
            <h4>We ensure contact free delivery and highest quality. Daily offers on medicine avaliable. Avail now</h4>
        </marquee>
    </footer>
</body>

</html>