<?php
require_once("ButtonProvider.php");

class CommentControls{
	private $con, $comment, $userLoggedInObj;
	public function __construct($con, $comment, $userLoggedInObj) {
		$this->con = $con;
		$this->comment = $comment;
		$this->userLoggedInObj = $userLoggedInObj;
	}

	// this is to create the video html tag
	public function create() {
		$replyButton = $this->createReplyButton();
		$likesCount = $this->createLikesCount()
		$likeButton = $this->createLikeButton();
		$dislikeButton = $this->createDislikeButton();
		$replySection = $this->createReplySection();
		return "<div class='controls'>
					$likeButton
					$dislikeButton
				</div>";
	}

	private function createReplyButton() {
		$text = "REPLY";
		$action = "toggleReply(this)";

		return ButtonProvider::createButton($text, null, $action, null);
	}

	private function createLikesCount() {
		$text = $this->comment->getLikes();
		if($text == 0) {
			$text = "";
		}

		return "<span class='likesCount'>$text</span>";
	}

	private function createReplySection() {
		return "";
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