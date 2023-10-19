<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!empty($_POST["submit"])) {
		$loginquery ="SELECT * FROM users WHERE username='$username' && password='".md5($password)."' && Role ='RT'";
		$result = mysqli_query($db, $loginquery);
		$row = mysqli_fetch_array($result);

		if (is_array($row)) {
			$message = "ok!";
			$_SESSION["user_id"] = $row['u_id'];
			$_SESSION["username"] = $row['username'];
			header("refresh:1;url=dashboard.php");
		} else {
			$message = "Invalid Username or Password!";
		}
	}
}

?>

<head>
	<meta charset="UTF-8">
	<title>Flat Login Form</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

	<link rel="stylesheet" href="css/login.css">


</head>

<body>


	<div class="container">
		<div class="info">
			<h1>Restaurant</h1>
		</div>
	</div>
	<div class="form">
		<div class="thumbnail"><img src="images/manager.png" /></div>
<!-- 
		<form class="register-form" action="index.php" method="post">
			<input type="text" placeholder="username" name="cr_user" />
			<input type="text" placeholder="email address" name="cr_email" />
			<input type="password" placeholder="password" name="cr_pass" />
			<input type="password" placeholder="Confirm password" name="cr_cpass" />
			<input type="password" placeholder="Unique-Code" name="code" />
			<input type="submit" name="submit1" value="Create" />
			<p class="message">Already registered? <a href="#">Sign In</a></p>
		</form> -->
		<span style="color:red;"><?php echo $message; ?></span>
		<span style="color:green;"><?php echo $success; ?></span>
		<form class="login-form" action="index.php" method="post">
			<input type="text" placeholder="username" name="username" />
			<input type="password" placeholder="password" name="password" />
			<input type="submit" name="submit" value="login" />
			<p class="message">Not registered? <a href="../register.php">Create an account</a>
			</p>
		</form>

	</div>

	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>
	</script>
	<script src='js/index.js'></script>






</body>

</html>