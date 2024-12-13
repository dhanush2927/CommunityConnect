<!doctype html>
<html>
<head>
    <title>Marketplace</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
            font-family: Arial, sans-serif;
        }
        
    </style>
</head>
<body>
<div class="container">
    <nav>
        <ul>
            <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
</div>

<body>
<?php
    require('db.php');
    include('authentication.php');
    // When form submitted, insert values into the database.
    if (isset($_POST['submit'])) {
        // removes backslashes
        $username = $_SESSION['username'];
        $post = stripslashes($_REQUEST['post']);
        $post = mysqli_real_escape_string($con, $post);
        $phnum = stripslashes($_REQUEST['phnum']);
        $phnum = mysqli_real_escape_string($con, $phnum);
        $query    = "INSERT into `posts` (username, phnum, post) VALUES ('$username', '$phnum', '$post')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Posted successfully.</h3><br/>
                  <p class='link'>Click Here for <a href='home.php'>Home</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>You are not Eligible</h3><br/>
                  <p class='link'>Click here for <a href='home.php'>Home</a> again.</p>
                  </div>";
        }
    }
else{

?>

<h1 style="font-size:45px;text-align:center;color:#FF0000">Community Connect</h1>
    <form class="form" action="" method="post">
    <form>
    <h1 class="form-title">Post</h1>
    <textarea name="post" class="login-input" placeholder="Write your post" rows="4" columns = "60" required /></textarea>
    <input type="text" class="login-input" name="phnum" placeholder="Mobile No" required />
    <input type="submit" name="submit" value="Post" class="form-button">
    </form>
<?php
    }
?>

</body>


</html>