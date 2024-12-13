<!doctype html>
<html>
<head>
<title>Wish List</title>
<link rel="stylesheet" href="style.css"/>
<div class="container">
<nav>
        <ul>
             <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
</div>

</head>
<body>
<div class="form">
<h1 class="login-title">Wish List</h1>
<?php
require('db.php');
include('authentication.php');
$username=$_SESSION['username'];
$query=mysqli_query($con, "SELECT * from `favourites` WHERE username='$username'");
echo "<table border='1'> 
<tr>
<th>Name</th>
<th>Delete</th>
</tr>";
while($row = mysqli_fetch_array($query)){
echo "<tr>";
echo "<td>".$row['name']."</td>";?>
<td><a href="delete.php?name=<?php echo $row['name']?>">Delete</a></td>
<?php
echo "</tr>";
}
echo "</table>";
?>
</div>
</body>
</html>