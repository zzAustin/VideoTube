<?php 
require_once("includes/config.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign in to VideoTube</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"><!--Bootstrap css file-->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"><!--My css file-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script><!--jquery file-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script><!--Bootstrap js file-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script><!--Bootstrap js file-->
</head>
<body>
	<div class="signInContainer">
		<div class="column">
			
			<div class="header">
				<img src="assets/images/icons/VideoTubeLogo.png" title="logo" alt="Site logo">
				<h3>Sign Up</h3>
				<span>to continue to VideoTube</span>
			</div>
			
			<div class="loginForm">
				<form action="signUp.php">
					<input type="text" name="firstName" placeholder="First Name" autocomplete="off" required>
					<input type="text" name="lastName" placeholder="Last Name" autocomplete="off" required>
					<input type="text" name="username" placeholder="User Name" autocomplete="off" required>

					<input type="email" name="email" placeholder="Email" autocomplete="off" required>
					<input type="email" name="email2" placeholder="Confirm email" autocomplete="off" required>
					<input type="password" name="password" placeholder="Password" autocomplete="off" required>
					<input type="password" name="password2" placeholder="Confirm password" autocomplete="off" required>

					<input type="submit" name="submitButton" value="SUBMIT">
				</form>
			</div>

			<a class="signInMessage" href="signIn.php">Already have an account? Sign in here!</a>
		</div>
	</div>

</body>
</html>