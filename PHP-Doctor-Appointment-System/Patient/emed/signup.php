<?php include('server.php') ?>

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
        <h3>Register a new account</h3>
        <form method="post" action="signup.php">
            <?php include('errors.php'); ?>
            <table id="tab">
                <tr>
                    <td rowspan="0" class="num">
                        <a class="a" href="signup.php">Reset<br> the form</a>
                    </td>
                </tr>
                <tr>
                    <td class="field">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <input class="text" name="username" placeholder="Enter username" style="font-size: 15px" required>
                    </td>
                </tr>
                <tr>
                    <td class="field">
                        <i class="fa fa-key" aria-hidden="true"></i>

                        <input class="password" name="password_1" type="password" placeholder="Enter password" style="font-size: 15px" required>
                    </td>
                </tr>
                <tr>
                    <td class="field">
                        <i class="fa fa-key" aria-hidden="true"></i>

                        <input class="password" name="password_2" type="password" placeholder="Confirm Your password" style="font-size: 15px" required>
                    </td>
                </tr>
                <tr>
                    <td class="field">
                        <i class="fa fa-envelope" aria-hidden="true"></i>

                        <input class="email" name="email" type="email" placeholder="Enter Your email Address" style="font-size: 15px" required>
                    </td>
                </tr>

                <td class="field">
                    <i class="fa fa-birthday-cake" aria-hidden="true"></i>

                    <input class="DOB" name="DOb" type="date" placeholder="Enter Your Birthdate" style="font-size: 15px; width: 32%;" required>
                </td>
                </tr>
                <tr>
                    <td class="field">

                        <button type="submit" class="btn" name="reg_user">Register</button>
                    </td>
                </tr>

            </table>
            </center>
        </form>

        <br><br>
        <h5 style="text-align: center; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;font-size: 1.2em;">
            Already have an Account?</h5>
        <center>
            <button class="btn" style="width: 15%;"><a class="a" href="log.php">Log-In</a></button>
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