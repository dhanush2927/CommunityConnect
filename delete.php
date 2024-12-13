<?php
require('db.php');
include('authentication.php');
$username=$_SESSION['username'];
$name = stripslashes($_REQUEST['name']);
$name =  mysqli_real_escape_string($con, $name);
$query = "DELETE FROM `wish_list` WHERE name='$name' and username='$username'"; 
$result = mysqli_query($con,$query) or die ( mysqli_error());
header("Location: wishlist.php"); 
?>