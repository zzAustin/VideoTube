<?php
class VideoPlayer{
	private $video;
	public function __construct($video){
		$this->video = $video;
	}

	// this is to create the video html tag
	public function create($autoPlay){
		if($autoPlay){
			$autoPlay = "autoplay";
		}else{
			$autoPlay = "";
		}

		$filePath = $this->video->getFilePath();
		return "<video class='videoPlayer' controls $autoPlay>
					<source src='$filePath' type='video/mp4'>
					Your browser does not support the video tag
				</video>";
	}
}

?>