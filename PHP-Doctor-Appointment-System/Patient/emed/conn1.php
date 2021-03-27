<?php
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$db = 'emed';

$db = new mysqli($mysql_host, $mysql_user, $mysql_password, $db) or die();

$result = mysqli_query($db, "UPDATE cart SET flag=1 where name = '$name' ");
