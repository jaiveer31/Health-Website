<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$db = 'emed';

$db = new mysqli($mysql_host, $mysql_user, $mysql_password, $db) or die();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Payment Gateway</title>
	<link rel="stylesheet" type="text/css" href="payment.css">
</head>

<body>
	<div class="app-container">
		<div class="top-box">
			<a href="home.html">
				<p><span class="left-icon">&#x2190;</span>
			</a>CHECKOUT<span class="right-icon">&#xb7;&#xb7;&#xb7;</span></p>
		</div>
		<div class="middle-box">
			<h1><?php echo $_POST['prie'] ?><span>₹</span></h1>
			<p>Pay to Medical Store</p>
		</div>

		<div class="bottom-box">
			<button type="button" class="payment-option-btn">Pay with Paytm</button>
			<button type="button" class="payment-option-btn">Pay using net banking</button>
		</div>

		<div class="card-details">
			<p>Pay using credit or debit card</p>
			<div class="car-num-field-group">
				<label>Card Number</label><br>
				<input type="text" class="car-num-field" placeholder="xxxx-xxxx-xxxx-xxxx">
			</div>




			<div class="date-field-group">
				<label>Expiry Date</label><br>
				<input type="Number" class="date-field" placeholder="mm">
				<input type="Number" class="date-field" placeholder="yyyy">
			</div>



			<div class="cvc-field-group">
				<label>CVC</label><br>
				<input type="password" class="cvc-field" placeholder="xxx">
			</div>


			<div class="name-field-group">
				<label>Card Holder Name</label><br>
				<input type="text" class="name-field" placeholder="Full name">
			</div>
			<button type="button" class="pay-btn">Pay Now</button>
		</div>
	</div>
</body>

</html>