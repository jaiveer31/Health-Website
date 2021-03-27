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
    <title>Medical Store</title>
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
            <a href="cart.php">Cart<span><?php echo $cart_count; ?></span></a>
        </div>
    <?php
    } ?>


    <hr>
    <br>

    <h2 style="text-align: center;">Diabetes</h2>
    <p>Diabetes is a disease that occurs when your blood glucose, also called blood sugar, is too high. Blood glucose is
        your main source of energy and comes from the food you eat. Insulin, a hormone made by the pancreas, helps
        glucose from food get into your cells to be used for energy. Sometimes your body doesn’t make enough—or
        any—insulin or doesn’t use insulin well. Glucose then stays in your blood and doesn’t reach your cells.
        <br><br>
        Over time, having too much glucose in your blood can cause health problems. Although diabetes has no cure, you
        can take steps to manage your diabetes and stay healthy.
    </p>
    <br>
    <h3 style="text-align: center;">What are the different types of diabetes?</h3>
    <br>
    <center>
        <button id="tags"><a href="https://www.webmd.com/diabetes/type-1-diabetes" style="text-decoration: none;">Type 1
                diabetes</a></button>

        <button id="tags"><a href="https://www.webmd.com/diabetes/type-2-diabetes" style="text-decoration: none;">Type 2
                diabetes</a></button>
        <button id="tags"><a href="https://www.webmd.com/diabetes/gestational-diabetes#:~:text=Gestational%20diabetes%20is%20a%20condition,it%20through%20diet%20and%20exercise." style="text-decoration: none;">Gestational
                diabetes</a></button>
    </center>

    <br><br>
    <hr>


    <?php


    $result = mysqli_query($con, "SELECT * FROM `cart` WHERE id>=5 and id<9;");
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
            <br><br>
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

</body>

</html>