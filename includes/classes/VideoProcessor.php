<?php
class VideoProcessor{

	private $con;
	private $sizeLimit = 50000000; // about 500M

	public function __construct($con){
		$this->con = $con;
	}

	public function upload($videoUploadData){
		$targetDir = "uploads/videos/";
		$videoData = $videoUploadData->videoDataArray;

		$tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
		$tempFilePath = str_replace(" ", "_", $tempFilePath);

		$isValidData = $this->processData($videoData, $tempFilePath);
		echo $tempFilePath;
	}

	private function processData($videoData, $filePath){
		$videoType = pathinfo($filePath, PATHINFO_EXTENSION);

		if(!$this->isValidSize($videoData))
		{
			echo "File too large, can't be more than " . $this->sizeLimit . " byte";
			return false;
		} 
	}

	private function isValidSize($data){
		return $data["size"] <= $this->sizeLimit;
	}
}
?>