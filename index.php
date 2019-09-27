<?php require_once("includes/header.php"); ?>
				
<?php
	/*echo php_uname() . "<br>";
	echo PHP_OS . "<br>";*/
	if(isset($_SESSION["userLoggedIn"])){
		echo "Logged in as " . $userLoggedInObj->getName(); // $userLoggedInObj is defined in header.php
	}
	else{
		echo "Not logged in";
	}
?>


<?php require_once("includes/footer.php"); ?>