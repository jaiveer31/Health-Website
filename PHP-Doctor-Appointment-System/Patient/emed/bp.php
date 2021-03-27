<style type="text/css">
    .bottom {

        position: relative;
        bottom: 0;
        width: 100%;

    }
</style>

<?php
session_start();
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$db = 'emed';

$con = new mysqli($mysql_host, $mysql_user, $mysql_password, $db) or die();
$status = "";
if (isset($_POST['code']) && $_POST['code'] != "") {
    $code = $_POST['code'];
    $result = mysqli_query($con, "SELECT * FROM `cart` WHERE `code`='$code'");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $code = $row['code'];
    $price = $row['price'];
    $image = $row['image'];

    $cartArray = array(
        $code => array(
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'quantity' => 1,
            'image' => $image
        )
    );

    if (empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
    } else {
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if (in_array($code, $array_keys)) {
            $status = "<div class='box' style='color:red;'>
        Product is already added to your cart!</div>";
        } else {
            $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
            $status = "<div class='box'>Product is added to your cart!</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Store - Blood Pressure</title>
    <link rel="stylesheet" type="text/css" href="diab.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="store.js"></script>
</head>

<body style="font-family: verdana; ">

    <header>
        <center>
            <i class="fa fa-ambulance" aria-hidden="true"></i>
            <h2>EMED.COM</h2>
        </center>
        <div>
            <div class="topnav">
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div id="mySidenav" class="sidenav">

                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="home.html">Home <i class="fa fa-home" aria-hidden="true"></i></a>
                <div class="dropdown">
                    <div class="dropbtn">Category <i class="fa fa-list-alt" aria-hidden="true"></i>
                    </div>
                    <div class="dropdown-content">
                        <a href="covid.php" style="color: blanchedalmond;font-size: medium;">Covid Supply</a>
                        <a href="diabetes.php" style="color: blanchedalmond;font-size: medium;">Diabetics</a>
                        <a href="cold.php" style="color: blanchedalmond; font-size: medium;">Cold & Fever</a>
                        <a href="bp.php" style="color: blanchedalmond;font-size: medium;">Blood pressure</a>
                        <a href="cardio.php" style="color: blanchedalmond;font-size: medium;">CardioVascular
                            Meds</a>
                    </div>
                </div>
                <a href="https://www.medscape.com/">MedUpdates <i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
                <a href="cart.php">Cart <i class="fa fa-cart" aria-hidden="true"></i></a>
                <a href="log.php">Log Out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
    </header>
    <?php
    if (!empty($_SESSION["shopping_cart"])) {
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    ?>
        <div class="cart_div">
            <a href="cart.php"><img src="cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
        </div>
    <?php
    } ?>




    <hr>
    <br>
    <div class="text-top">
        <h2 style="text-align: center;">Blood Pressure</h2>
        <p>Blood pressure is the force that moves blood through our circulatory system.

            It is an important force because oxygen and nutrients would not be pushed around our circulatory system to
            nourish tissues and organs without blood pressure.

            Blood pressure is also vital because it delivers white blood cells and antibodies for immunity, and hormones
            such as insulin.

            Just as important as providing oxygen and nutrients, the fresh blood that gets delivered is able to pick up
            the
            toxic waste products of metabolism, including the carbon dioxide we exhale with every breath, and the toxins
            we
            clear through our liver and kidneys.

            Blood itself carries a number of other properties, including its temperature. It also carries one of our
            defenses against tissue damage, the clotting platelets that prevent blood loss following injury.
            <br><br>
            High blood pressure usually has no symptoms. So the only way to find out if you have it is to get regular
            blood
            pressure checks from your health care provider. Your provider will use a gauge, a stethoscope or electronic
            sensor, and a blood pressure cuff. He or she will take two or more readings at separate appointments before
            making a diagnosis.
        </p>
        <br>
        <h3>Types of Blood Pressure Medications</h3>

        <center>
            <button id="tags"> <a href="https://www.heart.org/en/health-topics/high-blood-pressure/changes-you-can-make-to-manage-high-blood-pressure/types-of-blood-pressure-medications">
                    Blood pressure class</a></button>
        </center>
    </div>
    <br>
    <hr>
    <br>




    <?php


    $result = mysqli_query($con, "SELECT * FROM `cart` WHERE id>=13 and id<17;");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
                    <div class='card'>
                        <div class='rate'>

                            <div class='clip-star'></div>
                            <div class='clip-star'></div>
                            <div class='clip-star'></div>

                            <div class='clip-star'></div>
                        </div>
                        <br>
              
         
                    <div class='image'><img src='" . $row['image'] . "' /></div>
          
             
              <form method='post' action=''>
              <input type='text' name='code' value=" . $row['code'] . " />
              
              <div class='name'>" . $row['name'] . "</div>
              <div class='price'>$" . $row['price'] . "</div>
              <button type='submit' class='buy'>Buy Now</button>
              </form>
             
              </div>";
    }

    mysqli_close($con);
    ?>








    <br><br><br><br><br><br>


    <div class="bottom">
        <div style="clear:both;"></div>

        <div class="message_box" style="margin:10px 0px;">
            <?php echo $status; ?>
        </div>
        <div class="footer">
            <br><br><br>
            <h2>About</h2>
            This is a medical store website developed using html and css
            <br>
            <p>for more information contact us:<br> Medicalstore@gmail.com

                <br>Mobileno-98246XXXXX
            </p>
        </div>
        <marquee scrollamount="15">
            <h4>We ensure contact free delivery and highest quality. Daily offers on medicine avaliable. Avail now</h4>
        </marquee>


    </div>
</body>

</html>