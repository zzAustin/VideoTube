<?php 
require_once("includes/config.php");
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);
if(isset($_POST["submitButton"])){
	$username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
	$password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

	$wasSuccessful = $account->login($username, $password);
	if($wasSuccessful){
		echo "login successful\n";
		$_SESSION["userLoggedIn"] = $username;
		header("Location: index.php");
	}
}

function getInputValue($name){
	if(isset($_POST[$name])){
		echo $_POST[$name];
	}
}
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
				<form action="signIn.php" method="POST">
					<?php echo $account->getError(Constants::$loginFailed); ?>
					<input type="text" name="username" placeholder="Username" value="<?php getInputValue('username')?>" required autocomplete="off">
					<input type="password" name="password" placeholder="Password" required>
					<input type="submit" name="submitButton" value="SUBMIT">
				</form>
			</div>

			<a class="signInMessage" href="signUp.php">Need an account? Sign up here!</a>
		</div>
	</div>

</body>
</html>