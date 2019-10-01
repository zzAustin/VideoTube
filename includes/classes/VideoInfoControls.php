<?php
require_once("includes/classes/ButtonProvider.php");

class VideoInfoControls{
	private $con, $video, $userLoggedInObj;
	public function __construct($video, $userLoggedInObj) {
		$this->video = $video;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	// this is to create the video html tag
	public function create() {
		$likeButton = $this->createLikeButton();
		$dislikeButton = $this->createDislikeButton();

		return "<div class='controls'>
					$likeButton
					$dislikeButton
				</div>";
	}

	private function createLikeButton() {
		$text = $this->video->getLikes();
		$videoId = $this->video->getId();
		$action = "likeVideo(this, $videoId)";
		$class = "likeButton";
		$imgSrc = "assets/images/icons/thumb-up.png";

		if($this->video->wasLikedBy()){
			$imgSrc = "assets/images/icons/thumb-up-active.png";
		}

		// change img if the video is already liked

		return ButtonProvider::createButton($text, $imgSrc, $action, $class);
	}

	private function createDislikeButton() {
		$text = $this->video->getDislikes();
		$videoId = $this->video->getId();
		$action = "dislikeVideo(this, $videoId)";
		$class = "dislikeButton";
		$imgSrc = "assets/images/icons/thumb-down.png";

		if($this->video->wasDislikedBy()){
			$imgSrc = "assets/images/icons/thumb-down-active.png";
		}

		// change img if the video is already liked

		return ButtonProvider::createButton($text, $imgSrc, $action, $class);
	}
}
?>