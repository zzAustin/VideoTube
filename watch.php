<?php require_once("includes/header.php"); ?>
<?php require_once("includes/classes/Video.php"); ?>
<?php require_once("includes/classes/VideoPlayer.php"); ?>

<?php
if(!isset($_GET["id"])){
	echo "No url passed into page";
	exit();
}

$video = new Video($con, $_GET["id"], $userLoggedInObj);
$video->incrementViews();

?>		

<div class="watchLeftColumn">
	<?php
		$videoPlayer = new VideoPlayer($video);
		echo $videoPlayer->create(true);
	?>
</div>

<div class="suggestions">
</div>

<?php require_once("includes/footer.php"); ?>