<?php

session_start();
$status = "";
if (isset($_POST['action']) && $_POST['action'] == "remove") {
	if (!empty($_SESSION["shopping_cart"])) {
		foreach ($_SESSION["shopping_cart"] as $key => $value) {
			if ($_POST["code"] == $key) {
				unset($_SESSION["shopping_cart"][$key]);
				$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
			}
			if (empty($_SESSION["shopping_cart"]))
				unset($_SESSION["shopping_cart"]);
		}
	}
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
	foreach ($_SESSION["shopping_cart"] as &$value) {
		if ($value['code'] === $_POST["code"]) {
			$value['quantity'] = $_POST["quantity"];
			break; // Stop the loop after we've found the product
		}
	}
}
?>
<html>

<head>
	<title>Demo Shopping Cart - AllPHPTricks.com</title>
	<link rel="stylesheet" type="text/css" href="diab.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="store.js"></script>
</head>

<body>
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



	<div class="cart">
		<?php
		if (isset($_SESSION["shopping_cart"])) {
			$total_price = 0;
		?>
			<table class="table">
				<tbody>
					<tr>
						<td></td>
						<td>ITEM NAME</td>
						<td>QUANTITY</td>
						<td>UNIT PRICE</td>
						<td>ITEMS TOTAL</td>
					</tr>
					<?php
					foreach ($_SESSION["shopping_cart"] as $product) {
					?>
						<tr>
							<td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
							<td><?php echo $product["name"]; ?><br />
								<form method='post' action=''>
									<input type='text' name='code' value="<?php echo $product["code"]; ?>" />
									<input type='hidden' name='action' value="remove" />
									<button type='submit' class='remove'>Remove Item</button>
								</form>
							</td>
							<td>
								<form method='post' action=''>
									<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
									<input type='hidden' name='action' value="change" />
									<select name='quantity' class='quantity' onChange="this.form.submit()">
										<option <?php if ($product["quantity"] == 1) echo "selected"; ?> value="1">1</option>
										<option <?php if ($product["quantity"] == 2) echo "selected"; ?> value="2">2</option>
										<option <?php if ($product["quantity"] == 3) echo "selected"; ?> value="3">3</option>
										<option <?php if ($product["quantity"] == 4) echo "selected"; ?> value="4">4</option>
										<option <?php if ($product["quantity"] == 5) echo "selected"; ?> value="5">5</option>
									</select>
								</form>
							</td>
							<td><?php echo "$" . $product["price"]; ?></td>
							<td><?php echo "$" . $product["price"] * $product["quantity"]; ?></td>
						</tr>
					<?php
						$total_price += ($product["price"] * $product["quantity"]);
					}
					?>
					<tr>
						<td colspan="5" align="right">
							<strong>TOTAL: <?php echo "$" . $total_price; ?></strong>
						</td>
					</tr>
				</tbody>
			</table>
		<?php
		} else {
			echo "<h3>Your cart is empty!</h3>";
		}
		?>
	</div>

	<div style="clear:both;"></div>

	<div class="message_box" style="margin:10px 0px;">
		<?php echo $status; ?>
	</div>
	<form method="POST" action="payment.php">
		<center>
			<input type="number" name="prie" style="visibility: hidden;" value="<?php echo $total_price ?>">
			<input id="btn" type="submit" value="Checkout" name="submit">
		</center>
	</form>


</body>

</html>