<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    <script>
        function validation() {
            var name = document.forms.register.name;
            var email = document.forms.register.email;
            var phone = document.forms.register.phonenum;
            var password = document.forms.register.password;

            var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var regPhone = /^\d{10}$/;
            var regName = /\d+$/g;

            if (name.value == "" || regName.test(name.value)) {
                alert("Please enter your name properly.");
                name.focus();
                return false;
            }

            if (email.value == "" || !regEmail.test(email.value)) {
                alert("Please enter a valid e-mail address.");
                email.focus();
                return false;
            }

            if (password.value == "") {
                alert("Please enter your password.");
                password.focus();
                return false;
            }

            if (password.value.length < 6) {
                alert("Password should be at least 6 characters long.");
                password.focus();
                return false;
            }

            if (phone.value == "" || !regPhone.test(phone.value)) {
                alert("Please enter a valid 10-digit phone number.");
                phone.focus();
                return false;
            }

            return true; // Allow form submission if everything is valid
        }
    </script>
</head>
<body>
<?php
require('db.php');
if (isset($_POST['register'])) {
    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($con, $name);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);

    $phonenum = stripslashes($_REQUEST['phonenum']);
    $phonenum = mysqli_real_escape_string($con, $phonenum);

    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);

    $password = stripslashes($_REQUEST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing

    $query = "INSERT INTO users (name, phnum, email, username, password) 
              VALUES (?, ?, ?, ?, ?)";

    // Using prepared statements to prevent SQL injection
    $stmt = $con->prepare($query);
    $stmt->bind_param("sssss", $name, $phonenum, $email, $username, $password);

    if ($stmt->execute()) {
        echo "<div class='form'>
              <h3>You are registered successfully.</h3><br/>
              <p class='link'>Click here to <a href='index.php'>Login</a></p>
              </div>";
    } else {
        echo "<div class='form'>
              <h3>There was an error. Please try again.</h3><br/>
              <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
              </div>";
    }
    $stmt->close();
} else {
?>

<h1 style="font-size:45px;text-align:center;color:#FF0000">Community Connect</h1>
<form class="form" action="" method="post" name="register" onsubmit="return validation();">
    <h1 class="login-title">Registration</h1>
    <input type="text" class="login-input" name="name" placeholder="Name" autofocus="true"/>
    <input type="text" class="login-input" name="email" placeholder="Email"/>
    <input type="text" class="login-input" name="phonenum" placeholder="Mobile Number"/>
    <input type="text" class="login-input" name="username" placeholder="Username"/>
    <input type="password" class="login-input" name="password" placeholder="Password"/>
    <input type="submit" value="Submit" name="register" class="login-button"/>
</form>

<?php
}
?>
</body>
</
