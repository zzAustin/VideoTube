<?php
class VideoProcessor{

	private $con;
	private $sizeLimit = 50000000; // about 500M
	private $allowedTypes = array("mp4","flv","webm","mkv","vob","ogv","ogg","avi","wmv","mov","mpeg","mpg");
	private $ffmpegPath;

	public function __construct($con){
		$this->con = $con;
		$this->ffmpegPath = realpath("ffmpeg/bin/ffmpeg");
		//$this->ffmpegPath = realpath("ffmpeg/bin/ffmpeg.exe"); // austin's note: windows 
	}

	public function upload($videoUploadData){
		$targetDir = "uploads/videos/";
		$videoData = $videoUploadData->videoDataArray;

		$tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
		$tempFilePath = str_replace(" ", "_", $tempFilePath);

		$isValidData = $this->processData($videoData, $tempFilePath);
		if(!$isValidData){
			return false;
		}

		if(move_uploaded_file($videoData["tmp_name"], $tempFilePath)){
			$finalFilePath = $targetDir . uniqid() . ".mp4";
			if(!$this->insertVideoData($videoUploadData, $finalFilePath)){
				echo "Insert query failed.\n";
				return false;
			}

			// in php.ini(under xampp/etc) austin's note
			// max_execution_time=30 changed to max_execution_time=300
			// upload_max_filesize=128M kept as it is
			if(!$this->convertVideoToMp4($tempFilePath, $finalFilePath)){
				echo "Video conversion failed.\n"
				return false;
			}

			echo "File moved successfully.";
		}
		//echo $tempFilePath;
	}

	private function processData($videoData, $filePath){
		$videoType = pathinfo($filePath, PATHINFO_EXTENSION);

		if(!$this->isValidSize($videoData))
		{
			echo "File too large, can't be more than " . $this->sizeLimit . " byte";
			return false;
		} 
		else if(!$this->isValidType($videoType)){
			echo "Invalid file type";
			return false;
		}
		else if(!$this->hasError($videoData)){
			echo "Error code: " . $videoData["error"];
			return false;
		}

		return true;
	}

	private function isValidSize($data){
		return $data["size"] <= $this->sizeLimit;
	}

	private function isValidType($videoType){
		$lowercased = strtolower($videoType);
		return in_array($lowercased, $this->allowedTypes);
	}

	private function hasError($videoData){
		return $videoData["error"] == 0;
	}

	private function insertVideoData($videoUploadData, $finalFilePath){
		// insert video info into database
		$query = $this->con->prepare("INSERT INTO videos (title, uploadedBy, description, privacy, category, filePath)
			                          VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");
		$query->bindParam(":title", $videoUploadData->title);
		$query->bindParam(":uploadedBy", $videoUploadData->uploadedBy);
		$query->bindParam(":description", $videoUploadData->description);
		$query->bindParam(":privacy", $videoUploadData->privacy);
		$query->bindParam(":category", $videoUploadData->category);
		$query->bindParam(":filePath", $finalFilePath);

		return $query->execute();
	}

	private function convertVideoToMp4($tempFilePath, $finalFilePath){
		$cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";
		$outputLog = array();
		exec($cmd, $outputLog, $returnCode);

		if($returnCode != 0){
			foreach($outputLog as $line){
				echo $line . "<br>";
			}

			return false;
		}

		return true;
	}
}
?>