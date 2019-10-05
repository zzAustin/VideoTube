<?php require_once("includes/header.php"); ?>
				
<!--<?php
	/*echo php_uname() . "<br>";
	echo PHP_OS . "<br>";*/
	if(isset($_SESSION["userLoggedIn"])){
		echo "Logged in as " . $userLoggedInObj->getName(); // $userLoggedInObj is defined in header.php
	}
	else{
		echo "Not logged in";
	}
?>-->

<div class="videoSection">
	<?php
		$subscriptionsProvider = new SubscriptionsProvider($con, $userLoggedInObj);
		$subscriptionVideos = $subscriptionsProvider->getVideos();

		$videoGrid = new VideoGrid($con, $userLoggedInObj->getUsername());
		if(User::isLoggedIn()) {
			
		}

		echo $videoGrid->create(null, "Recommended", false);
	?>
</div>


<?php require_once("includes/footer.php"); ?>