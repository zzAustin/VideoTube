<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST["uploadButton"])){
	echo "No file sent to page.";
	exit();
}

// 1) create file upload data
$videoUploadData = new VideoUploadData(
								$_FILES["fileInput"],
								$_POST["titleInput"],
								$_POST["descriptionInput"],
								$_POST["privacyInput"],
								$_POST["categoryInput"],
								"Replace_This"
							);
// 2) process video data
$videoProcessor = new VideoProcessor($con);
$wasSuccessful = $videoProcessor->upload($videoUploadData);
if($wasSuccessful)
{
	echo "upload was successful." . "<br>";
}
else{
	echo "upload did not succeed." . "<br>";
}

// 3) check if upload was sucessful
if($wasSuccessful){
	echo "upload successful!";
}
?>