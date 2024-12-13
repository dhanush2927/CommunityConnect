<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
  require('db.php');
  $error_message = ""; // Define a variable to hold the error message
  
  if (isset($_POST['username'])) {
    session_start();
    $username = stripslashes($_REQUEST['username']);  
    $username = mysqli_real_escape_string($con, $username);
    $_SESSION['username'] = $username;

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);


    $query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    
    if ($rows==1) {
        
        header("Location: home.php");
    } else {
      
        $error_message = "Incorrect Username/Password.";
    }
  }
?>

<header>
<div class="container">
</div>
</header>

<h1 style="font-size:45px;text-align:center;color:#FF0000">Community Connect</h1>

<!-- Login Form -->
<form class="form" action="" method="post" name="register">
    <h1 class="login-title">Login</h1>

    <!-- Show error message if login fails -->
    <?php if ($error_message): ?>
        <p style="color:red; text-align:center;"><?= $error_message ?></p>
    <?php endif; ?>

    <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
    <input type="password" class="login-input" name="password" placeholder="Password"/>
    <input type="submit" value="Login" name="register" class="login-button"/>
    <p class="link"><a href="register.php">Not a Member</a></p>
</form>

<?php
?>
</body>
</html>
