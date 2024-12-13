<?php
require('db.php');
include('authentication.php');
$username=$_SESSION['username'];
$name = stripslashes($_REQUEST['name']);
$name = mysqli_real_escape_string($con, $name);
$query   = "INSERT into `favourites` (username, name) VALUE ('$username','$name')";
$result  = mysqli_query($con, $query);
echo "<h2>Added to favourites successfully</h3>";
header("Location: favourites.php"); 
?>